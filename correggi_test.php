<?php
require_once("./db_connection.php");

$test_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($test_id <= 0) {
    die("ID del test non valido.");
}

$sql = "SELECT * FROM test JOIN risposta_test ON risposta_test.id_test=test.id WHERE test.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $test_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Test non trovato.";
    exit;
}

$test = $result->fetch_assoc();

$domande = json_decode($test['domande']);
if (json_last_error() !== JSON_ERROR_NONE) {
    die("Errore nella decodifica delle domande.");
}
$risposte = json_decode($test['risposte']);
if (json_last_error() !== JSON_ERROR_NONE) {
    die("Errore nella decodifica delle risposte.");
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Test: <?php echo htmlspecialchars($test['nome']); ?></title>
    <?php require("./include_bs_css.php"); ?>
</head>
<body>
    <?php
        require("./navbar.php"); 
        require("./check_user.php");
    ?>

    <h1><?php echo $test['nome']; ?></h1>
    <h2><?php echo $test['studente']; ?></h2>
    <p>Data di consegna: <?php echo $test['data_esecuzione']; ?></p>
    <p>Punteggio: <?php echo (isset($test["valutazione"])?($test["valutazione"]):"N/A"); ?></p>

    <h2>Domande:</h2>
    <form method="POST" action="assegna_valutazione.php">
        <div class="mt-3 mx-5">
        <?php
            $k = 0;
            for ($i = 0; isset($domande->domande[$i]); $i++) {
                echo '<div class="mb-3 p-3 border rounded">';
                echo '<p class="text-end mb-0">Punti: ' . $domande->domande[$i]->punteggio . '</p>';
                echo '<label class="form-label fw-medium" for="domanda' . $i . '">' . $domande->domande[$i]->testo . '</label>';
                echo '<br>';

                if ($domande->domande[$i]->hasOptions) {
                    for ($j = 0; isset($domande->domande[$i]->opzioni[$j]); $j++) {
                        $checked = $risposte->domande[$k][$j] == 1 ? "checked" : "";
                        echo '<input ' . $checked . ' disabled type="checkbox" class="form-check-input" id="domanda' . $i . $j . '" name="domande[' . $k . '][]" value="op' . $j . '">';
                        echo '<label class="form-label" for="domanda' . $i . $j . '">' . $domande->domande[$i]->opzioni[$j]->txt . '</label><br>';
                    }
                } else {
                    echo '<textarea disabled class="form-control" name="domande[]" id="domanda' . $i . '">' . htmlspecialchars($risposte->domande[$k]) . '</textarea>';
                }

                echo '<div class="mt-3">
                        <label for="punteggio' . $i . '" class="form-label">Assegna un punteggio:</label>
                        <input required type="number" step="0.1" class="form-control" name="punteggi[]" id="punteggio' . $i . '" min="0" max="' . $domande->domande[$i]->punteggio . '">
                      </div>';

                echo '</div>';
                $k++;
            }
        ?>
        </div>
        <button type="submit" class="btn btn-outline-success row ms-3 mb-3" id="assegnaValutazione">Assegna valutazione</button>
        <input type="hidden" name="id" value="<?=$_REQUEST['id']?>">
        <input type="hidden" name="studente" value="<?=$_REQUEST['studente']?>">

    </form>
    <div class="btn-group ms-3" role="group" aria-label="navigation">
        <a href="visualizza_test_completato.php?id=<?=$_REQUEST['id']; ?>&studente=<?=$_REQUEST['studente']; ?>" class="btn btn-outline-primary">
            Indietro
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"/>
            </svg>
        </a>
        <a href="my_tests.php" class="btn btn-outline-primary">Torna ai tuoi test</a>
    </div>
    <?php require("./include_bs_js.php"); ?>
</body>
</html>

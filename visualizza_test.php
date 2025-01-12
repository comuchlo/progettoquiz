<?php
require_once("./db_connection.php");

$test_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($test_id <= 0) {
    die("ID del test non valido.");
}

$sql = "SELECT nome, domande, data, max_punteggio FROM test WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $test_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Test non trovato.";
    exit;
}

$test = $result->fetch_assoc();
$nome_test = $test['nome'];
$data_test = $test['data'];
$max_punteggio = $test['max_punteggio'] ?? "N/A";
$domande_json = $test['domande'];

$domande = json_decode($domande_json);
if (json_last_error() !== JSON_ERROR_NONE) {
    die("Errore nella decodifica delle domande.");
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Test: <?php echo htmlspecialchars($nome_test); ?></title>
    <?php require("./include_bs_css.php"); ?>
</head>
<body>
    
    <?php
        require("./navbar.php"); 
        require("./check_user.php");
    ?>

    <h1><?php echo htmlspecialchars($nome_test); ?></h1>
    <p>Data: <?php echo htmlspecialchars($data_test); ?></p>
    <p>Punteggio massimo: <?php echo htmlspecialchars($max_punteggio); ?></p>

    <h2>Domande:</h2>
    <div class="mt-3 mx-5">
    <?php
        $counter=0;
        for($i=0;isset($domande->domande[$i]);$i++){
            echo   '<div class="mb-3 p-3 border rounded">
                    <p class="text-end mb-0">Punti: '.$domande->domande[$i]->punteggio.'</p>
                    <label class="form-label fw-medium" for="domanda'.$i.'">'.$domande->domande[$i]->testo.'</label>
                    <br>
                    <div class="px-1">';
            if($domande->domande[$i]->hasOptions){
                for($j=0;isset($domande->domande[$i]->opzioni[$j]);$j++){
                    
                    echo '<input disabled type="checkbox" class="form-check-input" id="domanda'.$i.$j.'" name="domande['.$counter.'][]" value="op'.$j.'"> <label class="form-label" for="domanda'.$i.$j.'">'.$domande->domande[$i]->opzioni[$j]->txt.'</label><br>';
                    
                }
            }else{
                echo '<textarea disabled class="form-control" name="domande[]" id="domanda'.$i.'"></textarea>';
            }
            echo '</div></div>';
            $counter+=1;
        }

    ?>
    </div>
    <div class="btn-group ms-3" role="group" aria-label="navigation">
        <a href="doc_test_menu.php?id=<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>.php" class="btn btn-outline-primary" >
            Indietro 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"/>
            </svg>
        </a>
        <a href="my_tests.php" class="btn btn-outline-primary" >Torna ai tuoi test</a>
    </div>
</body>
</html>

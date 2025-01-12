<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("./db_connection.php"); 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
$sql = $conn->prepare("SELECT *, check_visibilita_test_studenti(?, ?) as chk FROM test WHERE id = ?");
$sql->bind_param("isi", $id, $_SESSION['username'], $id);
$sql->execute();
$result = $sql->get_result()->fetch_assoc();

if (!isset($result['chk']) || $result['chk'] != 1) {
    die();
}

$sql = $conn->prepare("SELECT * FROM `risposta_test` WHERE risposta_test.id_test=? AND risposta_test.studente=? ORDER BY data_esecuzione DESC LIMIT 1;");
$sql->bind_param("is", $id, $_SESSION['username']);
$sql->execute();
$res_risp = $sql->get_result()->fetch_assoc();

$domande = json_decode($result['domande'], true);

$risposte = isset($res_risp['risposte']) ? json_decode($res_risp['risposte'], true) : [];


?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Test: <?php echo htmlspecialchars($result['nome']); ?></title>
    <?php require("./include_bs_css.php"); ?>
</head>
<body>
<?php require("./navbar.php"); ?>

<div class="p-5" style="height: 100vh;">
    <h1><?php echo htmlspecialchars($result['nome']); ?></h1>
    <p>Data: <?php echo htmlspecialchars($result['data']); ?></p>
    <p>Punteggio massimo: <?php if(isset($result['max_punteggio'])){echo htmlspecialchars($result['max_punteggio']);} ?></p>
    <h2>Domande:</h2>

    <?php
     if ($res_risp): ?>
        <table class="table table-bordered table-hover">
            <?php 
            $counter = 0;
            foreach ($domande['domande'] as $index => $domanda) {
                if (is_string($domanda)) {
                    echo "<tr><th>" . htmlspecialchars($domanda) . "</th><td>";

                    if (isset($risposte[$counter])) {
                        $risposta = $risposte[$counter];
                        if (is_array($risposta)) {
                            echo "<ul>";
                            foreach ($risposta as $key => $value) {
                                if ($value == "1") {
                                    echo "<li><strong>" . htmlspecialchars($domanda[$key]) . " (Risposta selezionata)</strong></li>";
                                } else {
                                    echo "<li>" . htmlspecialchars($domanda[$key]) . "</li>";
                                }
                            }
                            echo "</ul>";
                        } else {
                            echo "<p>" . htmlspecialchars($risposta) . "</p>";
                        }
                    } else {
                        echo "<i>Non hai risposto a questa domanda.</i>";
                    }
                    echo "</td></tr>";
                }
                $counter++;
            }
            ?>
        </table>
    <?php else: ?>
        <p>Non hai ancora completato il quiz.</p>
    <?php endif; ?>

    <a href="my_tests.php">Torna ai tuoi test</a>
</div>

<?php require("./include_bs_js.php"); ?>
</body>
</html>

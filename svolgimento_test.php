<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("./db_connection.php"); 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id=(isset($_REQUEST['id'])?(intval($_REQUEST['id'])):(-1));
$sql= $conn->prepare("SELECT *, check_visibilita_test_studenti(?, ?) as chk FROM test WHERE id = ?");
$sql->bind_param("isi", $id,$_SESSION['username'], $id);
$sql->execute();
$result = $sql->get_result()->fetch_assoc();

if(!isset($result['chk']) || $result['chk']!=1){
    die();
}

$sql= $conn->prepare("SELECT * FROM `risposta_test` WHERE risposta_test.id_test=? AND risposta_test.studente=? ORDER BY data_esecuzione DESC LIMIT 1;");
$sql->bind_param("is", $id,$_SESSION['username']);
$sql->execute();
$res_risp = $sql->get_result()->fetch_assoc();

if($res_risp){
    die();
}

$domande= json_decode($result['domande']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$result['nome'] ?></title>
    <?php require("./include_bs_css.php"); ?>
</head>
<body>
<?php require("./navbar.php"); ?>
    <div class="p-5" style="height: 100vh;" >
        <form action="" method="post" >

            <?php
                for($i=0;isset($domande->domande[$i]);$i++){
                    echo   '<div class="mb-3 p-3 border rounded">
                            <p class="text-end mb-0">Punti: '.$domande->domande[$i]->punteggio.'</p>
                            <label class="form-label fw-medium" for="domanda'.$i.'">'.$domande->domande[$i]->testo.'</label>
                            <br>
                            <div class="px-1">';
                    if($domande->domande[$i]->hasOptions){
                        for($j=0;isset($domande->domande[$i]->opzioni[$j]);$j++){
                            echo '<input type="checkbox" class="form-check-input" id="domanda'.$i.$j.'" name="domande[][]" value="op'.$j.'"> <label class="form-label" for="domanda'.$i.$j.'">'.$domande->domande[$i]->opzioni[$j]->txt.'</label><br>';
                            
                        }
                    }else{
                        echo '<textarea class="form-control" name="domande[]" id="domanda'.$i.'"></textarea>';
                    }
                    echo '</div></div>';
                }

            ?>
            <div class="d-flex justify-content-center py-5">
                <button type="button" class="btn btn-outline-danger"  data-bs-toggle="modal" data-bs-target="#confirmmodal">Termina il quiz</button>
            </div>
        
            <div class="modal fade" tabindex="-1" id="confirmmodal" aria-labelledby="confirmmodal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Terminare il quiz?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Annulla"></button>
                        </div>
                        <div class="modal-body">
                            <p class="px-2 my-2">Non potrai più tornare indietro.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                            <button type="submit" class="btn btn-danger">Termina il tentativo</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>


<?php require("./include_bs_js.php"); ?>
</body>
</html>
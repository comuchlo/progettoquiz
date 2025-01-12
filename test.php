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
<?php require("./navbar.php"); 
require("./check_user.php"); ?>
    <div class="p-5" style="height: 100vh;" >
        <h5 class="d-flex align-items-center gap-1 align-top">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
            </svg>

            <?=$result['docente'] ?> / 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
                <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5"/>
                <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
            </svg>
            <?=$result['nome'] ?>
            <?php if ($res_risp): ?>
                <a href="visualizza_test_completato.php?id=<?=$id?>" class="btn btn-info ms-3">Visualizza Risposte</a>
            <?php endif; ?> 
        </h5>
        
        <?php //var_dump($res_risp); echo "<br>"; var_dump($result)?>
        <br>
        <table class="table table-light table-striped table-bordered table-hover align-self-center">
            <tr>
                <th scope="row">stato svolgimento</th>
                <?= ($res_risp)?('<td class="table-success">Svolto</td>'):('<td class="table-warning">Non svolto</td>') ?>
            </tr>
            <tr>
                <th scope="row">consegnato</th>
                <td><?= ($res_risp)?($res_risp["data_esecuzione"]):("-") ?></td>
            </tr>
            <tr>
                <th scope="row">valutazione</th>
                <?= ($res_risp && $res_risp['valutazione'])?('<td>'.$res_risp['valutazione'].' / '.(($result['max_punteggio'])?($result['max_punteggio']):("Non disponibile")).'</td>'):('<td class="table-secondary">Non valutato</td>') ?>
            </tr>
        </table>
        <br>

        <div class="justify-content-center d-flex">
            <form action="svolgimento_test.php" method="POST"> 
                <input type="hidden" name="id" value="<?=$id?>">
                <button type="submit" class="btn btn-primary" <?=($res_risp)?("disabled"):("")?> >Tenta il quiz</button>
            </form>
        </div>
            
       
    </div>


<?php require("./include_bs_js.php"); ?>
</body>
</html>
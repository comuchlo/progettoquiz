<?php
if(!isset($_GET["type"])|| empty($_GET["type"])){
    $_GET["type"]='s';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiunta <?=($_GET["type"]=='s')?("studente"):("docente")?></title>
    <?php require("./include_bs_css.php"); ?>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .contenuto {
            margin: 50px auto;
            max-width: 600px;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-title {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.8rem;
            font-weight: bold;
            color: #007bff;
        }
        .btn-submit {
            width: 100%;
            font-size: 1.2rem;
            padding: 10px;
        }
    </style>
</head>
<body>
    <?php require("./navbar.php"); require("./check_user.php") ?>

    <div class="container mt-5">
        <h1 class="text-center">Aggiungi <?=($_GET["type"]=='s')?("studente"):("docente")?></h1>
        <form action="elabora_utente.php" method="post">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="cognome" class="form-label">Cognome</label>
                <input type="text" class="form-control" id="cognome" name="cognome" required>
            </div>
            <?php
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
                
                if($_GET["type"]=='s'){
                require_once("./db_connection.php");

                echo '<div class="mb-3"> <label for="classe" class="form-label">Classe</label> <select required id="classe" name="classe" class="form-select" aria-label="Default select example"> ';
                
                $sql= $conn->prepare("SELECT * FROM `classe` WHERE (AS_inizio=YEAR(CURRENT_DATE()) AND MONTH(CURRENT_DATE())>=7) OR (AS_inizio+1=YEAR(CURRENT_DATE()) AND MONTH(CURRENT_DATE())<7)");
                $sql->execute();
                $risp = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
                echo '<option disabled value="" selected>-</option>';
                foreach ($risp as $row) {
                    echo '<option value="'.$row["id"].'">'.$row["sezione"].'</option>';
                }
                echo "</select> </div>";
                
                //SELECT * FROM `classe` WHERE (AS_inizio=YEAR(CURRENT_DATE()) AND MONTH(CURRENT_DATE())>=7) OR (AS_inizio+1=YEAR(CURRENT_DATE()) AND MONTH(CURRENT_DATE())<7)
            }

            ?>
            <div class="mb-3">
                <label for="login" class="form-label">Login</label>
                <input type="text" class="form-control" id="login" name="login" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="cf" class="form-label">Codice Fiscale</label>
                <input type="text" class="form-control" id="cf" name="cf">
            </div>
            <input type="hidden" name="ruolo" value="<?=($_GET["type"]=='s')?("1"):("2")?>">
            <button type="submit" class="btn btn-primary" name="ag_ut">Aggiungi <?=($_GET["type"]=='s')?("studente"):("docente")?></button>
        </form>
    </div>
    <?php
        if(isset($_GET["success"])){
            echo "<script type='text/javascript'>
                    setTimeout(function() { alert('Studente aggiunto con successo!'); }, 50);
                  </script>";
        }else if(isset($_GET["error"])){
            echo "<script type='text/javascript'>
                    setTimeout(function() { alert('errore: ".addslashes($_GET['error'])."'); }, 50);
                  </script>";
        }
    ?>
    <?php require("./include_bs_js.php"); ?>
</body>
</html>

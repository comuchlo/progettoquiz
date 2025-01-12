<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tests</title>
    <?php require("./include_bs_css.php"); ?>
</head>
<body>
    <?php require("./navbar.php"); require_once("./db_connection.php"); require("./check_user.php"); ?>

    <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    
        $sql = $conn->prepare("SELECT utente.nome, utente.cognome, utente.login FROM utente JOIN associazioni_classi AS ac ON utente.login = ac.utente_login WHERE utente.ruolo >= 2 AND ac.classe_id = ( SELECT classe_id FROM associazioni_classi WHERE associazioni_classi.utente_login = ? ); "); 
        $sql->bind_param("s", $_SESSION['username']);
        $sql->execute();
        $result = $sql->get_result();
        if ($result->num_rows > 0) {
            echo '<div class="justify-content-center row" style="height: 100vh;"> <div class="accordion fw-medium" style="max-width: 75rem" id="accordionPanelsStayOpenExample">';
            $c= 65;
            while($docente = $result->fetch_assoc()){
                $sql = $conn->prepare('SELECT test.nome, test.data, test.id FROM test WHERE test.docente = ?');
                    $sql->bind_param("s",$docente['login']);
                    $sql->execute();
                    $res2= $sql->get_result();
                    echo '<div class="accordion-item my-3 border-top-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button border-top" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse'.(chr($c)).'" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    '.$docente["cognome"].' '.$docente["nome"].'      
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapse'.(chr($c)).'" class="accordion-collapse collapse show">
                                <div class="accordion-body"><div class="list-group list-group-flush list-group-item-action">';
                    if($res2->num_rows > 0){
                        while ($test= $res2->fetch_assoc()) {
                            echo '<a class="list-group-item-action dropdown-item list-group-item" href="test.php?id='.$test['id'].'">
                            '.$test["nome"].'    
                            </a>';
                        }
                    }else{
                        echo '<div class="dropdown-item"> 
                                non sono presenti test
                            </div>';
                    }
                    echo '</div>
                                </div>
                            </div>
                        </div>';
                    $c+=1;
                }
            echo '</div>';
        }else{
            echo '<div class="justify-content-center row text-center p-4"> <div class="alert alert-danger fw-medium m-0" style="max-width: 50rem">non sono presenti docenti associati alla classe</div>';
        }
    ?>
    

    <?php require("./include_bs_js.php"); ?>
    
</body>
</html>
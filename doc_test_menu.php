<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Test</title>
    <?php 
        require("./include_bs_css.php"); 
        require_once("./db_connection.php");
    ?>
</head>
<body class="bg-light">
    <?php require("./navbar.php"); 
    require("check_user.php"); ?>
    <div class="d-flex pe-3">
    </div>
    <div class="ms-3 mt-4">
        <h1 class="d-flex justify-content-start mb-4">Gestione Test</h1>
        <a class="btn btn-primary my-3" href="visualizza_test.php?id=<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">Visualizza test</a>
    </div>
    <?php
        $sql = $conn->prepare("SELECT id, sezione FROM classe JOIN associazioni_classi AS c ON classe_id = id WHERE utente_login = ? "); 
        $sql->bind_param("s", $_SESSION['username']);
        $sql->execute();
        $result = $sql->get_result();
        if ($result->num_rows > 0) {
            echo '<div class="justify-content-center row" style="height: 100vh;"> <div class="accordion fw-medium" style="max-width: 75rem" id="accordionPanelsStayOpenExample">';
            $c= 65;
            while($classe = $result->fetch_assoc()){
                $sql = $conn->prepare('SELECT *, check_visibilita_test_classi(id_test, classe_id) AS chk FROM `risposta_test` JOIN associazioni_classi as ac ON utente_login = studente WHERE id_test = ? AND classe_id = ?');
                $sql->bind_param("ii",$_REQUEST['id'], $classe['id']);
                $sql->execute();
                $res2= $sql->get_result();
                echo '<div class="accordion-item my-3 border-top-0">
                        <h2 class="accordion-header">
                            <button class="accordion-button border-top" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse'.(chr($c)).'" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                '.$classe['sezione'].'      
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapse'.(chr($c)).'" class="accordion-collapse collapse show">
                            <div class="accordion-body"><div class="list-group list-group-flush list-group-item-action">';
                if($res2->num_rows > 0){
                    while ($test= $res2->fetch_assoc()) {
                        echo '<a class="list-group-item-action dropdown-item list-group-item" href="visualizza_test_completato.php?id='.$_GET['id'].'&studente='.$test['studente'].'">
                        '.$test["studente"].'    
                        </a>';
                    }
                }else{
                    if($classe["chk"]==0){
                        echo '<div class="dropdown-item"> 
                                test non assegnato alla classe
                            </div>';
                    }else{
                        echo '<div class="dropdown-item"> 
                                non sono presenti consegne
                            </div>';
                    }
                }
                echo '</div>
                            </div>
                        </div>
                    </div>';
                $c+=1;
            }
            echo '</div>';
        }else{
            echo '<div class="justify-content-center row text-center p-4"> <div class="alert alert-danger fw-medium m-0" style="max-width: 50rem">Nessuna classe trovata</div>';
        }
    ?>

    <?php require("./include_bs_js.php"); ?>
</body>
</html>

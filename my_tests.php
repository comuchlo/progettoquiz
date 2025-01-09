<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My tests</title>
    <?php require("./include_bs_css.php"); ?>
    <style>
        a{
            color: black;
        }
        a:hover {
            color: #0d6efd;
        }
    </style>
</head>
<body>
<?php require("./navbar.php"); require_once("./db_connection.php"); ?>

    <div class="d-flex justify-content-end pe-3">
        <a class="btn btn-primary my-3" href="creazione_test.php">Crea test</a>
    </div>

<?php
    $sql = $conn->prepare("SELECT * FROM test WHERE docente = ? "); 
    $sql->bind_param("s", $_SESSION['username']);
    $sql->execute();
    $result = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

    //var_dump($result);
    echo '<ul class="list-group">';
    foreach($result as $row) {
        echo '<li class="list-group-item">'
            .'<h5><a class="link-primary-hover link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="my_test.php?id='.$row["id"].'">' . ($row['nome']) . '</a></h5>'
            .'<p class="fs-6 text-body-secondary">' . ($row['data']) . '</p>';    
        if (!is_null($row['max_punteggio']) && $row['max_punteggio'] !== '') {
            echo '<p class="fs-6 text-body-secondary"> Punteggio massimo: ' . ($row['max_punteggio']) . '</p>';
        } else {
            echo '<p class="fs-6 text-body-secondary"></p>';
        }
        echo '</li>';
    }
    echo '</ul>';
?>

<?php require("./include_bs_js.php"); ?>

</body>
</html>
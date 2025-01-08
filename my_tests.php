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
</head>
<body>
<?php require("./navbar.php"); require_once("./db_connection.php"); ?>

<?php
$sql = $conn->prepare("SELECT * FROM test WHERE docente = ? "); 
$sql->bind_param("s", $_SESSION['username']);
$sql->execute();
$result = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

//var_dump($result);
echo '<ul class="list-group">';
foreach($result as $row) {
    echo '<li class="list-group-item">'
         .'<h5>' . htmlspecialchars($row['nome'], ENT_QUOTES, 'UTF-8') . '</h5>'
         .'<p class="fs-6 text-body-secondary">' . htmlspecialchars($row['data'], ENT_QUOTES, 'UTF-8') . '</p>';    
    if (!is_null($row['max_punteggio']) && $row['max_punteggio'] !== '') {
        echo '<p class="fs-6 text-body-secondary"> Punteggio massimo: ' . htmlspecialchars($row['max_punteggio'], ENT_QUOTES, 'UTF-8') . '</p>';
    } else {
        echo '<p class="fs-6 text-body-secondary"> Punteggio massimo non disponibile.</p>';
    }
    echo '</li>';
}
echo '</ul>';


?>

<?php require("./include_bs_js.php"); ?>

</body>
</html>
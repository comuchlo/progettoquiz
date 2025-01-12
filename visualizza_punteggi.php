<?php
$mysqli = new mysqli("localhost", "root", "", "quiz");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_test = $_GET['id'];
    function getScores($mysqli, $id_test) {
        $query = "SELECT id, studente, valutazione FROM risposta_test WHERE id_test = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $id_test);
        $stmt->execute();
        return $stmt->get_result();
    }
    $scores = getScores($mysqli, $id_test);
} else {
    echo "<h3>ID Test non valido!</h3>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Punteggi</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px 12px;
            text-align: center;
        }
        .container {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Punteggi per il Test</h1>

        <?php if ($scores && $scores->num_rows > 0) { ?>
            <h2>Punteggi per il Test ID: <?= htmlspecialchars($id_test) ?></h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Studente</th>
                        <th>Punteggio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $scores->fetch_assoc()) { ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['studente']) ?></td>
                            <td><?= htmlspecialchars($row['valutazione']) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>Nessun punteggio trovato per questo test.</p>
        <?php } ?>
    </div>
</body>
</html>

<?php
$mysqli->close();
?>

<?php

$host = 'localhost';  
$user = 'root';       
$password = '';       
$database = 'quiz';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

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
$max_punteggio = $test['max_punteggio'];
$domande_json = $test['domande'];

$domande = json_decode($domande_json, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    die("Errore nella decodifica delle domande.");
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Test: <?php echo htmlspecialchars($nome_test); ?></title>
    <?php require("./include_bs_css.php"); ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
            color: #333;
        }
        h1 {
            color: #0056b3;
        }
        p {
            font-size: 16px;
        }
        ol {
            padding-left: 20px;
        }
        ul {
            list-style-type: circle;
            padding-left: 40px;
        }
        li {
            margin-bottom: 10px;
        }
        a {
            text-decoration: none;
            color: #0056b3;
        }
        a:hover {
            text-decoration: underline;
        }
        .correct {
            font-weight: bold;
            color: green;
        }
    </style>
</head>
<body>
    
    <?php require("./navbar.php"); ?>

    <h1><?php echo htmlspecialchars($nome_test); ?></h1>
    <p>Data: <?php echo htmlspecialchars($data_test); ?></p>
    <p>Punteggio massimo: <?php echo htmlspecialchars($max_punteggio); ?></p>

    <h2>Domande:</h2>
    <ol>
        <?php foreach ($domande['domande'] as $domanda): ?>
            <li>
                <p><?php echo htmlspecialchars($domanda['testo']); ?></p>
                <p>Punteggio: <?php echo htmlspecialchars($domanda['punteggio']); ?></p>

                <?php if (!empty($domanda['hasOptions']) && $domanda['hasOptions']): ?>
                    <ul>
                        <?php foreach ($domanda['opzioni'] as $opzione): ?>
                            <li>
                                <?php echo htmlspecialchars(array_keys($opzione)[0]) . ": " . htmlspecialchars(array_values($opzione)[0]); ?>
                                <?php if ($opzione[array_keys($opzione)[0]] === true): ?>
                                    <span class="correct">(Corretta)</span>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ol>

    <a href="my_tests.php">Torna ai tuoi test</a>
</body>
</html>

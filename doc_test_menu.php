<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Test</title>
    <?php require("./include_bs_css.php"); ?>
    <style>
        a {
            color: black;
        }
        a:hover {
            color: #0d6efd;
        }
    </style>
</head>
<body class="bg-light">
    <?php require("./navbar.php"); ?>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Gestione Test</h1>
        <nav class="nav justify-content-center mb-4">
            <a href="visualizza_test.php?id=<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>" class="nav-link btn btn-outline-primary mx-2">
                Visualizza Test
            </a>
            <a href="visualizza_punteggi.php?id=<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>" class="nav-link btn btn-outline-primary mx-2">Visualizza Punteggi</a>
            <a href="correggi_test.php" class="nav-link btn btn-outline-primary mx-2">Correggi Test</a>
        </nav>
    </div>
</body>
</html>

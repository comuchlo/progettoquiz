<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <?php require("./include_bs_css.php"); ?>
    <style>
        body {
        }
        .contenuto {
            margin-top: 50px;
        }
        .hero-section {
            background: linear-gradient(135deg, #007bff,rgb(36, 115, 184));
            color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .hero-section h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        .hero-section p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }
        .button-container {
            margin-top: 20px;
        }
        .btn-custom {
            margin: 10px;
            padding: 10px 20px;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
    <?php require("./navbar.php"); ?>

    <div class="container contenuto">
        <div class="hero-section">
            <h1>Benvenuto</h1>
            <p>Gestione aggiuta utenti</p>
            <div class="button-container">
                <a href="insert_doc.php" class="btn btn-primary btn-custom">Aggiungi Docente</a>
                <a href="insert_studente.php" class="btn btn-secondary btn-custom">Aggiungi Studente</a>
            </div>
        </div>

        <div class="altro">
            <
        </div>
    </div>

    <?php require("./include_bs_js.php"); ?>
</body>
</html>

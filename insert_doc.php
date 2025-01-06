<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiunta Docente</title>
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
    <?php require("./navbar.php"); ?>

    <div class="container mt-5">
        <h1 class="text-center">Aggiungi Docente</h1>
        <form action="elabora_doc.php" method="post">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="cognome" class="form-label">Cognome</label>
                <input type="text" class="form-control" id="cognome" name="cognome" required>
            </div>
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
            <input type="hidden" name="ruolo" value="2">
            <button type="submit" class="btn btn-primary">Aggiungi Docente</button>
        </form>
    </div>

    <?php require("./include_bs_js.php"); ?>
</body>
</html>

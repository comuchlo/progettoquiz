<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My tests</title>
    <?php require("./include_bs_css.php"); ?>
</head>
<body>
<?php require("./navbar.php"); require_once("./db_connection.php"); require("./check_user.php") ?>

<form id="form" action="elabora_nuovo_test.php" method="post">

<div class="form-floating m-3">
  <input type="text" class="form-control" id="nome" placeholder="">
  <label for="floatingInput">Nome test</label>
</div>

<div class="d-flex justify-content-center py-5 pt-5">

    <div class="btn-group-vertical">
        <button  class="btn btn-outline-secondary btn-sm" onclick="aggiungi_domanda_aperta()">
            Aggiungi domanda aperta 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-blockquote-left" viewBox="0 0 16 16">
            <path d="M2.5 3a.5.5 0 0 0 0 1h11a.5.5 0 0 0 0-1zm5 3a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm-5 3a.5.5 0 0 0 0 1h11a.5.5 0 0 0 0-1zm.79-5.373q.168-.117.444-.275L3.524 6q-.183.111-.452.287-.27.176-.51.428a2.4 2.4 0 0 0-.398.562Q2 7.587 2 7.969q0 .54.217.873.217.328.72.328.322 0 .504-.211a.7.7 0 0 0 .188-.463q0-.345-.211-.521-.205-.182-.568-.182h-.282q.036-.305.123-.498a1.4 1.4 0 0 1 .252-.37 2 2 0 0 1 .346-.298zm2.167 0q.17-.117.445-.275L5.692 6q-.183.111-.452.287-.27.176-.51.428a2.4 2.4 0 0 0-.398.562q-.165.31-.164.692 0 .54.217.873.217.328.72.328.322 0 .504-.211a.7.7 0 0 0 .188-.463q0-.345-.211-.521-.205-.182-.568-.182h-.282a1.8 1.8 0 0 1 .118-.492q.087-.194.257-.375a2 2 0 0 1 .346-.3z"/>
            </svg>
        </button>
        <button  class="btn btn-outline-secondary btn-sm" onclick="aggiungi_scelta_multipla()">
            Aggiungi domanda a scelta multipla
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-ul" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
            </svg>
        </button>
    </div>

</div>

</form>

<script type="text/javascript">
    function aggiungi_domanda_aperta() {
        /*
        document.getElementById("form").innerHTML+='<div class="mb-3 p-3 border rounded form-floating">' +
                    '<p class="text-end mb-0">Punti</p>   <input type="number" class="form-control text-end-mb-0" id=""><label for="">Punti</label>'+
                    '<label class="form-label fw-medium" for="domanda.$i."></label>'+
                    '<br>'+
                    '<div class="px-1"><textarea class="form-control" name="domande[]" id="domanda.$i."></textarea></div></di>';
                    */
    }


    function aggiungi_scelta_multipla() {
        
    }
</script>

<?php require("./include_bs_js.php"); ?>
</body>
</html>
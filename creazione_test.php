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


<div class="m-3">
    <label for="nome">Nome test</label>
    <input type="text" class="form-control" id="nome" placeholder="Nome test">
</div>

<div id="domande" class="d-flex justify-content-center row mx-5 my-5 mt-5">

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


<script type="text/javascript">
    var c=0, cm=0;
    function aggiungi_domanda_aperta() {
        const pasqualini = document.createElement('div');
        pasqualini.id="domanda"+c;
        pasqualini.className="border rounded d-flex row mt-2 px-3 justify-content-center";
        pasqualini.innerHTML=innerHTML='<div class=" form-floating m-2 p-1">' +
                    '<input type="number" step="0.1" class="form-control form-control-sm" name="domande['+c+'][]"><label class="">Punti</label>'+
                    '</div>    <div class="form-floating m-2 p-1">'+
                    '<input type="text" class="form-control" name="domande['+c+'][]"><label class="">Domanda</label>'+
                    '</div>'+
                    '<div class="d-flex justify-content-center mb-2" ><button class="btn btn-outline-danger" onclick="rimuovi_domanda('+c+')">Rimuovi <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16"><path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/></svg></button></div>';
        document.getElementById("domande").appendChild(pasqualini);
        c++;
    }


    function aggiungi_scelta_multipla() {
        const pasqualini = document.createElement('div');
        pasqualini.id="domanda"+c;
        pasqualini.className="border rounded d-flex row mt-2 px-3 justify-content-center";
        pasqualini.innerHTML=innerHTML=
                    '<div class=" form-floating m-2 p-1">' +
                    '<input type="number" step="0.1" class="form-control form-control-sm" name="domande['+c+'][]"><label class="">Punti</label>'+
                    '</div>    <div class="form-floating m-2 p-1">'+
                    '<input type="text" class="form-control" name="domande['+c+'][]"><label class="">Domanda</label>'+
                    '</div> <div class="justify-content-start justify-items-center">'+
                    '<label class="mt-1 fs-5">Risposte</label>'+
                    '<button class="btn btn-sm btn-outline-primary rounded-circle ms-2" onclick="aggiungi_domanda_sm('+c+')" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/></svg></button>'+
                    '</div> <div id="risposte'+c+'" class="row">'+
                    '<div id="risposta_multipla'+cm+'"  class="row align-items-center mx-2 mb-2 p-1" ><div class="col-auto"><div class="form-check"><input type="checkbox" class="form-check-input" name="domande['+c+'][][]"></div></div> <div class="col-auto"><input type="text" class="form-control" placeholder="domanda" name="domande['+c+'][][]"></div><div class="col-auto"><button class="btn btn-outline-danger" onclick="elimina_risposta_multipla('+cm+')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16"><path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/></svg></button></div></div>'+
                    '</div>'+
                    '<div class="d-flex justify-content-center mb-2" ><button class="btn btn-outline-danger" onclick="rimuovi_domanda('+c+')">Rimuovi <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16"><path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/></svg></button></div>';
                    document.getElementById("domande").appendChild(pasqualini);
        c++;
        cm+=1;
    }

    function rimuovi_domanda(id) {
        document.getElementById("domanda"+id).remove();
    }

    function elimina_risposta_multipla(id){
        document.getElementById("risposta_multipla"+id).remove();
    }

    function aggiungi_domanda_sm(id_parent) {
        const pasqualini = document.createElement('div');
        pasqualini.id="risposta_multipla"+cm;
        pasqualini.className="row align-items-center mx-2 mb-2 p-1";
        pasqualini.innerHTML=innerHTML='<div class="col-auto"><div class="form-check"><input type="checkbox" class="form-check-input" name="domande['+id_parent+'][][]"></div></div> <div class="col-auto"><input type="text" class="form-control" placeholder="domanda" name="domande['+id_parent+'][][]"></div><div class="col-auto"><button class="btn btn-outline-danger" onclick="elimina_risposta_multipla('+cm+')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16"><path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/></svg></button></div></div>';
        document.getElementById("risposte"+id_parent).appendChild(pasqualini);
        cm++;
    }
</script>

<?php require("./include_bs_js.php"); ?>
</body>
</html>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("./db_connection.php"); 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_POST)){
    echo "qualcosa è andato storto (>﹏<。)";
    die();
}

$nome_test=$_POST['nome'];

$si=[];
$max=0.0;

$j=0;
foreach($_POST['domande'] as $domanda){
    $si['domande'][$j]['punteggio']=floatval($domanda[0]);
    $max+=floatval($domanda[0]);
    $si['domande'][$j]['testo']=$domanda[1];
    if(isset($domanda[2])&&is_array($domanda[2])){
        $si['domande'][$j]['hasOptions']=true;
        $i=2;
        $k=0;
        while (isset($domanda[$i])) {
            if($domanda[$i][0]=='0'){
               $si['domande'][$j]['opzioni'][$k]['isCorrect']=false; 
            }else{
               $si['domande'][$j]['opzioni'][$k]['isCorrect']=true; 
            }
            $si['domande'][$j]['opzioni'][$k]['txt']=$domanda[$i+1][0];
            $i+=2;
            $k+=1;
        }
    }else{
        $si['domande'][$j]['hasOptions']=false;
    }
    $j+=1;    
}
$json_domande= json_encode($si);


$sql= $conn->prepare("INSERT INTO `test`(`domande`, `docente`, `nome`, `max_punteggio`) VALUES (?,?,?,?)");
$sql->bind_param("sssd",$json_domande, $_SESSION['username'], $nome_test, $max);
if(!$sql->execute()){
    echo "qualcosa è andato storto (>﹏<。)";
    die();
}

header('location: my_tests.php');
die();

<?php
include_once '../model/pergunta.php';

if(!isset($_SESSION)){
    session_start();
}

session_cache_expire(10);

// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Salva duas variáveis com o que foi digitado no formulário
    // Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido
    $pergunta = new pergunta();
    
    $_SESSION["termo"] = (isset($_POST['termo_txt'])) ? $_POST['termo_txt'] : '';
    $_SESSION["termoCat"] = (isset($_POST['categoria_slt'])) ? $_POST['categoria_slt'] : '';
    header("Location: ../view/view_resultadopesquisa.php");
}


?>

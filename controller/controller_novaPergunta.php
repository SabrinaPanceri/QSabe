<?php
include '../model/pergunta.php';

if(!isset($_SESSION)){
    session_start();
}

session_cache_expire(10);

// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Salva duas variáveis com o que foi digitado no formulário
    // Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido
    $pergunta = new pergunta();
    $pergunta->user = $_SESSION["idusuario"];
    
    $pergunta->desc = (isset($_POST['pergunta_txt'])) ? $_POST['pergunta_txt'] : '';
    $pergunta->categoria = (isset($_POST['categoria_slt'])) ? $_POST['categoria_slt'] : '';

    if($pergunta->criarPergunta()){
        header("Location: ../view/view_pergunta.php?pergunta=".$pergunta->idpergunta);
    }  else {
        header("Location: ../view/view_novaPergunta.php");
    }
}


?>
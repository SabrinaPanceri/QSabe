<?php

include_once '../model/resposta.php';

if(!isset($_SESSION)){
    session_start();
}

session_cache_expire(10);

// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Salva duas variáveis com o que foi digitado no formulário
    // Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido
    $resposta = new resposta();
    $resposta->user = $_SESSION["idusuario"];
    $resposta->idpergunta = $_SESSION["idpergunta"];
    $_SESSION["idpergunta"] = '';
    $resposta->desc = (isset($_POST['resposta_txt'])) ? $_POST['resposta_txt'] : '';

    if($resposta->criarResposta()){
        header("Location: ../view/view_pergunta.php?pergunta=".$resposta->idpergunta);
    }  else {
        header("Location: ../view/view_novaPergunta.php");
    }
}


?>
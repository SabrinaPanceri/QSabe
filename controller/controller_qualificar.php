<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../model/resposta.php';

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
    $resposta->idresposta = $_SESSION["idresposta"];
    $_SESSION["idresposta"] = '';
    $nota = (isset($_POST['qualifica_slc'])) ? $_POST['qualifica_slc'] : '';
    $resposta->carregarIdperguntaByIdResposta();

    if($resposta->qualificaResposta($nota)){
        $_SESSION["msg"] = 'Qualificação Feita com sucesso';
        header("Location: ../view/view_pergunta.php?pergunta=".$resposta->idpergunta);
    }  else {
        $_SESSION["msg"] = 'Não foi possível salvar sua qualificação';
        header("Location: ../view/view_pergunta.php?pergunta=".$resposta->idpergunta);
    }
}


?>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../model/usuario.php';

if(!isset($_SESSION)){
    session_start();
}

session_cache_expire(10);

// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Salva duas variáveis com o que foi digitado no formulário
    // Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido
    $user = new usuario();
    
    $user->user = (isset($_POST['usuario_txt'])) ? $_POST['usuario_txt'] : '';
    $user->password = (isset($_POST['pass_txt'])) ? $_POST['pass_txt'] : '';
    $user->nome = (isset($_POST['nome_txt'])) ? $_POST['nome_txt'] : '';
    $user->data = (isset($_POST['data_txt'])) ? $_POST['data_txt'] : '';
    $user->nome_exibicao = (isset($_POST['nome_exibicao_txt'])) ? $_POST['nome_exibicao_txt'] : '';

    if($user->salvausuario()){
        header("Location: ../view/view_pessoal.php");
    }  else {
        header("Location: ../view/view_login.php");
    }
}


?>

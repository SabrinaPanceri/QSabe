<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Inclui o arquivo com o sistema de segurança
include("../model/usuario.php");
 
// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Salva duas variáveis com o que foi digitado no formulário
    // Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido
    $usuario = (isset($_POST['usuario_txt'])) ? $_POST['usuario_txt'] : '';
    $senha = (isset($_POST['pass_txt'])) ? $_POST['pass_txt'] : '';
    
    $user = new usuario();

    // Utiliza uma função criada no seguranca.php pra validar os dados digitados
    if ($user->validaUsuario($usuario, $senha) == true) {
            header("Location: ../view/view_pessoal.php");
        } else {
            header("Location: ../view/view_login.php");
        }
}

?>

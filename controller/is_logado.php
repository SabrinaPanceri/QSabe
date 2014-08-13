<?php
/* 
 * Verificar se Usuário está LOGADO
 *  Se não:  Envia para a página de login (index.php)
 * 
 *  Como Usar:
 *      No inicio de cada pagina php incluir:
 *      include_once("../controller/is_logado.php");
 */
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION["logado"]) || $_SESSION["logado"] != TRUE) {
    header("Location: ../index.php");
}

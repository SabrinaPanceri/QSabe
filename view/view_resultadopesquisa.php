<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
session_cache_expire(10);

//verificar se usuario está logado
include_once("../controller/is_logado.php");

session_cache_expire(10);
include_once "../model/pergunta.php";
include_once "../model/resposta.php";
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once 'head.php'; ?>
    </head>

    <body>
        <div class="container">
         <?php  $page = 'resultadopesquisa'; include_once 'menutopo.php'; ?>
            <div class="row clearfix">

                <?php include_once 'usuariosdados.php'; ?>
                            
                <div class="col-md-6 column">
                    <div class="list-group">
                        <h4 class="list-group-item-heading">
                            <a href="#" class="list-group-item active">Pergunta</a>
                        </h4>
                        <!-- COLOCAR FUNÇÃO PARA ALIMENTAR COM AS PERGUNTAS FEITAS PELO USUÁRIO-->
                        <?php
                        $perguntapag = new pergunta();
                        $termo = $_SESSION["termo"];
                        $termoCategoria = $_SESSION["termoCat"];
                        $_SESSION["termo"] = "";
                        echo $perguntapag->buscaPerguntaPorTermo($termo,$termoCategoria);
                        ?>
                    </div>
                
                </div>
            
            </div>

	<div style="clear: both;">&nbsp;</div>
        </div>
    
        <?php include_once 'footer.php' ?>

</body>
</html>





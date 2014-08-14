<?php
if (!isset($_SESSION)) {
    session_start();
}
session_cache_expire(10);
//verificar se usuario está logado
include_once("../controller/is_logado.php");
//echo $_SESSION['usuario'];
//echo '</br>';
//echo $_SESSION['nome'];
//echo '</br>';
//echo $_SESSION['tipo'];
include_once "../model/pergunta.php";
?>
<!DOCTYPE html>
<html lang="en">    
    <head>
        <?php include_once 'head.php'; ?>        
    </head>
    <body>
        <div class="container">

            <?php $page='mural'; include 'menutopo.php'; ?>

            <div class="row clearfix">            

                <?php include 'usuariosdados.php'; ?>   

                <div class="col-md-10 column">
                    <div class="panel panel-default">
                        <div class="panel-heading"><a href="#" class="pull-right">Ver todas</a> <h4>Relação de perguntas</h4></div>
                        <div class="panel-body">
                            <div class="list-group ">
                                <?php
                                $pergunta = new pergunta();
                                echo $pergunta->buscatodasperguntas();
                                ?>                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
        </div>

        <?php include_once "footer.php" ?>

    </body>
</html>





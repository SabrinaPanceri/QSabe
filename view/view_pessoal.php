<?php
if (!isset($_SESSION)) {
    session_start();
}
//verificar se usuario está logado
include_once("../controller/is_logado.php");
session_cache_expire(10);

include_once "../model/usuario.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'head.php'; ?>

    </head>

    <body>
        <div class="container">

            <?php include_once 'menutopo.php'; ?>


            <div class="row clearfix">

                <?php include_once 'usuariosdados.php'; ?>


                <div class="col-md-6 column">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 style="margin: 0">Suas Perguntas</h4>                        
                        </div>
                        <div class="panel-body">
                        <!-- COLOCAR FUNÇÃO PARA ALIMENTAR COM AS PERGUNTAS FEITAS PELO USUÁRIO-->
                        <?php
                        $usuario = new usuario();
                        $usuario->idusuario = $_SESSION["idusuario"];
                        echo $usuario->buscaperguntas();
                        ?>
                        </div>

                    </div>

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 style="margin: 0">Suas Respostas</h4>
                        </div>
                        <!-- COLOCAR FUNÇÃO PARA ALIMENTAR COM AS RESPOSTAS FEITAS PELO USUÁRIO-->
                        <div class="panel-body">
                            <?php
                            $usuario = new usuario();
                            $usuario->idusuario = $_SESSION["idusuario"];
                            echo $usuario->buscarespostas();
                            ?>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 column">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a class="panel-title" data-toggle="collapse" data-parent="#panel-638496" href="#panel-element-249930">Perguntas novas!</a>
                            </div>
                            <div id="panel-element-249930" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <!-- COLOCAR FUNÇÃO PARA ALIMENTAR COM AS PERGUNTAS NOVAS CADASTRADAS POR OUTROS USUÁRIOS-->
                                    <?php
                                        $usuario = new usuario();
                                        $usuario->idusuario = $_SESSION["idusuario"];
                                        echo $usuario->buscaperguntasmaisnovas();
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a class="panel-title" data-toggle="collapse" data-parent="#panel-638496" href="#panel-element-249930">Perguntas Para Eu Responder!</a>
                            </div>
                            <div id="panel-element-249930" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <!-- COLOCAR FUNÇÃO PARA ALIMENTAR COM AS PERGUNTAS NOVAS CADASTRADAS POR OUTROS USUÁRIOS-->
                                    <?php
                                        $usuario = new usuario();
                                        $usuario->idusuario = $_SESSION["idusuario"];
                                        echo $usuario->buscaPerguntasParaResponder();
                                    ?>
                                </div>
                            </div>
                        </div>
                </div>

            </div>

        </div>
        </div>

        <?php include_once 'footer.php' ?>

    </body>
</html>
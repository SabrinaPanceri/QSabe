<?php
session_start();
session_cache_expire(10);
//verificar se usuario está logado
include_once("../controller/is_logado.php");

if (!isset($_SESSION["logado"]) || $_SESSION["logado"] != TRUE) {
    header("Location: ../index.php");
}
session_cache_expire(10);
include_once "../model/categoria.php";
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include 'head.php'; ?>        
    </head>

    <body>
        <div class="container">

            <?php $page='pergunta'; include 'menutopo.php'; ?>

            <div class="row clearfix">

                <?php include 'usuariosdados.php'; ?>


                <div class="col-md-6 column">
                    <form class="form form-vertical" name="pergunta_form" method="post" action="/qsabe/controller/controller_novaPergunta.php">
                        <div class="control-group">
                            <label>Título da pergunta</label>
                            <div class="controls">
                                <input type="text" class="form-control"  name="pergunta_txt"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label>Categoria</label>
                            <div class="controls">
                                <select class="form-control" name="categoria_slt">
                                    <?php
                                    $categoria = new categoria();
                                    $html = $categoria->listarCategoriasSite();
                                    if ($html === NULL) {
                                        //nenhuma categoria disponivel
                                        echo '<option value="0">Categoria</option>';
                                    } else {
                                        echo $html;
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>    
                        <div class="control-group">
                            <label></label>
                            <div class="controls">
                                <button type="submit" class="btn btn-default" name="pergunta_btn">
                                    Enviar
                                </button>
                            </div>
                        </div>   
                    </form>
                </div>
                <div class="col-md-4 column">
                    <div class="panel-group" id="panel-638496">
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
                    </div>
                </div>
            </div>
        </div>

        <?php include_once 'footer.php' ?>       

    </body>
</html>





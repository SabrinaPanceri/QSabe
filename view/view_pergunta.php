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


if (!isset($_SESSION["logado"]) || $_SESSION["logado"] != TRUE) {
    header("Location: ../index.php");
}
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
            <?php $page = 'pergunta';
            include_once 'menutopo.php'; ?>
            <div class="row clearfix">

<?php include_once 'usuariosdados.php'; ?>


                <div class="col-md-6 column">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 style="margin: 0">
                                Pergunta
                            </h4>
                        </div>
                        <div class="panel panel-body">
                            <!-- COLOCAR FUNÇÃO PARA ALIMENTAR COM AS PERGUNTAS FEITAS PELO USUÁRIO-->
                            <?php
                            $perguntapag = new pergunta();
                            $perguntapag->idpergunta = $_GET["pergunta"];
                            $_SESSION["idpergunta"] = $perguntapag->idpergunta;
                            $perguntapag->carregarPergunta();
                            echo '<div class="thumbimguser medio"><img src="'.$perguntapag->imguser.'" /></div>';
                            echo $perguntapag->desc;
                            echo '</br></br><div class="assinatura">by: ' . $perguntapag->nome_user . '  ' . $perguntapag->data_reg.' </div>';
                            ?>

                            <form name="resposta_form" method="post" action="../controller/controller_novaReposta.php">
                                </br>
                                <textArea rows="3" cols="50" name="resposta_txt" class="form-control" style="resize:vertical" placeholder="Digite Aqui sua Resposta!"></textarea>
                                </br>
                                <input type="submit" class="btn btn-default" name="resposta_btn" value="Adicionar Resposta"/> 
                            </form>
                            
                        </div>
                        
                    </div>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h4 style="margin: 0">Respostas Sugeridas</h4>
                        </div>
                        <div class="panel-body">
                            <div class="respsugeridas">
                                <?php
                                $perguntapag->idpergunta = $_GET["pergunta"];
                                $_SESSION["idpergunta"] = $perguntapag->idpergunta;

                                $respostapag1 = new resposta();
                                $respostapag1->idpergunta = $_GET["pergunta"];
                                $respostapag1->user = $_SESSION["idusuario"];
                                echo $respostapag1->buscarespostaspararecomendacao();
                                ?>                            
                            </div>
                        </div>
                    </div>
        <!-- end header -->
        <hr />
        
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 style="margin: 0">
                           Respostas
                        </h4>
                    </div>
                    <div class="panel-body">
                        <!-- COLOCAR FUNÇÃO PARA ALIMENTAR COM AS RESPOSTAS FEITAS PELO USUÁRIO-->
                        <div class="list-group-item">
                                <?php
                                $respostapag = new resposta();
                                $respostapag->idpergunta = $_GET["pergunta"];
                                $respostapag->user = $_SESSION["idusuario"];
                                $respostapag->verificaRespostas();

                                if ($respostapag->respostas > 0) {
                                    echo $respostapag->buscarespostas();
                                }
                                ?>
                        </div>
                    </div>
                </div>
            </div>        
            
            </div>

	<div style="clear: both;">&nbsp;</div>
        </div>
<!-- end page -->
<hr />
    
        <?php include_once 'footer.php' ?>

</body>
</html>





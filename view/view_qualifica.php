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
        <?php include 'head.php'; ?>

    </head>

    <body>
        <div class="container">
         <?php  $page = 'qualifica'; include_once 'menutopo.php'; ?>
            <div class="row clearfix">

                <?php include_once 'usuariosdados.php'; ?>
            
                
                <div class="col-md-6 column">
                    <div class="list-group">
                        <form name="frm_qualificar" method="post" action="../controller/controller_qualificar.php">
                        <h4 class="list-group-item-heading">
                            <a href="#" class="list-group-item active">Avalia a Resposta a está Pergunta</a>
                        </h4>
                        <!-- COLOCAR FUNÇÃO PARA ALIMENTAR COM AS PERGUNTAS FEITAS PELO USUÁRIO-->
                        <?php
                        $_SESSION["idresposta"] = '';
                        $perguntapag = new pergunta();
                        $respostapag = new resposta();
                        $respostapag->idresposta = $_GET["resposta"];
                        $_SESSION["idresposta"] = $respostapag->idresposta;
                        $respostapag->carregarIdperguntaByIdResposta();
                        $perguntapag->idpergunta = $respostapag->idpergunta;
                        $_SESSION["idpergunta"] = $perguntapag->idpergunta;
                        $perguntapag->carregarPergunta();
                        echo $perguntapag->desc;
                        echo '</br><div class="assinatura">by:'.$perguntapag->nome_user.'</div>';
                        echo '</br></br></br>';
                        echo $respostapag->buscaresposta();
                        ?>
                        <select name="qualifica_slc">
                                <option value="10">10</option>
                                <option value="9">9</option>
                                <option value="8">8</option>
                                <option value="7">7</option>
                                <option value="6">6</option>
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                                <option value="0">0</option>
                        </select>  <input type="submit" name="qualifica_btn" value="Qualificar"/>
                        </form>
                    </div>
        <!-- end header -->
        <hr />
                </div>
            
            </div>

	<div style="clear: both;">&nbsp;</div>
        </div>
<!-- end page -->
<hr />
    
            <?php include_once 'footer.php' ?>

</body>
</html>





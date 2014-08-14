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
include_once "../model/categoria.php";
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once 'head.php'; ?>

    </head>

    <body>
        <div class="container">
         <?php  $page = 'pergunta'; include_once 'menutopo.php'; ?>
            <div class="row clearfix">

                <?php include_once 'usuariosdados.php'; ?>
            
                
                <div class="col-md-6 column">
                    <div class="list-group">
                        <h4 class="list-group-item-heading">
                            <a href="#" class="list-group-item active">Pesquisa de Pergunta</a>
                        </h4>

                    <div class="row clearfix">
                    <div class="col-md-8 column">
                        <form role="form" method="post" action="../controller/controller_pesquisapergunta.php" onsubmit="return valida(this);">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Termo para Pesquisa </label>
                            <input type="text"  name="termo_txt" maxlength="45" class="form-control" id="exampleInputEmail1">
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEspecialidade">Categoria </label>
                            <select class="form-control" name="categoria_slt">
                                <?php
                                    $categoria = new categoria();
                                    $html = $categoria->listarCategoriasSite();
                                    if($html===NULL){
                                        echo '<option value="0">Categoria</option>';
                                    }  else {
                                        echo $html;
                                    }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" value="Buscar">Buscar</button>
                    </form>                    
                </div>
                        </form>
                        </br>
                        
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





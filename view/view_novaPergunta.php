<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
session_cache_expire(10);


if(!isset($_SESSION["logado"])||$_SESSION["logado"] !=TRUE){
    header("Location: ../view/view_login.php");
}
session_cache_expire(10);
include("../model/categoria.php");

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>QSABE - REMAKE</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="../style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<!-- start header -->
<div id="header">
	<div id="menu">
		<ul>
			<li><a href="../index.php">Home</a></li>
                        <li><a href="../view/view_pessoal.php">Pagina Pessoal</a></li>
                        <li class="current_page_item"><a href="../view/view_novaPergunta.php">Nova Pergunta</a></li>
                        <li ><a href="../view/view_mural.php">Mural</a></li>
			<li><a href="#">About</a></li
		</ul>
	</div>
    <div id="menu2">
		<?php
                echo '<a href="../view/view_pessoal.php">Bem vindo! '.$_SESSION['nome_exibicao'].'</a>';
                echo '<a href="../controller/controller_Logoff.php">Logout</a>';
                ?>
	</div>
</div>
<!-- end header -->
<hr />
<!-- start page -->
<div id="page">
	<!-- start content -->
	<div id="content">
		<div class="post">
			<h1 class="title">Nova Pergunta</h1>
                        <div class="entry">
                            <form name="pergunta_form" method="post" action="/qsabe/controller/controller_novaPergunta.php">
                            </br></br></br>    
                        <textArea rows="5" cols="50" name="pergunta_txt">Digite Aqui sua Pergunta!</textarea>
                            </br>
                            Categoria: 
                            </br>
                            <select name="categoria_slt">
                                <?php
                                    $categoria = new categoria();
                                    $html = $categoria->listarCategoriasSite();
                                    if($html===NULL){
                                        //nenhuma categoria disponivel
                                        echo '<option value="0">Categoria</option>';
                                    }  else {
                                        echo $html;
                                    }
                                ?>
                            </select>
                            <input type="submit" name="pergunta_btn" value="Fazer Pergunta"/>
                            </br>
                            </br>
                            </br>
                            </form>
			</div>
		</div>
	</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<!-- end page -->
<hr />
<!-- start footer -->
<div id="footer">
	<p>&copy;2007 All Rights Reserved. &nbsp;&bull;&nbsp; Designed by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a>.</p>
</div>
<!-- end footer -->


</body>
</html>





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
			<li class="current_page_item"><a href="../index.php">Home</a></li>
                        <li><a href="#">About</a></li>
		</ul>
	</div>
</div>
<!-- end header -->
<hr />
<!-- start page -->
<div id="page">
	<!-- start content -->
	<div id="content">
		<div class="post">
			<h1 class="title">Autenticação de Usuário</h1>
                        <div class="entry">
                            <form method="post" action="../controller/controller_autenticar.php">
                            </br></br></br>    
                            Usuário: 
                            </br>
                            <input type="text" name="usuario_txt" maxlength="45" /></br>
                            </br>
                            Senha: 
                            </br><input type="password" name="pass_txt" maxlength="45" /></br>
                            </br>
                            <input type="submit" value="Entrar" />
                            </form>
                            <p>Não possui cadastro ?<a href="../view/view_CriarConta.php"> Clique aqui para se cadastrar</a> </p>
                            </br>
                            </br>
                            <?php
                                session_start('');
                                session_cache_expire(10);
                                if($_SESSION!=NULL){
                                $mensagem = $_SESSION['msg_error'];
                                if(strlen($mensagem)>1){
                                    echo '<p>'.$mensagem.'</p>';
                                }
                                }
                            ?>
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
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>QSABE - REMAKE</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="../style.css" rel="stylesheet" type="text/css" media="screen" />

<script>
        function valida(form) {
            if (form.usuario_txt.value==="" || form.usuario_txt.value.length > 45) {
                alert("Preencha o nome corretamente.");
                form.usuario_txt.focus();
                return false;
            }
            var filtro_mail = /^.+@.+\..{2,3}$/;
            if (!filtro_mail.test(form.usuario_txt.value) || form.usuario_txt.value=="") {
                alert("Preencha o e-mail corretamente.");
                form.usuario_txt.focus();
                return false;
            }
            if (form.pass_txt.value=="" || form.pass_txt.value.length < 6) {
                alert("Preencha a senha corretamente. Ela deve conter no minímo 6 caracteres");
                form.pass_txt.focus();
                return false;
            }
            if (form.pass2_txt.value=="" || form.pass2_txt.value.length < 6) {
                alert("Preencha a senha corretamente. Ela deve conter no minímo 6 caracteres");
                form.pass2_txt.focus();
                return false;
            }
            if (form.pass_txt.value!=form.pass2_txt.value) {
                alert("A senha e a confirmação tem de ser iguais.");
                form.pass2_txt.focus();
                return false;
            }
            if (form.data_txt.value=="" || form.data_txt.value.length > 10) {
                alert("Preencha a data de nascimento corretamente.");
                form.data_txt.focus();
                return false; 
            }
            if (form.nome_txt.value=="" || form.nome_txt.value.length > 45) {
                alert("Preencha o nome corretamente.");
                form.nome_txt.focus();
                return false;
            }
        }
</script>

</head>
<body>
<!-- start header -->
<div id="header">
	<div id="menu">
		<ul>
			<li><a href="../index.php">Home</a></li>
                        <li><a href="../view/view_login.php">Login</a></li>
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
			<h1 class="title">Criar Conta de Usuário</h1>
                        <div class="entry">
                            <form method="post" action="../controller/controller_criarusuario.php" onsubmit="return valida(this);">
                            </br></br></br>    
                            Email: 
                            </br>
                            <input type="text" name="usuario_txt" maxlength="45" /></br>
                            </br>
                            Senha: 
                            </br><input type="password" name="pass_txt" maxlength="45" /> (Mínimo: 6 caracteres)</br>
                            </br>
                            Confirmar Senha: 
                            </br><input type="password" name="pass2_txt" maxlength="45" /></br>
                            </br>
                            Nome Completo: 
                            </br><input type="text" name="nome_txt" maxlength="45" /></br>
                            </br>
                            Nome para exibição: 
                            </br><input type="text" name="nome_exibicao_txt" maxlength="45" /></br>
                            </br>
                            Data de Nascimento: 
                            </br><input type="text" name="data_txt" maxlength="10" /> (Formato: DD/MM/AAAA)</br>
                            </br>
                            <input type="submit" value="Criar Conta" />
                            </form>
                            </br>
                            </br>
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
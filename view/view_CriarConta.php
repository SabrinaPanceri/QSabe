<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>QSabe / Cadastro</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet">

        <script type="text/javascript" src="../js/jquery.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/scripts.js"></script>
        
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
        <div class="container">
            <div class="row clearfix">
                <div class="col-md-12 column">
                    <div class="page-header">
                        <ul class="nav nav-pills">
                            <li class="active">
                                <a href="index.html">Inicial</a>
                            </li>
                            <li>
                                <a href="sobre.html">Sobre</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-md-8 column">
                    <form role="form" method="post" action="../controller/controller_criarusuario.php" onsubmit="return valida(this);">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nome Completo </label>
                            <input type="text"  name="usuario_txt" maxlength="45" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nome para exibição </label>
                            <input type="text" name="nome_exibicao_txt" maxlength="45" class="form-control" id="exampleInputEmail1">
                        </div>	
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nome para exibição </label>
                            <input type="text" name="data_txt" maxlength="10" class="form-control" id="exampleInputEmail1">
                            <small>(Formato: DD/MM/AAAA)</small>
                        </div>	
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email </label>
                            <input type="email" name="usuario_txt" maxlength="45" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Senha</label>
                            <input type="password" name="pass_txt" maxlength="45"  class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Confirme a senha </label>
                            <input type="password" name="pass2_txt" maxlength="45" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Foto </label>
                            <input type="file" id="exampleInputFile">
                            <p class="help-block">
                            </p>
                        </div>
                        <button type="submit" class="btn btn-primary" value="Criar Conta">Criar Conta</button>
                    </form>                    
                </div>
                <div class="col-md-4 column">
                    <img src="../img/ideia.jpg" class="img-circle">
                </div>
            </div>
        </div>
        
        <?php include_once 'footer.php'?>
        
    </body>
</html>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>QSabe</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script type="text/javascript" src="../js/jquery.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/scripts.js"></script>
    </head>

    <body>
        <div class="container">
            <div class="row clearfix">
                <div class="col-md-12 column">
                    <div class="page-header">
                        <h1>
                            QSabe <small>Um ambiente de convivência esclarecedor!</small>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-md-2 column">
                    <img src="img/ideia.jpg" class="img-responsive">
                </div>
                <div class="col-md-6 column">
                    <h3>
                        Sobre
                    </h3>
                    <p>
                        Este projeto apresenta um protótipo do sistema QSabe, proposto por Fulano em 20XX. Em sua dissertação, o autor apresenta um sistema de perguntas e respostas. Neste sentindo, apresentamos um protótipo funcional com funcionalidades de autenticação de seção, cadastramento de perguntas, cadastramento de respostas, busca por respostas enviadas para uma mesma pergunta, edição de pergutas já cadastrados e a lista de perguntas e respostas cadastradas por todos os usuários do sistema....
                    </p>
                    <p>
                        <a class="btn" href="view/view_sobre.php">..continua »</a>
                    </p>
                </div>
                <div class="col-md-4 column">
                    <form class="form-horizontal" role="form" action="./controller/controller_autenticar.php" method="post">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Usuario </label>
                            <div class="col-sm-10">
                                <input type="text" name="usuario_txt" maxlength="45" class="form-control" id="inputEmail3" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Senha </label>
                            <div class="col-sm-10">
                                <input type="password" name="pass_txt" maxlength="45" class="form-control" id="inputPassword3" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label><input type="checkbox"> Lembrar dados </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default" value="Entrar"> Entrar </button>
                                <a class="btn btn-default" href="view/view_criarconta.php"> Cadastrar </a>
                            </div>
                        </div>
                    </form>
                    <?php
                    session_start('');
                    session_cache_expire(10);
                    if ($_SESSION != NULL) {
                        $mensagem = $_SESSION['msg_error'];
                        if (strlen($mensagem) > 1) {
                            echo '<p>' . $mensagem . '</p>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <p>Copyright &copy; Grupo 2 AICV - Eduardo, Guilherme e Sabrina </p>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
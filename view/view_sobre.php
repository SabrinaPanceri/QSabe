<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once "head.php"; ?>
    </head>

    <body>
        <div class="container">

            <?php $page='sobre'; include 'menutopo.php'; ?>             

            <div class="row">
                <div class="box">
                    <div class="col-lg-12">
                        <hr>
                        <h2 class="intro-text text-center"> Sobre o 
                            <strong> QSabe </strong>
                        </h2>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <img class="img-responsive img-border-left" src="../img/ideia.jpg" alt="">
                    </div>
                    <div class="col-md-6">
                        <p>
                            Este projeto apresenta um protótipo do sistema QSabe. Proposto por Fulano em 20XX em sua dissertação de mestado, o autor apresenta um sistema de perguntas e respostas com funcionalidades inovadoras à época.
                        </p>
                        <p>
                            Diante deste contexto, a disciplina "Ambientes inteligentes para comunidades virtuais" apresentou como proposta o desenvolvimento de um remake do QSabe. O protótipo funcional foi desenvolvido com algumas características do projeto original, contudo utilizamos várias tecnologias novas para melhorar, principalmente, a interface e ambientação de novos usuários.
                        </p>
                        <p>
                            Neste sentindo, este protótipo funcional apresenta funcionalidades de autenticação de seção, cadastramento de perguntas, cadastramento de respostas, busca por respostas enviadas para uma mesma pergunta, edição de pergutas já cadastrados e a lista de perguntas e respostas cadastradas por todos os usuários do sistema. 
                        </p>
                        <p>
                            As telas do protótipo foram desenvolvidas com base no projeto Bootstrap, logo, este projeto pode ser acessado de qualquer dispositivo que possua um navegador (web browser).
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>            


            <div class="row">
                <div class="box">
                    <div class="col-lg-12">
                        <hr>
                        <h2 class="intro-text text-left">Nossa
                            <strong>Equipe</strong>
                        </h2>
                        <hr>
                    </div>
                    <div class="col-sm-4 text-left" style="text-align: center;">
                        <img class="img-circle" src="../img/dudu.jpg" alt="">
                        <h3>Eduardo Lopes </h3>
                    </div>
                    <div class="col-sm-4 text-left" style="text-align: center;">
                        <img class="img-circle" src="../img/gui.png" alt="">
                        <h3>Guilherme Marques </h3>
                    </div>
                    <div class="col-sm-4 text-left" style="text-align: center;">
                        <img class="img-circle" src="../img/sabrina.jpg" alt="">
                        <h3>Sabrina Panceri </h3>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>            

        </div>

        <?php include_once "footer.php" ?>

    </body>

</html>
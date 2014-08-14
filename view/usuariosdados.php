        <div class="col-md-2 column">
            <!--<img alt="140x140" src="img/ideia.jpg" class="img-responsive">-->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Seus dados
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="dadosuser">
                        <div class="dadosuserimg">
                            <img src="../img/users/<?php echo $_SESSION['imguser']?>">
                        </div>
                        <div class="dadosusernome">
                            <?php
                                echo $_SESSION['nome_exibicao'];                            
                            ?>                        
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <?php
                    include_once '../model/usuario.php';
                                $usuario = new usuario();
                                $usuario->idusuario = $_SESSION["idusuario"];
                                echo "Avaliação das Respostas: ".$usuario->buscaQualificacaoUsuario();
                    ?>
                    
                </div>
            </div>
        </div>
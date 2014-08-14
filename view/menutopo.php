<?php if(!isset($page)){$page='inicial';}?>
<div class="row clearfix">
        <div class="col-md-12 column">
            <div class="page-header">
                <ul class="nav nav-pills">
                    <li class="<?php echo ($page=='inicial')? "active":"";?>" >
                        <a href="../index.php">Inicial</a>
                    </li>
                    <li class="<?php echo ($page=='pessoal')?"active":"";?>" >
                        <a href="view_pessoal.php">Pessoal</a>
                    </li>
                    <li class="dropdown <?php echo ($page=='pergunta')? "active":"";?>">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Perguntas<strong class="caret"></strong> </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="view_novaPergunta.php">Cadastrar</a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="view_pesquisarpergunta.php">Pesquisar</a>
                            </li>
                        </ul>
                    </li>

                    <li class="<?php echo ($page=='mural')? "active":"";?>" >
                        <a href="view_mural.php">Mural</a>
                    </li>
                    <li class="<?php echo ($page=='sobre')? "active":"";?>" >
                        <a href="view_sobre.php">Sobre</a>
                    </li>
                    <li class="<?php echo ($page=='sobre')? "active":"";?> pull-right" >                        
                        <a href="../controller/controller_logoff.php">Sair</a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </div>
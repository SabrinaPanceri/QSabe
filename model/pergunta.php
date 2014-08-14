<?php
include_once '../BD/BD.php';

if (!isset($_SESSION)) {
    session_start();
}

session_cache_expire(10);

class pergunta {

    var $banco;
    var $user;
    var $imguser;
    var $nome_user;
    var $desc;
    var $categoria;
    var $idpergunta;
    var $data_reg;
    var $respostas;

    public function __construct() {
        $this->banco = new BD();
        $this->banco->conecta();
    }

    public function criarPergunta() {
        //cria usuario
        $_SESSION['msg_error'] = '';
        //verifica se a pergunta existe
        $pergunta = mysql_escape_string(utf8_encode(trim($this->desc)));
        $sql = 'select count(idpergunta) as contador from qsaberemake.pergunta where desc_pergunta like \'' . $pergunta . '\'';
        $result = $this->banco->executequery($sql);
        $row = mysqli_fetch_assoc($result);
        if ($row["contador"] > 0) {
            $_SESSION['msg_error'] = 'Pergunta Já Existe';
            return FALSE;
        }

        //Salva Pergunta
        $sql = 'insert into qsaberemake.pergunta (desc_pergunta,data_reg,idusuario)'
                . 'values (\'' . $pergunta . '\',now(),' . $this->user . ')';
        $this->banco->executequery($sql);

        //busca no bd o id da pergunta
        $sql2 = 'select idpergunta from qsaberemake.pergunta where desc_pergunta like \'' . $pergunta . '\'';
        $result2 = $this->banco->executequery($sql2);

        //armazena o id da pergunta
        $row = mysqli_fetch_assoc($result2);
        $this->idpergunta = $row['idpergunta'];

        $sql3 = 'insert into qsaberemake.categoria_pergunta (idcategoria,idpergunta)'
                . 'values (' . $this->categoria . ',' . $this->idpergunta . ')';
        $this->banco->executequery($sql3);


        return TRUE;
    }

    function carregarPergunta() {
        //cria usuario
        $_SESSION['msg_error'] = '';
        //verifica se a pergunta existe
        $sql = 'select desc_pergunta,data_reg,idusuario from qsaberemake.pergunta where idpergunta =' . $this->idpergunta;
//        die($sql);
        $result = $this->banco->executequery($sql);
        $row = mysqli_fetch_assoc($result);
        $this->desc = utf8_decode($row["desc_pergunta"]);
        $this->user = $row["idusuario"];
        $this->data_reg = $row["data_reg"];

        //verifica se a pergunta existe
        $sql = 'select nome_exibicao,imguser, count(idusuario) as contadoruser from qsaberemake.usuario where idusuario =' . $this->user;        
        $result = $this->banco->executequery($sql);               
        $row = mysqli_fetch_assoc($result);
        $this->imguser = "../img/users/".($row['imguser'] =='' ? 'userdefault.jpg' : $row['imguser'] );
        if ($row["contadoruser"] == 0) {
            $_SESSION['nome_exibicao'] = 'Usuário Não encontrado';
            $this->nome_user = 'Usuário Não encontrado';
        } else {
            $this->nome_user = utf8_decode($row["nome_exibicao"]);
        }

        $sql = 'select count(idresposta) as contadorresposta from qsaberemake.resposta where idpergunta =' . $this->idpergunta;
        $result = $this->banco->executequery($sql);
        $row = mysqli_fetch_assoc($result);
        $this->respostas = $row["contadorresposta"];

        return TRUE;
    }

    function buscarespostas() {
        //cria usuario
        $_SESSION['msg_error'] = '';
        $html_geral = '';
        //verifica se a pergunta existe
        $sql = 'select desc_resposta,data_reg,idresposta,idusuario from qsaberemake.resposta where idpergunta =' . $this->idpergunta . ' order by data_reg desc';
        $result = $this->banco->executequery($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $sql2 = 'select nome_exibicao from qsaberemake.usuario where idusuario =' . $row["idusuario"];
            $result2 = $this->banco->executequery($sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $html = '<div class="post"> <div class="entry"><p>' . utf8_decode($row["desc_resposta"]) . '</p></br></br>by:' . utf8_decode($row2["nome_exibicao"]) . ', ' . $row["data_reg"] . ' </div> </div>';
            $html_geral = $html_geral . $html;
        }
        return $html_geral;
    }

    function buscatodasperguntas() {

        //cria usuario
        $_SESSION['msg_error'] = '';
        $html_geral = '';
        //verifica se a pergunta existe
        $sql = 'select desc_pergunta,data_reg,idpergunta,idusuario from qsaberemake.pergunta order by data_reg desc';
        $result = $this->banco->executequery($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $sql2 = 'select nome_exibicao,imguser from qsaberemake.usuario where idusuario =' . $row["idusuario"];
            $result2 = $this->banco->executequery($sql2);
            $row2 = mysqli_fetch_assoc($result2);

            $idpergunta = $row["idpergunta"];
            $desc_pergunta = utf8_decode($row["desc_pergunta"]);
            $nome_exibicao = utf8_decode($row2["nome_exibicao"]);
            $data_reg = $row["data_reg"];
            $resp_imguser = "../img/users/".($row2['imguser'] =='' ? 'userdefault.jpg' : $row2['imguser'] );
            
            $html = "<li class='list-group-item' id='$idpergunta'>     
                        <div class='thumbimguser medio'><img src='".$resp_imguser."' /></div>
                        <a href='../view/view_pergunta.php?pergunta=$idpergunta'>$desc_pergunta</a></p><div class='assinatura'>by:$nome_exibicao date:$data_reg</div>
                    </li>";

            $html_geral = $html_geral . $html;
        }
        return $html_geral;
    }

    
    function buscaPerguntaPorTermo($termo,$termoCategoria) {
        //cria usuario
        $_SESSION['msg_error'] = '';
        $html_geral = '';
        
        //verifica se a pergunta existe
        $sql = 'select desc_pergunta,perg.data_reg,perg.idpergunta,perg.idusuario,catpeg.idcategoria from qsaberemake.pergunta perg join qsaberemake.categoria_pergunta catpeg on (perg.idpergunta = catpeg.idpergunta) where desc_pergunta like \'%'.$termo.'%\' and idcategoria = '.$termoCategoria.' order by data_reg desc';
        $result = $this->banco->executequery($sql);
        if(mysqli_num_rows($result)==0){
                $html_geral = 'Nenhum Registro Encontrado.';
                return $html_geral;
            }
        while ($row = mysqli_fetch_assoc($result)) {
            
            $sql2 = 'select nome_exibicao from qsaberemake.usuario where idusuario =' . $row["idusuario"];
            $result2 = $this->banco->executequery($sql2);
            $row2 = mysqli_fetch_assoc($result2);

            $idpergunta = $row["idpergunta"];
            $desc_pergunta = utf8_decode($row["desc_pergunta"]);
            $nome_exibicao = utf8_decode($row2["nome_exibicao"]);
            $data_reg = $row["data_reg"];

            $html = "<li class='list-group-item' id='$idpergunta'>                        
                        <a href='../view/view_pergunta.php?pergunta=$idpergunta'>$desc_pergunta</a></p><div class='assinatura'>by:$nome_exibicao date:$data_reg</div>
                    </li>";

            $html_geral = $html_geral . $html;
        }
        return $html_geral;
    }
    
}

?>
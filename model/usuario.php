<?php

include_once '../BD/BD.php';


if (!isset($_SESSION)) {
    session_start();
}

session_cache_expire(10);

class usuario {

    var $banco;
    var $user;
    var $idusuario;
    var $nome;
    var $nome_exibicao;
    var $password;
    var $data;
    var $especialidade;
    var $imguser;
    

    public function __construct() {
        $this->banco = new BD();
        $this->banco->conecta();
    }

    function validaUsuario($usuario, $senha) {
        if ($this->pesquisabanco($usuario, $senha)) {
            return true;
        } else {
            return FALSE;
        }
    }

    function pesquisabanco($usuario, $senha) {
        $_SESSION['msg_error'] = '';
        //verifica se o usuário existe
        $sql = 'select nome,tipo,nome_exibicao from qsaberemake.usuario where login = \'' . $usuario . '\'';
//    $banco = new BD();
//    $banco->conecta();
        $result = $this->banco->executequery($sql);

        if (mysqli_num_rows($result) > 0) {
            //verifica se a senha está correta
            $sql = 'select idusuario,nome,tipo,imguser,nome_exibicao from qsaberemake.usuario where login = \'' . $usuario . '\' and senha = \'' . $senha . '\'';
            $result = $this->banco->executequery($sql);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $_SESSION["usuario"] = $usuario;
                $_SESSION["idusuario"] = $row['idusuario'];
                $this->idusuario = $row['idusuario'];
                $_SESSION["nome"] = utf8_decode($row['nome']);
                $_SESSION["nome_exibicao"] = utf8_decode($row['nome_exibicao']);
                $_SESSION["tipo"] = $row['tipo'];
                $_SESSION["imguser"] = ( $row['imguser'] =='' ? 'userdefault.jpg' : $row['imguser'] );
                $_SESSION["logado"] = TRUE;
                return TRUE;
            } else {
                $_SESSION['msg_error'] = 'Senha Incorreta';
                return false;
            }
        } else {
            $_SESSION['msg_error'] = 'Usuário não encontrado';
            return false;
        }
    }

    function verificausuario($login) {
        $_SESSION['msg_error'] = '';
        //verifica se o usuário existe
        $sql = 'select nome,tipo from qsaberemake.usuario where login = \'' . $login . '\'';
        $result = $this->banco->executequery($sql);

        if (mysqli_num_rows($result) == 0) {
            return TRUE;
        } else {
            $_SESSION['msg_error'] = 'Usuário já existe';
            return false;
        }
    }

    function salvausuario() {
        if(!$this->verificausuario($this->user)){
         
        return false;
    }  else {
        
        //acerta a data
        $data = substr($this->data, -4, 4).substr($this->data, -8, 3).'/'.substr($this->data, -10, 2);
        //cria usuario
        $_SESSION['msg_error']= '';
        //verifica se o usuário existe
        $sql = 'insert into qsaberemake.usuario (nome,login,senha,tipo,data_nascimento,data_reg,nome_exibicao,imguser)'
                . 'values (\''.  $this->nome.'\',\''.$this->user.'\',\''.$this->password.'\',2,\''.$data.'\',now(),\''.$this->nome_exibicao.'\',\''.$this->imguser.'\')';
        $this->banco->executequery($sql);
        //preenche variaveis
        $this->pesquisabanco($this->user,  $this->password);
        //salva especialidade
        $sql = 'insert into qsaberemake.usuario_especialista (idusuario,idcategoria,nota_especialista)'
                . 'values ('.  $this->idusuario.','.$this->especialidade.',8)';
        $this->banco->executequery($sql);
        $_SESSION["logado"] = TRUE;
        
        return true;
        }
    }

    function buscaperguntas() {

        //cria usuario
        $_SESSION['msg_error'] = '';
        $html_geral = '';
        //verifica se a pergunta existe
        $sql = 'select desc_pergunta,data_reg,idpergunta from qsaberemake.pergunta where idusuario =' . $this->idusuario . ' order by data_reg desc';
        $result = $this->banco->executequery($sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $idpergunta = $row["idpergunta"];
            $desc_pergunta = utf8_decode($row["desc_pergunta"]);
            $data_reg = $row["data_reg"];
            $html = "<div class='post'>
                        <div class='entry list-group-item' id='$idpergunta'>
                            <p><a href='../view/view_pergunta.php?pergunta=$idpergunta'>
                                $desc_pergunta
                            </a>
                            </p>
                               date:$data_reg 
                        </div>
                     </div>";
            $html_geral = $html_geral . $html;
        }
        return $html_geral;
    }
    
    function buscaperguntasmaisnovas() {

        //cria usuario
        $_SESSION['msg_error'] = '';
        $html_geral = '';
        //verifica se a pergunta existe
        $sql = 'select desc_pergunta,data_reg,idpergunta from qsaberemake.pergunta where idusuario <>' . $this->idusuario . ' order by data_reg desc LIMIT 3';
        $result = $this->banco->executequery($sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $idpergunta = $row["idpergunta"];
            $desc_pergunta = utf8_decode($row["desc_pergunta"]);
            $data_reg = $row["data_reg"];
            $html = "<div class='post'>
                        <div class='entry list-group-item' id='$idpergunta'>
                            <p><a href='../view/view_pergunta.php?pergunta=$idpergunta'>
                                $desc_pergunta
                            </a>
                            </p>
                               date:$data_reg 
                        </div>
                     </div>";
            $html_geral = $html_geral . $html;
        }
        return $html_geral;
    }

    function buscarespostas() {

        //cria usuario
        $_SESSION['msg_error'] = '';
        $html_geral = '';
        //verifica se a pergunta existe
        $sql = 'select desc_resposta,data_reg,idresposta,idpergunta from qsaberemake.resposta where idusuario =' . $this->idusuario . ' order by data_reg desc';
        $result = $this->banco->executequery($sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $idresposta = $row["idresposta"];
            $idpergunta = $row["idpergunta"];
            $desc_resposta = utf8_decode($row["desc_resposta"]);
            $data_reg = $row["data_reg"];
            $html = "<div class='post'>
                            <div class='entry list-group-item' id='$idresposta'>
                                <p><a href='../view/view_pergunta.php?pergunta=$idpergunta'>
                                    $desc_resposta
                                </a>
                                </p>
                                   date:$data_reg 
                            </div>
                         </div>";
            $html_geral = $html_geral . $html;
        }
        return $html_geral;
    }
    
    function buscaPerguntasParaResponder(){
    
            //cria usuario
        $_SESSION['msg_error']= '';
        $html_geral = '';
        //verifica se a pergunta existe
        $sql = 'select desc_pergunta,data_reg,perg.idpergunta '
                .'from qsaberemake.pergunta as perg join '
                .'qsaberemake.categoria_pergunta as catperg on '
                .'(perg.idpergunta=catperg.idpergunta) where idcategoria in '
                .'(select idCategoria from qsaberemake.usuario_especialista '
                .'where idusuario= '.$this->idusuario.' and nota_especialista > 7) '
                . 'and perg.idpergunta not in (select idpergunta from qsaberemake.resposta '
                .' where idusuario = '.$this->idusuario.' )'
                .'order by data_reg desc';
        $result = $this->banco->executequery($sql);       
        while($row = mysqli_fetch_assoc($result)){
            $sql2 = 'select imguser from pergunta as p join usuario as u on p.idusuario = u.idusuario where idpergunta ='.$row["idpergunta"].' ';
            $result2 = $this->banco->executequery($sql2);  
            $row2 = mysqli_fetch_assoc($result2);
            $resp_imguser = "../img/users/".($row2['imguser'] =='' ? 'userdefault.jpg' : $row2['imguser'] );       
            $html = '<div class="post"> '
                    . '<div class="entry list-group-item" id="'.$row["idpergunta"].'">'
                    . '<div class="thumbimguser"><img src="'.$resp_imguser.'" /></div>'
                    . '<p><a href="../view/view_pergunta.php?pergunta='.$row["idpergunta"].'">'.
                    utf8_decode($row["desc_pergunta"]).'</a></p>'
                    . 'date:'.$row["data_reg"].
                    ' </div></div>';
            $html_geral= $html_geral.$html;
        }
        return $html_geral;
}

function buscaQualificacaoUsuario() {
        $_SESSION['msg_error'] = '';
        //verifica se o usuário existe
        $sql = 'select avg(nota_especialista) as nota from qsaberemake.usuario_especialista where idusuario =' . $this->idusuario;
        $result = $this->banco->executequery($sql);

        if (mysqli_num_rows($result) == 0) {
            return "N/A";
        } else {
            $row = mysqli_fetch_assoc($result);
            return $row["nota"];
        }
    }
}

?>
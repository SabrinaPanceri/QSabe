<?php

include_once '../BD/BD.php';


if (!isset($_SESSION)) {
    session_start();
}

session_cache_expire(10);

class resposta {

    var $banco;
    var $user;
    var $nome_user;
    var $desc;
    var $idpergunta;
    var $data_reg;
    var $idresposta;
    var $respostas;

    public function __construct() {
        $this->banco = new BD();
        $this->banco->conecta();
    }

    public function criarResposta() {
        //cria usuario
        $_SESSION['msg_error'] = '';

        //Salva Pergunta
        $sql = 'insert into qsaberemake.resposta (desc_resposta,data_reg,idusuario,idpergunta)'
                . 'values (\'' . $this->desc . '\',now(),' . $this->user . ',' . $this->idpergunta . ')';
        $this->banco->executequery($sql);


        return TRUE;
    }

    public function verificaRespostas() {
        //cria usuario
        $_SESSION['msg_error'] = '';

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
        $sql = 'select desc_resposta,data_reg,idresposta,idusuario from qsaberemake.resposta where idpergunta =' . $this->idpergunta . ' order by data_reg asc';
        $result = $this->banco->executequery($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $sql2 = 'select nome_exibicao from qsaberemake.usuario where idusuario =' . $row["idusuario"];
            $result2 = $this->banco->executequery($sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $html = '<div class="post"> <div class="entry"><p>' . $row["desc_resposta"] . '</p></br></br>by:' . $row2["nome_exibicao"] . ', ' . $row["data_reg"] . ' </div> </div>';
            $html_geral = $html_geral . $html;
        }
        return $html_geral;
    }

}

?>
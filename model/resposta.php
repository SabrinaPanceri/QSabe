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
        $desc_resposta = mysql_escape_string(utf8_encode(trim($this->desc)));
        $sql = 'insert into qsaberemake.resposta (desc_resposta,data_reg,idusuario,idpergunta)'
                . 'values (\'' . $desc_resposta . '\',now(),' . $this->user . ',' . $this->idpergunta . ')';
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
            if($row["idusuario"]==$this->user)
                {
                //Não pode qualificar a propria resposta
                    $html = '<div class="post"> <div class="entry"><p>'.utf8_decode($row["desc_resposta"]).'</p>by:'.utf8_decode($row2["nome_exibicao"]).', '.$row["data_reg"].' </br></div> </div>';
                }else{
                    $html = '<div class="post"> <div class="entry"><p>'.utf8_decode($row["desc_resposta"]).'</p>by:'.utf8_decode($row2["nome_exibicao"]).', '.$row["data_reg"].' </br>'
                            . '<p><a href="../view/view_qualifica.php?resposta='.$row["idresposta"].'">Avalie Está resposta</a></p></div> </div>';
                }
            $html_geral = $html_geral . $html;
        }
        return $html_geral;
    }
    
    /*
     * Busca as Respostas para a Recomendação
     */    
    function buscarespostaspararecomendacao() {
        
    }
    
    
    function buscaresposta(){
        
        //selection da avaliação da resposta
        
            //cria usuario
        $_SESSION['msg_error']= '';
        $html_geral = '';
        //verifica se a pergunta existe
        $sql = 'select desc_resposta,data_reg,idresposta,idusuario from qsaberemake.resposta where idresposta ='. $this->idresposta;
        $result = $this->banco->executequery($sql);
        $row = mysqli_fetch_assoc($result);
        $sql2 = 'select nome_exibicao from qsaberemake.usuario where idusuario ='. $row["idusuario"];
        $result2 = $this->banco->executequery($sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $html = '<p>'.utf8_decode($row["desc_resposta"]).'</p>by:'.utf8_decode($row2["nome_exibicao"]).', '.$row["data_reg"];
        $html_geral= $html_geral.$html;
        
        return $html_geral;
        
    }
    
    function carregarIdperguntaByIdResposta()
    {
        $sql = 'select idpergunta from qsaberemake.resposta where idresposta ='. $this->idresposta;
        $result = $this->banco->executequery($sql);
        $row = mysqli_fetch_assoc($result);
        $this->idpergunta =  $row["idpergunta"];
    }
    
    public function qualificaResposta($nota){
        //cria usuario
        $_SESSION['msg_error']= '';
        
        $sql = 'select count(idqualificacao) as contadorquali from qsaberemake.qualificacao'
                . ' where idresposta = '.$this->idresposta.' and idusuario = '. $this->user;
        $result = $this->banco->executequery($sql);
        $row = mysqli_fetch_assoc($result);
        if($row["contadorquali"]>0)
            {
            return False;
            }
        
        //se for especialista salva com o dobro do peso    
            
        //Salva Pergunta
        $sql = 'insert into qsaberemake.qualificacao (idresposta,data_reg,idusuario,qualificacao)'
                . 'values ('.  $this->idresposta.',now(),'.$this->user.','.$nota.')';
        $this->banco->executequery($sql);
        
        //busca o usuario da resposta
        $user = $this->iduserByIdResposta($this->idresposta);
        //atualiza as especialidades dele
        $this->atualizaEspecialidades($user);
        return TRUE;
    }
    
    public function atualizaEspecialidades($user){
        
        $sql='select avg(qualificacao) as qualific,catperg.idcategoria '
            .'from qsaberemake.pergunta as perg ' 
            .'join qsaberemake.categoria_pergunta as catperg on (perg.idpergunta=catperg.idpergunta) '
            .'join qsaberemake.resposta as resp on (perg.idpergunta=resp.idpergunta) '
            .'join qsaberemake.qualificacao as quali on (resp.idresposta=quali.idresposta) '
            .'where resp.idusuario = '.$user.' group by catperg.idcategoria';

        $result = $this->banco->executequery($sql);
        while($row = mysqli_fetch_assoc($result)){
            if($this->existEspecialidade($user,$row["idcategoria"])){
                //atualiza
                $sql = 'update qsaberemake.usuario_especialista '
                    .'set nota_especialista ='.$row["qualific"]
                    . 'where idusuario = '.$user.' and idCategoria = '.$row["idcategoria"];
            }  else {
                //insere
                $sql = 'insert into qsaberemake.usuario_especialista '
                        . '(idusuario,idcategoria,nota_especialista)'
                        . 'values ('.$user.','.$row["idcategoria"].','.$row["qualific"].')';
            }
            $this->banco->executequery($sql);
        }
        
    }
    
    public function existEspecialidade($user,$categoria){
        $sql = 'select count(idusuario_especialista) as countesp from qsaberemake.usuario_especialista '
                . 'where idusuario = '.$user.' and idcategoria ='.$categoria;
        $result = $this->banco->executequery($sql);
        $row = mysqli_fetch_assoc($result);
        if($row["countesp"]>0){
            return TRUE;
        }  else {
            return FALSE;
        }
        
    }
    public function iduserByIdResposta($resposta){
        $sql = 'select idusuario from qsaberemake.resposta where idresposta = '.$resposta;
        $result = $this->banco->executequery($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["idusuario"];
    }

}

?>
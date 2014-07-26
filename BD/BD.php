<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'DBException.php';

class BD{
    
    var $conexao;
var $banco;
var $result;

function conecta()
{
    if (! $this->conexao) {
        $this->conexao = mysqli_connect('localhost', 'qsabeuser', 'qsabe1234', 'qsaberemake');
    }
}


function executequery($query)
{
    $this->result = mysqli_query($this->conexao, $query);
    //$this->result = mysql_query($query,  $this->conexao);
    if($this->result){
            return $this->result;
        }else{
            throw new DBException("Falha ao executar o SQL.", mysql_error());
        }
    return $this->result;
}


function exists($query)
{
    $this->result = mysqli_query($this->conexao, $query);
    //$this->result = mysql_query($query,  $this->conexao);
    $num = mysqli_num_rows($this->result);
    if($num>0){
            return TRUE;
        }else {
        return FALSE;
        }
}




}


?>
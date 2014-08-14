<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include("similarity/cosine.php");
include("./lib/functions.php");

    
    //Pergunta
    $a = "Qual o melhor time do mundo";
    
    //Respostas
    $b = array("Melhor investimento da minha vida",
               "Investimentos de vida em um mundo qualquer",
               "o Mundo onde time não vale nada",
               "Qual o mundo em que nao se vivem loucos",
               "Acho que já chega neh????");
            
    /*
     *  TODA A LÓGICA PARA PREPARAR O ARRAY
     *  PARA USAR O COUSIN     
     */
    
    // LOWER  A
    $a = limpaString($a);

    // LOWER o array B
    foreach ($b as $i => $item){
        $b[$i] = limpaString($item);
    //$b[$i] = strtolower($item);       
    }              
    
    echo "<h1>Teste da chamada do Cosinus:</h1>";    
    echo "<br>PERGUNTA em A: ", $a;
    echo "<br><br>REPOSTAS em B: ", var_dump($b);    

    
    echo "<h1>Resultado para cada resposta:</h1>";
    $pergunta = split(' ',$a);
    echo "Pergunta: \"",$a,"\"";      
    
    foreach ($b as $resp){
            $resposta = split(' ',$resp);
            echo "<br><br> Resposta: \"",$resp,"\"<br>";
            echo cosinusTokens($pergunta, $resposta);
    }
            
    
    
?>

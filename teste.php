<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo 'teste';
include("model/categoria.php");

$categoria = new categoria();
$html = $categoria->listarCategoriasFilhos(1, '->');
echo $html;



?>
<html>
    <head>
        <script type="text/javascript">
        function tornarvisivel(){
            alert('teste1');
            //document.getElementById('divh').style.display = "inline";
        }
        </script>
        
    </head>
    <body>
        <div>teste 1</div>
        
       <input type="button" onclick="teste();" value="click"/>
        <div id="divCheckbox" style="visibility: hidden" id="divh">
            Texto de teste
        </div>
        
    <div id="divCheckbox" style="visibility: hidden; display:inline;">    
        Texto de teste eeeee
    </div>
    </body>
</html>
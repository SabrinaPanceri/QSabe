<?php

/*
 * Limpar uma string deixando apenas números e letras separados por espaço
 */
function limpaString($aux){
        $aux = trim($aux);
        $aux = strtr($aux, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
        $aux = preg_replace('/[^ a-z0-9]/i', ' ', $aux);
        //$aux = str_replace(" ", "-", $aux);
        $aux = strtolower($aux);
        return $aux;
}

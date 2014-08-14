<?php

/** 
 * 
 * FAVOR SEGUIR AS ANOTAÇÕES 
 * Algoritmo Cosine Similarity
 * @param array $vector
 * @param mixed
 * 
 *  
 **/

function norm(array $vector) {
    return sqrt(dotProduct($vector, $vector));
}


/**
 * Dot product
 * a・b = summation{i=1,n}(a[i] * b[i])
 *
 * @param array $a
 * @param array $b
 * @return mixed
 */


function dotProduct(array $a, array $b) {
    $dotProduct = 0;

    // to speed up the process, use keys with non-empty values
    $keysA = array_keys(array_filter($a));
    $keysB = array_keys(array_filter($b));
    $uniqueKeys = array_unique(array_merge($keysA, $keysB));
    
    foreach ($uniqueKeys as $key) {
        if (!empty($a[$key]) &&!empty($b[$key]))
            $dotProduct += ($a[$key] * $b[$key]);
    }
    return $dotProduct;
}


/**
 * Cosine similarity for non-normalised vectors
 * sim(a, b) = (a・b) / (||a|| * ||b||)
 *
 * @param array $a
 * @param array $b
 * @return mixed
 */
function cosinus(array $a, array $b) {
    $normA = norm($a);
    $normB = norm($b);
    return (($normA * $normB) != 0)
        ? dotProduct($a, $b) / ($normA * $normB)
        : 0;
    }

// usage:
// o primeiro array tem que ser a pergunta que foi feita
// segundo array tem que ser as respostas que estiverem cadastradas no banco
cosinus(array(1, 1, 1, 0, 3), array(2, 3, 0, 0, 1));


//ESSA É A PARTE DO TF-IDF
/**
 * Cosine similarity of sets with tokens
 * sim(a, b) = (a・b) / (||a|| * ||b||)
 *
 * @param array $a
 * @param array $b
 * @return mixed
 */
function cosinusTokens(array $tokensA, array $tokensB) {
    $dotProduct = $normA = $normB = 0;
    $uniqueTokensA = $uniqueTokensB = array();
    $uniqueMergedTokens = array_unique(array_merge($tokensA, $tokensB));

    foreach ($tokensA as $token) $uniqueTokensA[$token] = 0;
    foreach ($tokensB as $token) $uniqueTokensB[$token] = 0;

    foreach ($uniqueMergedTokens as $token) {
        $x = isset($uniqueTokensA[$token]) ? 1 : 0;
        $y = isset($uniqueTokensB[$token]) ? 1 : 0;
        $dotProduct += $x * $y;
        $normA += $x;
        $normB += $y;
    }

    return ($normA * $normB) != 0
        ? $dotProduct / sqrt($normA * $normB)
        : 0;
}

// usage:
// o primeiro array tem que ser a pergunta que foi feita
// segundo array tem que ser as respostas que estiverem cadastradas no banco
cosinusTokens(array('this', 'is', 'my', 'car'), array('this', 'is', 'my', 'home'));

?>

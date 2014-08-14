<?php
include_once '../model/usuario.php';
include_once '../lib/resize-class.php';

if(!isset($_SESSION)){
    session_start();
}

session_cache_expire(10);

// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Salva duas variáveis com o que foi digitado no formulário
    // Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido
    
    //Carregar Imagem
        $pastafotos = "../img/users/";  
        $maxwidth   = 100;
        $maxheight  = 100;
        $imguser = '';
        //verifica se pasta já existe
        if (!file_exists($pastafotos)){
            mkdir($pastafotos, 0777, true);
        }
        $img_name = "user_".md5(uniqid("user", true)).".jpg";
        $img_endereco = $pastafotos.$img_name;
        $img_endereco_tmp = $pastafotos."tmp".$img_name;        
        if (!isset($_FILES["Filedata"]) || !is_uploaded_file($_FILES["Filedata"]["tmp_name"]) || $_FILES["Filedata"]["error"] != 0) {
            print_r($_FILES);
            die("Ocorreu um erro ao enviar as imagens. Tente novamente mais tarde ou entre em contato com o administrador.<br><br>");  
        }else{      
            move_uploaded_file($_FILES["Filedata"]["tmp_name"], $img_endereco_tmp);
            $resizeObj = new resize($img_endereco_tmp);
            $resizeObj -> resizeImage($maxwidth, $maxheight, 0);
            $resizeObj -> saveImage($img_endereco, 95);
            
            $imguser = $img_name;
            unlink($img_endereco_tmp);
        }       
    
    $user = new usuario();
    
    $user->user = (isset($_POST['usuario_txt'])) ? $_POST['usuario_txt'] : '';
    $user->password = (isset($_POST['pass_txt'])) ? $_POST['pass_txt'] : '';
    $user->nome = (isset($_POST['nome_txt'])) ? $_POST['nome_txt'] : '';
    $user->data = (isset($_POST['data_txt'])) ? $_POST['data_txt'] : '';
    $user->nome_exibicao = (isset($_POST['nome_exibicao_txt'])) ? $_POST['nome_exibicao_txt'] : '';
    $user->especialidade = (isset($_POST['categoria_slt'])) ? $_POST['categoria_slt'] : '';
    $user->imguser = $imguser;
    
    
    if($user->salvausuario()){
        header("Location: ../view/view_pessoal.php");
    }  else {
        header("Location: ../index.php");
    }
}


?>

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


    if(!isset($_SESSION)){
        session_start();
    }

    session_cache_expire(10);
    session_destroy();

    header("Location: ../view/view_login.php");



?>
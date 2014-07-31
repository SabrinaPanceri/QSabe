<?php
    if(!isset($_SESSION)){
        session_start();
    }

    session_cache_expire(10);
    session_destroy();

    header("Location: ../index.php");

?>
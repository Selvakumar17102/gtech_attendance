<?php
    session_start();

    if(!isset($_SESSION['id'])){
        $_SESSION['id'] = $_POST['login'];
        echo 'false';
    } else{
        echo 'true';
    }
?>
<?php require_once("../Application/controller/script.php");
if(!isset($_SESSION['id-user'])||!isset($_SESSION['id-role'])){
    header("Location: ../");exit;}
else if(isset($_SESSION['id-user'])||isset($_SESSION['id-role'])){
    if($_SESSION['id-role']<=6){if(!empty($_SESSION['id-keyConsole'])){
        header("Location: ../Views/");exit;
    }else if(empty($_SESSION['id-keyConlose'])){
        $_SESSION = [];
        session_unset();
        session_destroy();
        setcookie('mobileAR', '', time() - 3600);
        setcookie('keyAR', '', time() - 3600);
        $_SESSION['message-danger']="Akun kamu tidak dapat masuk ke Console dikarenakan kunci akses kamu telah dicabut.";$_SESSION['time-message']=time();
        header("Location: masuk");exit;
    }}else if($_SESSION['id-role']==7){
        header("Location: ../");exit;
    }else if($_SESSION['id-role']==9){
        $_SESSION = [];
        session_unset();
        session_destroy();
        setcookie('mobileAR', '', time() - 3600);
        setcookie('keyAR', '', time() - 3600);
        header("Location: ../");exit;}}
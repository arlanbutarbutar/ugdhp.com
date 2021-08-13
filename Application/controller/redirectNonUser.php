<?php 
if(isset($_SESSION['id-user'])||isset($_SESSION['id-role'])){
    if($_SESSION['id-role']<7){
        header("Location: ../Views/");exit;
    }else{
        header("Location: ../");exit;}}
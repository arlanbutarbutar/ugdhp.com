<?php 
if(!isset($_SESSION['id-user'])&&!isset($_SESSION['id-role'])){
    header("Location: ../");exit;
}

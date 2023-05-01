<?php
if($_SESSION['nivel']!=2){
    header("location:index.php?msg=faça login para acessar essa página");
    exit();
}
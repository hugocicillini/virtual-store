<?php
    if(!isset($_SESSION['nivel'])){
        header("location:index.php?msg=faça login para acessar essa página");
        exit();
    }

?>
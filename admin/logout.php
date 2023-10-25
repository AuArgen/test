<?php 
    session_start();
    if ($_SESSION["login"]) {
        unset($_SESSION["login"]);
        unset($_SESSION["password"]);
    }
    header("location:login.php");
?>
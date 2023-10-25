<?php 
    $login = "login";
    $pass = "password";
    session_start();
    if(isset($_SESSION["login"])) {
        if ($_SESSION["login"] != $login || $_SESSION["password"] != $pass) {
            header("location:logout.php");
        }
    } else header("location:logout.php");
?>
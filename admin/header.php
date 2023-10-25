<?php 
    require("verify.php");
    require("conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark">
  <div class="container-fluid">
  <a class="navbar-brand text-white d-flex align-items-center gap-2" href="#">
      <img src="https://salymbekov.com/wp-content/uploads/2021/01/sbs-logo.jpg" alt="Logo" width="50"  class="d-inline-block align-text-top">
      SBS
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="index.php">Башкы бет</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link text-white" href="test.php">Тест</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Курстар
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="math.php">Математика</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="analogia.php">Аналогиялар</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="read.php">Окуу жана тушунуу</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="grammer.php">Граматика</a></li>
          </ul>
        </li>
        <li class="nav-item ">
          <a class="nav-link text-white" href="logout.php">Чыгуу</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

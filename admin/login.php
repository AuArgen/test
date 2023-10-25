<?php 
 $login = "login";
 $pass = "password";
 session_start();
 if(isset($_SESSION["login"])) {
     if ($_SESSION["login"] == $login || $_SESSION["password"] == $pass) {
         header("location:index.php");
     }
 }
 if (isset($_POST["login"])) {
    $l = $_POST['l'];
    $p = $_POST['p'];
    if ($l == $login && $p == $pass) {
        $_SESSION["login"] = $login;
        $_SESSION["password"] = $pass;
    }
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Логин</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container bg-light d-flex justify-content-center align-items-center" style="min-height:700px; max-height: 100vh; min-width: 240px; max-width: 100vw;">
        <div class="form shadow p-2" style="min-width: 350px; min-height: 250px;">
            <div class="header row d-flex justify-content-start align-items-center">
                <div class="col-4">
                    <img src="https://salymbekov.com/wp-content/uploads/2021/01/sbs-logo.jpg" style="width:50px; height: 50px; border-radius: 50%;" alt="">
                </div>
                <h3 class="col-8 ">Логин</h3>
            </div>
            <form class="form-control mt-4" style="border: none;" action="" method="post">
                <input type="text" class="form-control" name="l" placeholder="Логин" minlength="5" required maxlength="20">
                <br>
                <input type="password" class="form-control" id="pass" name="p" placeholder="Пароль" minlength="5" required maxlength="20">
                <br>
                <label for="showPass" onclick="showPass()">
                    <input type="checkbox" class="form-check-input" id="showPass">
                    <span>Показать пароль</span>
                </label>
                <input type="submit" name="login" class="form-control btn btn-outline-success mt-3" value="Войти">
                <br>
            </form>
            <script>
                function showPass() {
                    val = document.querySelector("#showPass").checked;
                    if (val == true) {
                        document.querySelector("#pass").type="text"
                    } else {
                        document.querySelector("#pass").type="password"
                    }
                }
            </script>
        </div>
    </div>
</body>
</html>
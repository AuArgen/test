<?php 
  require("admin/conn.php");
  $phone = '';
  $block = "d-none";
  if (isset($_POST["phone"])) {
    $phone = $_POST["phone"];
    $block = "d-block";
  }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body style="background:#eee;">
<nav class="navbar bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand text-white d-flex align-items-center gap-2" href="#">
      <img src="https://salymbekov.com/wp-content/uploads/2021/01/sbs-logo.jpg" alt="Logo" width="50"  class="d-inline-block align-text-top">
      Salymbekov bussines school
    </a>
  </div>
</nav>

<div class="container bg-white pt-3" style="min-height:95vh;">
  <form action="" class=" bg-light form-control p-5" method="POST">
    <span>
      Введите свой номер телефона
    </span>
    <div class="input-group flex-nowrap">
      <span class="input-group-text" id="addon-wrapping"> <i class="fa fa-phone"></i> </span>
      <input type="tel" class="form-control" name="phone" placeholder="0555123456" required="" minlength="10" maxlength="10" aria-describedby="addon-wrapping">
    </div>
    <button class="btn btn-primary mt-2 form-control">Найти результат</button>
  </form>

  <div class="border mt-3 py-3 px-5 <?php echo $block;?>">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
            <th scope="col" style="width:40px"></th>
            <th scope="col" class="text-center">Дата</th>
            <th scope="col" class="text-center">Тест</th>
            </tr>
        </thead>
        <tbody>
            <?php 
              $fio = '';
              if ($phone != '') { 
                $get = $conn -> query("SELECT a.*, t.code FROM `abuturent` as a INNER JOIN test_code as t ON a.id_test = t.id WHERE a.phone='$phone' ORDER BY a.id DESC LIMIT 1;");
                while ($row = mysqli_fetch_array($get)) {
                    $fio = $row["fio"];
                    echo '         
                    <tr>
                        <th scope="row"> <i class="border py-2 px-3 bg-white fa fa-info"></i> </th>
                        <td class="text-center">'.$row["date"].'</td>
                        <td class="text-center">'.$row["code"].'</td>
                    </tr>
                    ';
                }
              }
            ?>
        </tbody>
    </table>
  </div>

  <div class="border mt-3 py-3 px-5 <?php echo $block;?>">
    <h4><?php echo $fio;?></h4>
    <hr>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
            <th scope="col" style="width:40px"></th>
            <th scope="col">Предмет</th>
            <th scope="col">К.В</th>
            <th scope="col">К.П</th>
            <th scope="col">Ба.</th>
            </tr>
        </thead>
        <tbody>
            <?php 
              if ($phone != '') { 
                $get = $conn -> query("SELECT a.*, t.code FROM `abuturent` as a INNER JOIN test_code as t ON a.id_test = t.id WHERE a.phone='$phone' ORDER BY a.id DESC LIMIT 1;");
                while ($row = mysqli_fetch_array($get)) {
                    echo '         
                    <tr>
                        <th scope="row"> <i class="border py-2 px-3 bg-white fa fa-info"></i> </th>
                        <td> <a href="show.php?id='.$row["id"].'&type=1&f='.$row["fio"].'" class="text-black"> Математика </a></td>
                        <td>60</td>
                        <td>'.$row["math"].'</td>
                        <td>'.$row["mathB"].'</td>
                    </tr>
                    <tr>
                        <th scope="row"> <i class="border py-2 px-3 bg-white fa fa-info"></i> </th>
                        <td> <a href="show.php?id='.$row["id"].'&type=2&f='.$row["fio"].'" class="text-black"> Аналогия </a></td>
                        <td>30</td>
                        <td>'.$row["analogia"].'</td>
                        <td>'.$row["analogiaB"].'</td>
                    </tr>
                    <tr>
                        <th scope="row"> <i class="border py-2 px-3 bg-white fa fa-info"></i> </th>
                        <td> <a href="show.php?id='.$row["id"].'&type=4&f='.$row["fio"].'" class="text-black"> Чтение и понимание </a></td>
                        <td>30</td>
                        <td>'.$row["ojt"].'</td>
                        <td>'.$row["ojtB"].'</td>
                    </tr>
                    <tr>
                        <th scope="row"> <i class="border py-2 px-3 bg-white fa fa-info"></i> </th>
                        <td> <a href="show.php?id='.$row["id"].'&type=3&f='.$row["fio"].'" class="text-black"> Грамматика </a></td>
                        <td>30</td>
                        <td>'.$row["grammer"].'</td>
                        <td>'.$row["grammerB"].'</td>
                    </tr>
                    <tr>
                        <th scope="row"> <i class="border py-2 px-3 bg-white fa fa-info"></i> </th>
                        <td class="text-danger">Общий балл</td>
                        <td></td>
                        <td></td>
                        <td class="text-danger">'.$row["allB"].'</td>
                    </tr>
                    ';
                }
              }
            ?>
        </tbody>
    </table>
    <div>
      <span> <b>К.В. - Количество вопросов </b></span>
    </div>
    <div>
      <span> <b>К.П. - Количество правильный ответов </b></span>
    </div>
    <div>
      <span> <b>Ба. - Баллы </b></span>
    </div>
  </div>

</div>

</body>
</html>
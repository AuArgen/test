<?php 
  require("admin/conn.php");
  $typeName = ["Математика","Аналогия","Грамматика","Чтение и поинимание"];
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
  <div class="border mt-3 py-3 px-5 <?php echo $block;?>">
    <h4 class="text-secondary"><?php echo $_GET["f"];?></h4>
    <hr>
    <h5 class="mt-3">
        <?php echo $typeName[$_GET["type"]-1];?>
    </h5>
    <table class="table table-striped hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Тема</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
                    $id_code = $_GET['id'];
                    $t = $_GET["type"];
                    $abu = $conn -> query("SELECT a.fio,aa.type, aa.language, aa.curent, t.kg, t.ru FROM abuturent as a INNER JOIN abuturent_ans as aa ON a.id =aa.abuturent_id INNER JOIN type as t ON aa.id_type = t.id WHERE a.id = $id_code and aa.type=$t;");
                    $count = 1;
                    while ($row = mysqli_fetch_array($abu)) {
                        $l = "kg";
                        if ($row["language"] == "RU") {
                            $l = "ru";
                        }
                        $ans = "<span class='text-white border d-flex justify-content-center align-items-center bg-success' style='width:20px; height:20px; border-radius:50%;'> <i class='fa fa-check'></i></span>";
                        if (!$row["curent"]) {
                            $ans = "<span class='text-white border d-flex justify-content-center align-items-center bg-danger' style='width:20px; height:20px; border-radius:50%;'> <i class='fa fa-times'></i></span>";
                        }
                        echo '   
                        <tr>
                            <td scope="row">'.$count++.'</td>
                            <td > 
                                    '.$row[$l].'
                            </td>
                            <td style="width:100px"> 
                                    '.$ans.'
                            </td>
                        </tr>
                        ';
                    }
            ?>
        </tbody>
    </table>
  </div>

</div>

</body>
</html>
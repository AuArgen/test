<?php
if (!isset($_GET["id"]) || !is_numeric($_GET['id'])) {
    header("location:logout.php");
}
$id_code = $_GET["id"];
require('header.php');
?>
<style>
    table tr td{
        font-size:0.9rem;
    }
</style>
<div class="container-lg">
    <div class="row py-2 bg-light border-bottom">
        <div class="col">
            <h5>
                Абутуриент
            </h5>
        </div>
        <div class="col-1 d-flex justify-content-end">
            <a class="" href="index.php">Артка</a>
        </div>
    </div>

    <table class="table table-striped hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ФИО</th>
                <th scope="col">Телефон</th>
                <th scope="col">Математика</th>
                <th scope="col">Аналогия</th>
                <th scope="col">Окуу жана тушунуу</th>
                <th scope="col">Граматтика</th>
                <th scope="col">Жалпы</th>
            </tr>
        </thead>
        <tbody>
            <?php
                    $abu = $conn -> query("SELECT * FROM abuturent WHERE id=$id_code");
                    $count = 1;
                    while ($row2 = mysqli_fetch_array($abu)) {
                        $math = $row2["math"];
                        $analogia = $row2["analogia"];
                        $grammer = $row2["grammer"];
                        $ojt = $row2["ojt"];
                        $mathB = $row2["mathB"];
                        $analogiaB = $row2["analogiaB"];
                        $ojtB = $row2["ojtB"];
                        $grammerB = $row2["grammerB"];
                        $summa = $row2["allCount"];
                        $ball = $row2["allB"];
                        echo '   
                        <tr>
                            <td scope="row">'.$count++.'</td>
                            <td > 
                                    '.$row2["fio"].'
                            </td>
                            <td> '.$row2["phone"].'</td>
                            <td> '.$math.'/'.$mathB.'</td>
                            <td> '.$analogia.'/'.$analogiaB.'</td>
                            <td> '.$ojt.'/'.$ojtB.'</td>
                            <td> '.$grammer.'/'.$grammerB.'</td>
                            <td> '.$summa.'/'.$ball.'</td>
                        </tr>
                        ';
                    }
            ?>
        </tbody>
    </table>
    <div class="row py-2 bg-light border-bottom">
        <div class="col">
            <h5>
                Тест жооптор
            </h5>
        </div>
    </div>

    <h5 class="mt-3">
        Математика
    </h5>
    <table class="table table-striped hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Тема</th>
                <th scope="col">Статус</th>
            </tr>
        </thead>
        <tbody>
            <?php
                    $abu = $conn -> query("SELECT a.fio,aa.type, aa.language, aa.curent, t.kg, t.ru FROM abuturent as a INNER JOIN abuturent_ans as aa ON a.id =aa.abuturent_id INNER JOIN type as t ON aa.id_type = t.id WHERE a.id = $id_code and aa.type=1;");
                    $count = 1;
                    while ($row = mysqli_fetch_array($abu)) {
                        $l = "kg";
                        if ($row["language"] == "RU") {
                            $l = "ru";
                        }
                        $ans = "<span class='text-success'>Турра</span>";
                        if (!$row["curent"]) {
                            $ans = "<span class='text-danger'>Турра эмес</span>";
                        }
                        echo '   
                        <tr>
                            <td scope="row">'.$count++.'</td>
                            <td > 
                                    '.$row[$l].'
                            </td>
                            <td > 
                                    '.$ans.'
                            </td>
                        </tr>
                        ';
                    }
            ?>
        </tbody>
    </table>

    <h5 class="mt-3">
        Аналогия
    </h5>
    <table class="table table-striped hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Тема</th>
                <th scope="col">Статус</th>
            </tr>
        </thead>
        <tbody>
            <?php
                    $abu = $conn -> query("SELECT a.fio,aa.type, aa.language, aa.curent, t.kg, t.ru FROM abuturent as a INNER JOIN abuturent_ans as aa ON a.id =aa.abuturent_id INNER JOIN type as t ON aa.id_type = t.id WHERE a.id = $id_code and aa.type=2;");
                    $count = 1;
                    while ($row = mysqli_fetch_array($abu)) {
                        $l = "kg";
                        if ($row["language"] == "RU") {
                            $l = "ru";
                        }
                        $ans = "<span class='text-success'>Турра</span>";
                        if (!$row["curent"]) {
                            $ans = "<span class='text-danger'>Турра эмес</span>";
                        }
                        echo '   
                        <tr>
                            <td scope="row">'.$count++.'</td>
                            <td > 
                                    '.$row[$l].'
                            </td>
                            <td > 
                                    '.$ans.'
                            </td>
                        </tr>
                        ';
                    }
            ?>
        </tbody>
    </table>

    <h5 class="mt-3">
        Граматтика
    </h5>
    <table class="table table-striped hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Тема</th>
                <th scope="col">Статус</th>
            </tr>
        </thead>
        <tbody>
            <?php
                    $abu = $conn -> query("SELECT a.fio,aa.type, aa.language, aa.curent, t.kg, t.ru FROM abuturent as a INNER JOIN abuturent_ans as aa ON a.id =aa.abuturent_id INNER JOIN type as t ON aa.id_type = t.id WHERE a.id = $id_code and aa.type=4;");
                    $count = 1;
                    while ($row = mysqli_fetch_array($abu)) {
                        $l = "kg";
                        if ($row["language"] == "RU") {
                            $l = "ru";
                        }
                        $ans = "<span class='text-success'>Турра</span>";
                        if (!$row["curent"]) {
                            $ans = "<span class='text-danger'>Турра эмес</span>";
                        }
                        echo '   
                        <tr>
                            <td scope="row">'.$count++.'</td>
                            <td > 
                                    '.$row[$l].'
                            </td>
                            <td > 
                                    '.$ans.'
                            </td>
                        </tr>
                        ';
                    }
            ?>
        </tbody>
    </table>

    <h5 class="mt-3">
        Окуу жана тушунуу
    </h5>
    <table class="table table-striped hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Тема</th>
                <th scope="col">Статус</th>
            </tr>
        </thead>
        <tbody>
            <?php
                    $abu = $conn -> query("SELECT a.fio,aa.type, aa.language, aa.curent, t.kg, t.ru FROM abuturent as a INNER JOIN abuturent_ans as aa ON a.id =aa.abuturent_id INNER JOIN type as t ON aa.id_type = t.id WHERE a.id = $id_code and aa.type=3;");
                    $count = 1;
                    while ($row = mysqli_fetch_array($abu)) {
                        $l = "kg";
                        if ($row["language"] == "RU") {
                            $l = "ru";
                        }
                        $ans = "<span class='text-success'>Турра</span>";
                        if (!$row["curent"]) {
                            $ans = "<span class='text-danger'>Турра эмес</span>";
                        }
                        echo '   
                        <tr>
                            <td scope="row">'.$count++.'</td>
                            <td > 
                                    '.$row[$l].'
                            </td>
                            <td > 
                                    '.$ans.'
                            </td>
                        </tr>
                        ';
                    }
            ?>
        </tbody>
    </table>
</div>
<?php
require('footer.php');
?>


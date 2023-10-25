<?php
if (!isset($_GET["id"]) || !is_numeric($_GET['id'])) {
    header("location:logout.php");
}
$id_code = $_GET["id"];
require('header.php');
?>
<div class="container-lg">
    <div class="row py-2 bg-light border-bottom">
        <div class="col">
            <h5>
                Абутуриенттер
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
                $get = $conn -> query("SELECT * FROM scanner WHERE id_code=$id_code");
                while ($row = mysqli_fetch_array($get)) {
                    $id_scanner = $row["id"];
                    $abu = $conn -> query("SELECT * FROM abuturent WHERE id_scanner=$id_scanner ORDER BY allCount DESC");
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
                                <a href="abuturient.php?id='.$row2["id"].'">      
                                    '.$row2["fio"].'
                                </a>
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
                } 
            ?>
        </tbody>
    </table>

</div>
<?php
require('footer.php');
?>


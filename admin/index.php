<?php
require('header.php');
if(isset($_POST["addTest"])) {
    $code = $_POST["code"];
    $get = $conn -> query("SELECT * FROM test_code WHERE code=$code");
    if (!mysqli_num_rows($get)) {
        $conn -> query("INSERT INTO test_code (id_user, code, date) VALUES(1, $code, now())");
    }
    header("location: test.php");
}
if(isset($_POST["updateTest"])) {
    $code = $_POST["code"];
    $id = $_POST["id"];
    $get = $conn -> query("UPDATE test_code SET code=$code WHERE id=$id");
    header("location: test.php");
}
if(isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $conn -> query("DELETE FROM test_code WHERE id = $id");
    header("location: test.php");
}
?>
<div class="container-lg">
    <div class="row py-2 bg-light border-bottom">
        <div class="col">
            <h5>
                Тесттер
            </h5>
        </div>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Тест коду</th>
            <th scope="col">Дата</th>
            <th scope="col">Жооптор</th>
            <th scope="col">Сканер</th>
            <th scope="col">Абитуриент</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $get = $conn -> query("SELECT * FROM test_code ORDER BY id DESC");
                $count = 1;
                while ($row = mysqli_fetch_array($get)) {
                    $id_code = $row['id'];
                    $get2 = $conn -> query("SELECT * FROM scanner WHERE id_code=$id_code");
                    $countScanner = mysqli_num_rows($get2);
                    $countAbiturient = 0;
                    while ($row2 = mysqli_fetch_array($get2)) {
                        $countAbiturient += $row2["count"];
                    }
                    $have = "<span class='text-success'>Бар</span>";
                    $get2 = $conn -> query("SELECT * FROM test WHERE type=1 and  id_code=$id_code LIMIT 1");
                    $get3 = $conn -> query("SELECT * FROM test WHERE type=2 and  id_code=$id_code LIMIT 1");
                    $get4 = $conn -> query("SELECT * FROM test WHERE type=3 and  id_code=$id_code LIMIT 1");
                    $get5 = $conn -> query("SELECT * FROM test WHERE type=4 and  id_code=$id_code LIMIT 1");
                    if (!mysqli_num_rows($get2) || !mysqli_num_rows($get3) || !mysqli_num_rows($get4) || !mysqli_num_rows($get5)) {
                        $have = "<span class='text-danger'>Жок</span>";
                    }
                    echo '         
                    <tr>
                        <th scope="row">'.$count++.'</th>
                        <td id="test_'.$row['id'].'">'.$row["code"].'</td>
                        <td id="">'.$row["date"].'</td>
                        <td>'.$have.'</td>
                        <td><a class="text-primary" href="scanner.php?id='.$row['id'].'">'.$countScanner.'</a></td>
                        <td> <a class="text-success" href="abuturients.php?id='.$row['id'].'">'.$countAbiturient.'</a></td>
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


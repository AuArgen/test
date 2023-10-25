<?php
require('header.php');
?>
<div class="container-lg">
    <div class="row py-2 bg-light border-bottom">
        <div class="col">
            <h5>
                Граматтика боюнча тесттер
            </h5>
        </div>
        <div class="col-1 d-flex justify-content-end">
            <a class="" href="theme.php?type=3">Темалар</a>
        </div>
        <div class="col-1 d-flex justify-content-end">
            <a class="" href="addGrammer.php">Жаны тест</a>
        </div>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Тест коду</th>
            <th scope="col">Дата</th>
            <th scope="col">Жоортор</th>
            <th scope="col">Ондоо</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $get = $conn -> query("SELECT * FROM test_code ORDER BY id DESC");
                $count = 1;
                while ($row = mysqli_fetch_array($get)) {
                    $id_code = $row["id"];
                    $get2 = $conn -> query("SELECT * FROM test WHERE type=3 and  id_code=$id_code LIMIT 1");
                    $have = '<b class="text-danger">Жок</b>';
                    if (mysqli_num_rows($get2)) {
                        $have = '<b class="text-success">Бар</b>';
                    }
                    echo '         
                    <tr>
                        <th scope="row">'.$count++.'</th>
                        <td id="test_'.$row['id'].'">'.$row["code"].'</td>
                        <td id="">'.$row["date"].'</td>
                        <td class="fs-6 px-3"> '.$have.' </td>
                        <td> <a href="updateGrammer.php?id='.$id_code.'">Ондоо</a></td>
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


<?php 
    require("conn.php");
    $id_code = $_GET["id"]; 
    $print = '
    <table class="table table-striped hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ФИО</th>
            <th scope="col">Телефон</th>
            <th scope="col">Математика</th>
            <th scope="col">Математика балл</th>
            <th scope="col">Аналогия</th>
            <th scope="col">Аналогия балл</th>
            <th scope="col">ОЖТ</th>
            <th scope="col">ОЖТ балл</th>
            <th scope="col">Граматика</th>
            <th scope="col">Граматика балл</th>
            <th scope="col">Жалпы</th>
            <th scope="col">Жалпы балл</th>
        </tr>
    </thead>
    <tbody>';
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
                        $print.='   
                        <tr>
                            <td scope="row">'.$count++.'</td>
                            <td > '.$row2["fio"].'</td>
                            <td> '.$row2["phone"].'</td>
                            <td> '.$math.'</td>
                            <td>'.$mathB.'</td>
                            <td> '.$analogia.'</td>
                            <td>'.$analogiaB.'</td>
                            <td> '.$ojt.'</td>
                            <td>'.$ojtB.'</td>
                            <td> '.$grammer.'</td>
                            <td>'.$grammerB.'</td>
                            <td> '.$summa.'</td>
                            <td>'.$ball.'</td>
                        </tr>
                        ';
                    }
                } 
                $print .='</tbody>
                </table>';
                header ("Content-Type:application/xls");
                header ("Content-Disposition:attachment;filename=results.xls");
                echo $print;
?>
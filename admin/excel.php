<?php 
    require("conn.php");
    $id_code = $_GET["id"]; 
    $post_search = $_GET["search"]; 
    $print = '
    <table class="table table-striped hover" border=1>
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
            <th scope="col">Дата</th>
        </tr>
    </thead>
    <tbody>';
               
                    $abu = $conn -> query("SELECT abuturent.* FROM abuturent INNER JOIN scanner on abuturent.id_scanner = scanner.id WHERE id_code=$id_code ORDER BY abuturent.allB DESC LIMIT 0");
                    if (is_numeric($post_search)) {
                        $abu = $conn -> query("SELECT abuturent.* FROM abuturent INNER JOIN scanner on abuturent.id_scanner = scanner.id WHERE id_code=$id_code AND abuturent.phone LIKE '%$post_search%' ORDER BY abuturent.allB DESC");
                    }else if ($post_search != '') {
                        $abu = $conn -> query("SELECT abuturent.* FROM abuturent INNER JOIN scanner on abuturent.id_scanner = scanner.id WHERE id_code=$id_code AND abuturent.fio LIKE '%$post_search%' ORDER BY abuturent.allB DESC");
                    }else {
                        $abu = $conn -> query("SELECT abuturent.* FROM abuturent INNER JOIN scanner on abuturent.id_scanner = scanner.id WHERE id_code=$id_code ORDER BY abuturent.allB DESC");
                    }
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
                            <td> <a href="http://test/admin/link.php?id='.$row2['id'].'" target="_blank"> '.htmlspecialchars($row2["fio"]).'</a></td>
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
                            <td>'.$row2["date"].'</td>
                        </tr>
                        ';
                    }
                $print .='</tbody>
                </table>';
                header ("Content-Type:application/xls");
                header ("Content-Disposition:attachment;filename=results.xls");
                echo $print;
?>
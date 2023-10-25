<?php
if (!isset($_GET["id"]) || !is_numeric($_GET['id'])) {
    header("location:logout.php");
}
$latynToKyryl = array(
    "A"=>"А",
    "B"=>"Б",
    "V"=>"В",
    "G"=>"Г",
    "D"=>"Д",
    "E"=>"Е",
    "J"=>"Ж",
    "Z"=>"З",
    "I"=>"И",
    "Y"=>"Й",
    "K"=>"К",
    "L"=>"Л",
    "M"=>"М",
    "N"=>"Н",
    "O"=>"О",
    "]"=>"Ө",
    "P"=>"П",
    "R"=>"Р",
    "S"=>"С",
    "T"=>"Т",
    "U"=>"У",
    "W"=>"Ү",
    "F"=>"Ф",
    "H"=>"Х",
    "["=>"Ч",
    "$"=>"Ш",
    "&"=>"Ы",
    "Q"=>"Э",
    "X"=>"Ю",
    "}"=>"Я",
    "{"=>"Ь",
    "#"=>"Ц",
    " "=> " "
);
require('header.php');
$id_code = $_GET["id"];
$get = $conn -> query("SELECT * FROM test_code WHERE id = $id_code");
$ucode;
while ($row = mysqli_fetch_array($get)) {
    $ucode = $row['code'];
}
$get2 = $conn -> query("SELECT * FROM test WHERE id_code=$id_code LIMIT 1");
if (!mysqli_num_rows($get2)) {
    echo'<script> alert("Бул тестин туура жооптру базада жок! Сураныч жоопторду кошунуз!")
        window.location.href="index.php" </script>;
    ';
}
if(isset($_POST["addTxt"])) {
    $targetDirectory = "files/";
    $file_name = basename($_FILES["file"]["name"]);
    $new_name = rand(100000,9999999).'-'.rand(1000,9999).'+'.$file_name;
    $targetFile = $targetDirectory . $new_name;
    $wrong = 0;
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        $r = file_get_contents($targetFile);
        $start = 1;
        $spisok = [];
        while($start+160 < strlen($r)) {
            $fio = '';
            $phone = '';
            $languge = '';
            $math = '';
            $read = '';
            $analogia = '';
            $grammer = '';
            $test_code = '';
            $fioIs = true;
            $phoneIs = true;
            $langugeIs = true;
            $mathIs = true;
            $readIs = true;
            $analogiaIs = true;
            $grammerIs = true;
            for ($i=$start; $i < strlen($r); $i++) { 
                if (is_numeric($r[$i])) {
                    $fioIs = false;
                    if ($phoneIs) {
                        $phone .=$r[$i];
                    } else $test_code .= $r[$i];
                } else {
                    if ($test_code != '') {
                        $start = $i;
                        break;
                    }
                    if ($phoneIs && $phone != '') {
                        $phoneIs = false;
                    }
                    if ($fioIs) {
                        $fio .= $latynToKyryl[$r[$i]];
                    }else if ($langugeIs && ($r[$i] =='K' || $r[$i] == 'R')) {
                        if ($r[$i] != " ") {
                            $languge .= $r[$i];
                        }
                        $langugeIs = false;
                    } else if ($mathIs){
                        for ($j=$i; $j < $i + 60 ; $j++) { 
                            if ($r[$j] == ' ') {
                                $math .= '-';
                            } else $math .= $r[$j];
                        }
                        $i += 59;
                        $mathIs = false;
                    } else if ($analogiaIs){
                        for ($j=$i; $j < $i + 30 ; $j++) { 
                            if ($r[$j] == ' ') {
                                $analogia .= '-';
                            } else $analogia .= $r[$j];
                        }
                        $i += 29;
                        $analogiaIs = false;
                    } else if ($readIs){
                        for ($j=$i; $j < $i + 30 ; $j++) { 
                            if ($r[$j] == ' ') {
                                $read .= '-';
                            } else $read .= $r[$j];
                        }
                        $i += 29;
                        $readIs = false;
                    } else if ($grammerIs){
                        for ($j=$i; $j < $i + 30 ; $j++) { 
                            if ($r[$j] == ' ') {
                                $grammer .= '-';
                            } else $grammer .= $r[$j];
                        }
                        $i += 29;
                        $grammerIs = false;
                    } 
                }
            }
            $spisok[] = array(
                'fio' => $fio,
                'phone' => $phone,
                'language' => $languge,
                'math' => $math,
                'read' => $read,
                'analogia' => $analogia,
                'grammer' => $grammer,
                'test_code' => $test_code
            );
            if ($test_code != $ucode) {
                $spisok = [];
                unlink($targetFile);
                header("location: wrongCode.php");
            }
        }
        if (count($spisok)) {
            $countAbiturient = count($spisok);
            $ucode = rand(100000,999999);
            $conn -> query("INSERT INTO `scanner`(`file`, `id_code`, `date`, `count`, `file_name`, `ucode`) VALUES ('$targetFile',$id_code,now(),$countAbiturient,'$file_name',$ucode)");
            $get = $conn -> query("SELECT * FROM scanner WHERE ucode=$ucode and id_code=$id_code");
            $id_scanner;
            while ($row = mysqli_fetch_array($get)) {
                $id_scanner = $row["id"];
            }
            // Math
            $get = $conn -> query("SELECT * FROM test WHERE id_code=$id_code and type = 1");
            $ansm = [];
            $i = 0;
            while ($row = mysqli_fetch_array($get)) {
                $ansm[] = array("ans" => $row["ans"], "type" => $row["id_type"]);
            }
            // Analogia
            $get = $conn -> query("SELECT * FROM test WHERE id_code=$id_code and type = 2");
            $ansa = [];
            $i = 0;
            while ($row = mysqli_fetch_array($get)) {
                $ansa[] = array("ans" => $row["ans"], "type" => $row["id_type"]);
            }
            // Grammer
            $get = $conn -> query("SELECT * FROM test WHERE id_code=$id_code and type = 3");
            $ansg = [];
            $i = 0;
            while ($row = mysqli_fetch_array($get)) {
                $ansg[] = array("ans" => $row["ans"], "type" => $row["id_type"]);
            }
            // OJT
            $get = $conn -> query("SELECT * FROM test WHERE id_code=$id_code and type = 4");
            $anso = [];
            $i = 0;
            while ($row = mysqli_fetch_array($get)) {
                $anso[] = array("ans" => $row["ans"], "type" => $row["id_type"]);
            }
            for ($i=0; $i < $countAbiturient; $i++) { 
                $x = $spisok[$i];
                $fio = $x["fio"];
                $phone = $x["phone"];
                $language = $x["language"];
                $conn -> query("INSERT INTO `abuturent`(`phone`, `fio`, `id_test`, `date`, `math`, `analogia`, `grammer`, `ojt`, `id_scanner`,`mathB`, `analogiaB`, `grammerB`, `ojtB`, `allCount`, `allB`) VALUES ('$phone','$fio',$id_code,now(),0,0,0,0,$id_scanner,0,0,0,0,0,0)");
                $get = $conn -> query("SELECT * FROM `abuturent` WHERE id_test = $id_code and id_scanner = $id_scanner");
                $id_abuturient;
                while ($row = mysqli_fetch_array($get)) {
                    $id_abuturient = $row["id"];
                }
                // Math
                $math = $x["math"];
                $mathCount = 0;
                $q = "INSERT INTO `abuturent_ans`(`ans`, `type`, `language`, `curent`, `abuturent_id`,`id_type`) VALUES";
                for ($j=0; $j < 60; $j++) { 
                    $curent = 1;
                    $ans = $math[$j];
                    $id_typeM = $ansm[$j]["type"];
                    if ($ans == $ansm[$j]["ans"]) {
                        $mathCount++;
                    } else {
                        $curent = 0;
                    }
                    $q .= "('$ans',1,'$language',$curent,$id_abuturient,$id_typeM)";
                    if ($j < 59) {
                        $q .= ',';
                    }
                }
                $conn -> multi_query($q);
                // Analogia
                $analogia = $x["analogia"];
                $analogiaCount = 0;
                $q = "INSERT INTO `abuturent_ans`(`ans`, `type`, `language`, `curent`, `abuturent_id`,`id_type`) VALUES";
                for ($j=0; $j < 30; $j++) { 
                    $curent = 1;
                    $ans = $analogia[$j];
                    $id_typeA = $ansa[$j]["type"];
                    if ($ans == $ansa[$j]["ans"]) {
                        $analogiaCount++;
                    } else {
                        $curent = 0;
                    }
                    $q .= "('$ans',2,'$language',$curent,$id_abuturient,$id_typeA)";
                    if ($j < 29) {
                        $q .= ',';
                    }
                }
                $conn -> multi_query($q);
                // Grammer
                $grammer = $x["grammer"];
                $grammerCount = 0;
                $q = "INSERT INTO `abuturent_ans`(`ans`, `type`, `language`, `curent`, `abuturent_id`,`id_type`) VALUES";
                for ($j=0; $j < 30; $j++) { 
                    $curent = 1;
                    $ans = $grammer[$j];
                    $id_typeG = $ansg[$j]["type"];
                    if ($ans == $ansg[$j]["ans"]) {
                        $grammerCount++;
                    } else {
                        $curent = 0;
                    }
                    $q .= "('$ans',3,'$language',$curent,$id_abuturient,$id_typeG)";
                    if ($j < 29) {
                        $q .= ',';
                    }
                }
                $conn -> multi_query($q);
                // OJT
                $read = $x["read"];
                $readCount = 0;
                $q = "INSERT INTO `abuturent_ans`(`ans`, `type`, `language`, `curent`, `abuturent_id`,`id_type`) VALUES";
                for ($j=0; $j < 30; $j++) { 
                    $curent = 1;
                    $ans = $read[$j];
                    $id_typeR = $anso[$j]["type"];
                    if ($ans == $anso[$j]["ans"]) {
                        $readCount++;
                    } else {
                        $curent = 0;
                    }
                    $q .= "('$ans',4,'$language',$curent,$id_abuturient,$id_typeR)";
                    if ($j < 29) {
                        $q .= ',';
                    }
                }
                $conn -> multi_query($q);
                $mathB = intval($mathCount*1.033333334 + 5);
                $analogiaB = intval($analogiaCount*1.0666667 + 5);
                $ojtB = intval($readCount*1.0666667 + 5);
                $grammerB = intval($grammerCount*1.0666667 + 5);
                $summa = $mathCount + $analogiaCount + $grammerCount + $readCount;
                $ball = $mathB + $analogiaB + $ojtB + $grammerB;
                $conn -> query("UPDATE `abuturent` SET math=$mathCount, analogia=$analogiaCount, grammer=$grammerCount, ojt=$readCount, mathB=$mathB,analogiaB=$analogiaB,grammerB=$grammerB,ojtB=$ojtB, allCount=$summa, allB=$ball  WHERE id = $id_abuturient");
            }
            echo '<script> 
                    alert("Ийгиликтуу аяктады!");
                    window.location.href="index.php";
                </script>';
        } else {
            header("location: wrongCode.php");
        }
    } else {
        echo '<script> 
                alert("Сервер файылды кочуро албады! файылда катачылык бар.");
                window.location.href="index.php";
             </script>';
    }
}

if(isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $get = $conn -> query("SELECT * FROM abuturent WHERE id_scanner = $id");
    while($row = mysqli_fetch_array($get)) {
        $id_abuturient = $row["id"];
        $conn -> query("DELETE FROM abuturent_ans WHERE abuturent_id=$id_abuturient");
    }
    $conn -> query("DELETE FROM abuturent WHERE id_scanner=$id");
    $get = $conn -> query("SELECT * FROM scanner WHERE id = $id");
    while ($row=mysqli_fetch_array($get)) {
        $file = $row['file'];
        unlink($file);
    }
    $conn -> query("DELETE FROM scanner WHERE id = $id");
    header("location: scanner.php?id=".$id_code);
}
?>
<div class="container-lg">
    <div class="row py-2 bg-light border-bottom">
        <div class="col">
            <h5>
                Сканерленгендер
            </h5>
        </div>
        <div class="col-1 d-flex justify-content-end">
            <a class="" href="index.php">Артка</a>
        </div>
        <div class="col-1 d-flex justify-content-end">
            <a href="" data-bs-toggle="modal" data-bs-target="#theme">Сканер</a>

            <!-- Modal -->
            <div class="modal fade" id="theme" tabindex="-1" aria-labelledby="themeLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="themeLabel">Файыл кошуу</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="" method="post" enctype="multipart/form-data">
                            <div class="input-group mb-3">
                                <input type="file" accept=".txt" class="form-control" name="file" required>
                            </div>
                            <input type="submit" class="d-none" name="addTxt" id="addTxt">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Кайтуу</button>
                        <label for="addTxt" type="button" class="btn btn-primary">Сактоо</label>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-striped hover">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Файл</th>
            <th scope="col">Абутуриент</th>
            <th scope="col">Удалить</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $get = $conn -> query("SELECT * FROM scanner WHERE id_code=$id_code ORDER BY id DESC");
                $count = 1;
                while ($row = mysqli_fetch_array($get)) {
                    echo '         
                    <tr>
                        <th scope="row">'.$count++.'</th>
                        <td >'.$row["file_name"].'</td>
                        <td> '.$row["count"].'</td>
                        <td><a class="text-danger" href="?id=',$id_code,'&delete='.$row['id'].'">Удалить</a></td>
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


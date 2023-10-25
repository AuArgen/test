<?php
require('header.php');
$id_code;
if(isset($_GET["id"])) {
    $id_code = $_GET['id'];
} else header("location: logout.php");
$test_count = 30;
if (isset($_POST["updateMath"])) {
    $q = '';
    for ($i=1; $i <= $test_count; $i++) { 
        $id_code = $_POST["id_code"];
        $ans = $_POST["ans_$i"];
        $type = $_POST["ans_select_$i"];
        $id = $_POST["id_$i"];
        $q = $q. "UPDATE test SET id_code=$id_code, ans='$ans', id_type=$type WHERE id=$id;";
    }
    $conn->multi_query($q);
    header("location:analogia.php");
}
?>
<div class="container-lg">
    <div class="row py-2 bg-light border-bottom">
        <div class="col">
            <h5>
            Аналогия жоопторду ондоо
            </h5>
        </div>
        <div class="col d-flex justify-content-end">
            <a class="btn btn-primary" href="analogia.php">Артка</a>
        </div>
    </div>
    <div class="d-flex justify-content-center py-2">
        <form action="" class="form-control bg-light shadow" style="min-width:300px; max-width: 800px;" method="post">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Код:</span>
                <select name="id_code" class="form-select" id="" required>
                    <option value="">Тестин кодун танданыз...</option>
                    <?php 
                        $get = $conn -> query("SELECT * FROM test_code");
                        while($row = mysqli_fetch_array($get)){
                            $selected = "";
                            if ($id_code == $row["id"]) {
                                $selected = "selected";
                            }
                            echo '<option '.$selected.' value="'.$row["id"].'"> <b>'.$row["code"].'</b></option>';
                        }
                    ?>
                </select>
            </div>
                <p class="border-bottom pb-2">
                    Тесттин жообун кийирип, кайсыл темага таандык экенин танданыз.
                </p>
                <div class="row border m-1">
                    <?php
                        $get = $conn -> query("SELECT * FROM type WHERE type = 2");
                        $option = '<option value="">Тема танданыз...</option>';
                        while($row = mysqli_fetch_array($get)){
                            $option = $option.'<option value="'.$row["id"].'">'.$row["kg"].'</option>';
                        }
                        $get = $conn -> query("SELECT * FROM test WHERE type=2 and  id_code=$id_code LIMIT 30 ");
                        $i = 0;
                        while ($row = mysqli_fetch_array($get)) { 
                            $i++;
                            $a = ($row["ans"] == "A"?"checked":"");
                            $b = ($row["ans"] == "B"?"checked":"");
                            $c = ($row["ans"] == "C"?"checked":"");
                            $d = ($row["ans"] == "D"?"checked":"");
                            $e = ($row["ans"] == "E"?"checked":"");
                            $id_type = $row["id_type"];
                            echo '
                            <div class="ansBlock row d-flex align-items-center my-1" title="Аналогия тест №'.$i.'">
                            <input type="hidden" name="id_'.$i.'" value="'.$row["id"].'">
                            <div class="col-1">
                                <div class="">
                                        '.$i.')
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-check">
                                    <input class="form-check-input" '.$a.' value="A" type="radio" name="ans_'.$i.'" id="ans_'.$i.'_1" required>
                                    <label class="form-check-label" for="ans_'.$i.'_1">
                                        А
                                    </label>
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-check">
                                    <input class="form-check-input" '.$b.' value="B" type="radio" name="ans_'.$i.'" id="ans_'.$i.'_2" required>
                                    <label class="form-check-label" for="ans_'.$i.'_2">
                                        Б
                                    </label>
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-check">
                                    <input class="form-check-input" '.$c.' value="C" type="radio" name="ans_'.$i.'" id="ans_'.$i.'_3" required>
                                    <label class="form-check-label" for="ans_'.$i.'_3">
                                        В
                                    </label>
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-check">
                                    <input class="form-check-input" '.$d.' value="D" type="radio" name="ans_'.$i.'" id="ans_'.$i.'_4" required>
                                    <label class="form-check-label" for="ans_'.$i.'_4">
                                        Г
                                    </label>
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-check">
                                    <input class="form-check-input" '.$e.' value="E" type="radio" name="ans_'.$i.'" id="ans_'.$i.'_5" required>
                                    <label class="form-check-label" for="ans_'.$i.'_5">
                                        Д
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <select class="form-select"  name="ans_select_'.$i.'" id="ans_select_'.$i.'" required>
                                    '.$option.'
                                </select>
                                <script>
                                    document.querySelector("#ans_select_'.$i.'").value='.$id_type.';
                                </script>
                            </div>
                            <hr class="mt-2">
                        </div>
                            ';
                        }
                    ?>
                </div>
                <div>
                    <button class="btn btn-primary form-control" type="submit" name="updateMath">Сактоо</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
require('footer.php');
?>


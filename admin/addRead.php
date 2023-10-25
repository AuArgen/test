<?php
require('header.php');
$test_count = 30;
if (isset($_POST["addMath"])) {
    $q = "INSERT INTO `test`(`id_code`, `date`, `id_user`, `type`, `ans`, `id_type`) VALUES";
    for ($i=1; $i <= $test_count; $i++) { 
        $id_code = $_POST["id_code"];
        $ans = $_POST["ans_$i"];
        $type = $_POST["ans_select_$i"];
        $q = $q. "($id_code,now(),1,4,'$ans',$type)";
        if ($i < $test_count) {
            $q = $q.',';
        }
    }
    $conn -> query($q);
    header("location:read.php");
}
?>
<div class="container-lg">
    <div class="row py-2 bg-light border-bottom">
        <div class="col">
            <h5>
            Окуу жана тушунуу жаны тест кошуу
            </h5>
        </div>
        <div class="col d-flex justify-content-end">
            <a class="btn btn-primary" href="read.php">Артка</a>
        </div>
    </div>
    <div class="d-flex justify-content-center py-2">
        <form action="" class="form-control bg-light shadow" style="min-width:300px; max-width: 800px;" method="post">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Код:</span>
                <select name="id_code" class="form-select" id="" required>
                    <option value="">Тестин кодун танданыз...</option>
                    <?php 
                        $get = $conn -> query("SELECT * FROM test_code ORDER BY id DESC");
                        while($row = mysqli_fetch_array($get)){
                            echo '<option value="'.$row["id"].'"> <b>'.$row["code"].'</b></option>';
                        }
                    ?>
                </select>
            </div>
                <p class="border-bottom pb-2">
                    Тесттин жообун кийирип, кайсыл темага таандык экенин танданыз.
                </p>
                <div class="row border m-1">
                    <?php
                        $get = $conn -> query("SELECT * FROM type WHERE type = 4");
                        $option = '<option value="">Тема танданыз...</option>';
                        while($row = mysqli_fetch_array($get)){
                            $option = $option.'<option value="'.$row["id"].'">'.$row["kg"].'</option>';
                        }
                        for ($i=1; $i <= $test_count; $i++) { 
                            echo '
                            <div class="ansBlock row d-flex align-items-center my-1" title="Окуу жана тест №'.$i.'">
                            <div class="col-1">
                                <div class="">
                                        '.$i.')
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-check">
                                    <input class="form-check-input" value="A" type="radio" name="ans_'.$i.'" id="ans_'.$i.'_1" required>
                                    <label class="form-check-label" for="ans_'.$i.'_1">
                                        А
                                    </label>
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-check">
                                    <input class="form-check-input" value="B" type="radio" name="ans_'.$i.'" id="ans_'.$i.'_2" required>
                                    <label class="form-check-label" for="ans_'.$i.'_2">
                                        Б
                                    </label>
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-check">
                                    <input class="form-check-input" value="C" type="radio" name="ans_'.$i.'" id="ans_'.$i.'_3" required>
                                    <label class="form-check-label" for="ans_'.$i.'_3">
                                        В
                                    </label>
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-check">
                                    <input class="form-check-input" value="D" type="radio" name="ans_'.$i.'" id="ans_'.$i.'_4" required>
                                    <label class="form-check-label" for="ans_'.$i.'_4">
                                        Г
                                    </label>
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-check">
                                    <input class="form-check-input" value="E" type="radio" name="ans_'.$i.'" id="ans_'.$i.'_5" required>
                                    <label class="form-check-label" for="ans_'.$i.'_5">
                                        Д
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <select class="form-select" name="ans_select_'.$i.'" id="" required>
                                    '.$option.'
                                </select>
                            </div>
                            <hr class="mt-2">
                        </div>
                            ';
                        }
                    ?>
                </div>
                <div>
                    <button class="btn btn-primary form-control" type="submit" name="addMath">Сактоо</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
require('footer.php');
?>


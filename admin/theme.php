<?php
$typeName = ["Математика","Аналогия","Грамматика","Окуу жана тушуунуу"];
$typeLink = ["math.php","analogia.php","grammer.php","read.php"];
$type = $_GET["type"] - 1;
$getLink = $typeLink[$type];
$getType = $typeName[$type];
require('header.php');
if(isset($_POST["addTheme"])) {
    $themeKg = $_POST["themeKg"];
    $themeRu = $_POST["themeRu"];
    $get = $conn -> query("SELECT * FROM type WHERE kg = '$themeKg' and ru = '$themeRu' and type=$type+1");
    if (!mysqli_num_rows($get)) {
        $conn -> query("INSERT INTO type (kg, ru, type) VALUES('$themeKg', '$themeRu', $type+1)");
    }
    header("location: theme.php?type=".($type+1));
}
if(isset($_POST["updateTheme"])) {
    $themeKg = $_POST["themeKg"];
    $themeRu = $_POST["themeRu"];
    $id = $_POST["id"];
    $get = $conn -> query("UPDATE type SET kg='$themeKg', ru='$themeRu' WHERE id=$id");
    header("location: theme.php?type=".($type+1));
}
if(isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $conn -> query("DELETE FROM type WHERE id = $id");
    header("location: theme.php?type=".($type+1));
}
?>
<div class="container-lg">
    <div class="row py-2 bg-light border-bottom">
        <div class="col">
            <h5>
                <?php
                    echo $getType;
                 ?> боюнча темалар
            </h5>
        </div>
        <div class="col-1 d-flex justify-content-end">
            <a class="" href="<?php echo $getLink;?>">Артка</a>
        </div>
        <div class="col-1 d-flex justify-content-end">
            <a href="" data-bs-toggle="modal" data-bs-target="#theme">Жаны тема</a>

            <!-- Modal -->
            <div class="modal fade" id="theme" tabindex="-1" aria-labelledby="themeLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="themeLabel">Тема кошуу</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="" method="post">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Тема KG</span>
                                <input type="text" class="form-control" name="themeKg" placeholder="Тема жазыныз..." aria-label="Тема" aria-describedby="basic-addon1" minlength=3 required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Тема RU</span>
                                <input type="text" class="form-control" name="themeRu" placeholder="Введите тема..." aria-label="Тема" aria-describedby="basic-addon1" minlength=3 required>
                            </div>
                            <input type="submit" class="d-none" name="addTheme" id="addTheme">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Кайтуу</button>
                        <label for="addTheme" type="button" class="btn btn-primary">Сактоо</label>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- Modal update -->
            <div class="modal fade" id="themeUpdate" tabindex="-1" aria-labelledby="themeUpdateLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="themeUpdateLabel">Тема ондоо</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="" method="post">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Тема KG</span>
                                <input type="text" class="form-control" id="updateKg" name="themeKg" placeholder="Тема жазыныз..." aria-label="Тема" aria-describedby="basic-addon1" minlength=3 required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Тема RU</span>
                                <input type="text" class="form-control" id="updateRu" name="themeRu" placeholder="Введите тема..." aria-label="Тема" aria-describedby="basic-addon1" minlength=3 required>
                            </div>
                            <input type="hidden" id="updateId" name="id">
                            <input type="submit" class="d-none" name="updateTheme" id="updateTheme">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Кайтуу</button>
                        <label for="updateTheme" type="button" class="btn btn-primary">Сактоо</label>
                    </div>
                    </div>
                </div>
            </div>

    <table class="table table-striped hover">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Тема KG</th>
            <th scope="col">Тема RU</th>
            <th scope="col">Удалить</th>
            <th scope="col">Ондоо</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $get = $conn -> query("SELECT * FROM type WHERE type = $type+1 ORDER BY id DESC");
                $count = 1;
                while ($row = mysqli_fetch_array($get)) {
                    echo '         
                    <tr>
                        <th scope="row">'.$count++.'</th>
                        <td id="themeKg_'.$row['id'].'">'.$row["kg"].'</td>
                        <td id="themeRu_'.$row['id'].'">'.$row["ru"].'</td>
                        <td><a class="text-danger" href="?type=',$type+1,'&delete='.$row['id'].'">Удалить</a></td>
                        <td> <a class="text-success" data-bs-toggle="modal" data-bs-target="#themeUpdate" onclick="update('.$row['id'].')">Ондоо</a></td>
                    </tr>
                    ';
                }
            ?>
        </tbody>
    </table>
    <script>
        function update(id){
            document.querySelector('#updateId').value = id;
            document.querySelector('#updateKg').value = document.querySelector(`#themeKg_${id}`).textContent;
            document.querySelector('#updateRu').value = document.querySelector(`#themeRu_${id}`).textContent;
        }
    </script>
</div>
<?php
require('footer.php');
?>


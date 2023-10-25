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
        <div class="col-1 d-flex justify-content-end">
            <a href="" data-bs-toggle="modal" data-bs-target="#theme">Жаны тест</a>

            <!-- Modal -->
            <div class="modal fade" id="theme" tabindex="-1" aria-labelledby="themeLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="themeLabel">Тест кошуу</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="" method="post">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Тестке код</span>
                                <input type="number" class="form-control" name="code" placeholder="Код..." aria-label="Тема" aria-describedby="basic-addon1" minlength=3 required>
                            </div>
                            <input type="submit" class="d-none" name="addTest" id="addTest">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Кайтуу</button>
                        <label for="addTest" type="button" class="btn btn-primary">Сактоо</label>
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
                        <h1 class="modal-title fs-5" id="themeUpdateLabel">Тест ондоо</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="" method="post">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Тестке код</span>
                                <input type="number" class="form-control" name="code" id="testUpdate" placeholder="Код..." aria-label="Тема" aria-describedby="basic-addon1" minlength=3 required>
                            </div>
                            <input type="hidden" id="updateId" name="id">
                            <input type="submit" class="d-none" name="updateTest" id="updateTest">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Кайтуу</button>
                        <label for="updateTest" type="button" class="btn btn-primary">Сактоо</label>
                    </div>
                    </div>
                </div>
            </div>

    <table class="table table-striped hover">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Тест коду</th>
            <th scope="col">Дата</th>
            <th scope="col">Удалить</th>
            <th scope="col">Ондоо</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $get = $conn -> query("SELECT * FROM test_code ORDER BY id DESC");
                $count = 1;
                while ($row = mysqli_fetch_array($get)) {
                    echo '         
                    <tr>
                        <th scope="row">'.$count++.'</th>
                        <td id="test_'.$row['id'].'">'.$row["code"].'</td>
                        <td id="">'.$row["date"].'</td>
                        <td><a class="text-danger" href="?delete='.$row['id'].'">Удалить</a></td>
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
            document.querySelector('#testUpdate').value = document.querySelector(`#test_${id}`).textContent;
        }
    </script>
</div>
<?php
require('footer.php');
?>


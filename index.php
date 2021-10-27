<?php
  require 'functions.php';
  require 'confDB.php';
?>  
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Список слов</title>
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="img/icon.ico" type="image/x-icon">
</head>
<body>

  <header class="main-header">
    <div class="container d-flex justify-content-around align-items-center">
      TEST1
    </div>
  </header>

  <section>

    <div class="container">
      <div class="shadow-lg bg-white main-area p-4 col-12">
        <button type="button" class="btn btn-success m-4" data-toggle="modal" data-target="#exampleModal">
            Добавить слово
        </button>
      </div>
    </div>
      
    <div class="m-2">
            <?php
                if (isset($_SESSION['success'])){
                    display_flash_message("success");
                }
                if (isset($_SESSION['danger'])){
                    display_flash_message("danger");
                }
            ?>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавить пользователя</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form class="form-group" action="register.php" method="post">
                <div class="modal-body d-flex flex-column">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Имя</label>
                      <input name="user_name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Логин</label>
                      <input name="email" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Пароль</label>
                      <input name="password" type="password" class="form-control dissable_field_pass" id="exampleInputPassword1" required>
                    </div>
                    <div class="form-check form-check-inline w-100">
                      <input name="admin" class="form-check-input ml-3" type="checkbox" id="inlineCheckbox1" value="admin">
                      <label class="form-check-label ml-2" for="inlineCheckbox1">Администратор</label>
                    </div>
                    <div class="form-check form-check-inline w-100">
                      <input name="new_pass" class="form-check-input ml-3" type="checkbox" id="inlineCheckbox2" value="1">
                      <label class="form-check-label ml-2" for="inlineCheckbox2">Сменить пароль при входе</label>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Отмена</button>
                  <button id="create" name="create" type="submit" class="btn btn-primary">Добавить</button>
                </div>
              </form>  
          </div>
        </div>
      </div>


  </section>
</body>
</html>


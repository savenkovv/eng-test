<?php
  require 'functions.php';
  require 'confDB.php';
  $sql = "SELECT * FROM words";
  $statement = $pdo->prepare($sql);
  $statement->execute();
  $words = $statement->fetchAll(PDO::FETCH_ASSOC);
?>  
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>СЛОВАРЬ</title>
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="img/icon.ico" type="image/x-icon">
</head>
<body>

  <header class="main-header">
    <div class="container d-flex justify-content-between align-items-center">
      <div class="page-name"><b>СЛОВАРЬ</b></div>
      <div class="links">
        <a href="test_eng.php" class="border rounded p-2">Тест ENG</a>
        <a href="test_rus.php" class="border rounded p-2">Тест RUS</a>
      </div>
    </div>
  </header>

  <section>

    <div class="container">
      <div class="shadow-lg bg-white main-area p-4 col-12">

        <div class="d-flex flex-column col-12">
          <button type="button" class="btn btn-success m-4 w-50" data-toggle="modal" data-target="#exampleModal">
            Добавить новое слово
          </button>
          
            <div class="d-flex flex-row align-items-center flex-wrap justify-content-start col-12">
              <?php foreach ($words as $word): ?>
                <div class="d-flex align-items-center col-12 border-bottom words">
                  <div class="word1 m-1 col-5"><b><?php echo $word['word1'];?></b></div>
                  <div class="col">-</div>
                  <div class="word2 m-1 col-5"><b><?php echo $word['word2'];?></b></div>
                  <div class="col-1">
                    <button type="button" class="btn btn-secondary p-2">!</button>
                    <button type="button" class="btn btn-danger p-2">x</button>
                  </div>
                  
                  
                  
                </div>
              <?php endforeach;?>  
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
                <h5 class="modal-title" id="exampleModalLabel">Добавить новое слово</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form class="form-group" action="new_word.php" method="post">
                <div class="modal-body d-flex flex-column">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Слово</label>
                    <input name="word1" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Перевод</label>
                    <input name="word2" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
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
    </div>

  </section>
  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/7fb1e43a84.js" crossorigin="anonymous"></script>
</body>
</html>


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
  <title>TEST1</title>
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="img/icon.ico" type="image/x-icon">
</head>
<body>

  <header class="main-header">
    <div class="container d-flex justify-content-between align-items-center">
      <div class="page-name"><b>ТЕСТ RUS</b></div>
      <div class="links">
        <a href="index.php" class="border rounded p-2">Словарь</a>
        <a href="test_eng.php" class="border rounded p-2">Тест ENG</a>
        <a href="test_rus.php" class="border rounded p-2">Тест RUS</a>
      </div>
    </div>
  </header>

  <section>

    <div class="container">
      <div class="shadow-lg bg-white main-area p-4 col-12">
      <form action="check_rus.php" method="post" class="d-flex flex-column col-12">
        
        <?php
          $i=0;
          shuffle($words);
        ?>
        <?php foreach ($words as $word): ?>
          <div class="d-flex flex-row form-group align-items-center col-10 justify-content-start m-0">
            <div class="word1 col-3"><b><?php echo $word['word2'];?></b></div>
            <input type="text" class="word2 m-2 col-3" name="word1">
            <input type="hidden" name="id" value="<?php echo $word['id'];?>">
          </div><hr class="hr1">
        <?php if(++$i == 1) break;?>
        <?php endforeach;?>
        <button id="create" name="create" type="submit" class="btn btn-primary col-3">Проверить</button>
      </form>
      </div>
    </div>
      


  </section>
</body>
</html>


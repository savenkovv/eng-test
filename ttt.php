<?php
  require 'functions.php';
  require 'confDB.php';
  $sql = "SELECT * FROM words";
  $statement = $pdo->prepare($sql);
  $statement->execute();
  $words = $statement->fetchAll(PDO::FETCH_ASSOC);


$i = 0;



shuffle($words);
foreach ($words as $k => $word) {
  
  echo $word['word1'].'<br>';

}

?>
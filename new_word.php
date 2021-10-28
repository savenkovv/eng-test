<?php
  session_start();
  require 'functions.php';
  require 'confDB.php';

  if (is_banned()) {
    redirect_to("page_ban.php");
    exit;
  }

$word1 = $_POST['word1'];
$word2 = $_POST['word2'];
$word1_db = get_word($word1);
if (!empty($word1_db)) {
  set_flash_message("danger", "Такое слово уже есть в словаре");
  redirect_to('index.php');
  exit;
}

if (empty($word1_db)) {
new_word($word1, $word2);
set_flash_message("success", "Слово добавлено в словарь");
redirect_to('index.php');
exit;
}

?>
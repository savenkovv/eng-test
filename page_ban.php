<?php
session_start();
unset($_SESSION["user"]);
unset($_SESSION["user_e"]);
echo "ДОСТУП ЗАПРЕЩЕН!";
?>
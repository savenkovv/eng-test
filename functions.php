<?php
session_start();
require "confDB.php";




function new_word($word1, $word2)
{
	require 'confDB.php';
	$sql = "INSERT INTO words (word1, word2) VALUES (:word1, :word2)";
	$statement = $pdo->prepare($sql);
	$statement->execute(['word1' => $word1, 'word2' => $word2]);
}


function is_banned(){
	require 'confDB.php';
	$id = $_SESSION["user"]["id"];
  $sql = "SELECT banned FROM users WHERE id=:id";
  $statement = $pdo->prepare($sql);
  $statement->execute(['id' => $id]);
  $banned = $statement->fetch(PDO::FETCH_ASSOC);
  if ($banned["banned"] == "1") {
    return true;
  }
  if ($banned["banned"] == "0") {
    return false;
  }
}


function logout()
{
    unset($_SESSION["user"]);
    unset($_SESSION["user_e"]);
    redirect_to("index.php");
}


function login($email, $password)
{
	$user = get_user_by_email($email);
	if (!empty($user))
	{
	  if (password_verify($password, $user['password']))
		{
			
			$user = [
				"email" => $user["email"],
				"id" => $user["id"],
				"role" => $user["role"],
				"user_name" => $user["user_name"]
			];
			$_SESSION['user'] = $user;
			return true;
		}
	}
	set_flash_message("danger", "Введен неправильный логин или пароль");
	return false;
}


function is_not_auth(){
	if (!isset($_SESSION['user'])){
		return true;
	}
	else{
		return false;
}}


function is_auth()
{
	if (!is_not_auth()) {
	return $_SESSION['user'];
}
	return false;;
}


function add_user($user_name, $email, $password, $admin, $new_pass){
	require "confDB.php";
	/*$user_name = $_POST['user_name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$admin = $_POST['admin'];*/
	if (isset($new_pass)) {
		if (isset($admin)) {
		$sql = "INSERT INTO users (user_name, email, password, role, new_pass) VALUES (:user_name, :email, :password, :admin, :new_pass)";
		$statement = $pdo->prepare($sql);
		$statement->execute(['user_name' => $user_name, 'email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT), 'admin' => $admin, 'new_pass' => $new_pass]);
		}
		if (!isset($admin)) {
		$sql = "INSERT INTO users (user_name, email, password, new_pass) VALUES (:user_name, :email, :password, :new_pass)";
		$statement = $pdo->prepare($sql);
		$statement->execute(['user_name' => $user_name, 'email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT), 'new_pass' => $new_pass]);
		}
	}
	if (!isset($new_pass)) {
		if (isset($admin)) {
		$sql = "INSERT INTO users (user_name, email, password, role) VALUES (:user_name, :email, :password, :admin)";
		$statement = $pdo->prepare($sql);
		$statement->execute(['user_name' => $user_name, 'email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT), 'admin' => $admin]);
		}
		if (!isset($admin)) {
		$sql = "INSERT INTO users (user_name, email, password) VALUES (:user_name, :email, :password)";
		$statement = $pdo->prepare($sql);
		$statement->execute(['user_name' => $user_name, 'email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT)]);
		}
	}	
}



function is_admin($user)
{	if (is_auth()) {
		$user = $_SESSION['user'];
		if ($user['role'] == "admin") {
  		return true;
		}
	}
  else{
    return false;
  }
}




function set_flash_message($name, $message)
{
	$_SESSION[$name] = $message;
}


function display_flash_message($name){
	if (isset($_SESSION[$name])){
		echo "<div class=\"alert alert-{$name} text-dark flash-msg-log\" role=\"alert\">{$_SESSION[$name]}</div>";
		unset($_SESSION[$name]);
	}}


	function get_word($word1){
		require "confDB.php";
		$sql = "SELECT * FROM words WHERE word1=:word1";
		$statement = $pdo->prepare($sql);
		$statement->execute(['word1' => $word1]);
		$word1_db = $statement->fetch(PDO::FETCH_ASSOC);
		return($word1_db);}



function get_user_by_email($email){
	require "confDB.php";
	$sql = "SELECT * FROM users WHERE email=:email";
	$statement = $pdo->prepare($sql);
	$statement->execute(['email' => $email]);
	$user_e = $statement->fetch(PDO::FETCH_ASSOC);
	return($user_e);}


function get_user_by_name($user_name){
	require "confDB.php";
	$sql = "SELECT * FROM users WHERE user_name=:user_name";
	$statement = $pdo->prepare($sql);
	$statement->execute(['user_name' => $user_name]);
	$user_n = $statement->fetch(PDO::FETCH_ASSOC);
	return($user_n);}


  function redirect_to($path){
    header("Location:".$path);
    exit;};



?>
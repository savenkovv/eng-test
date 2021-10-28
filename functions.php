<?php
session_start();
require "confDB.php";






function edit_photo()
{
	require "confDB.php";
	if (isset($_POST["btn_edit_photo"])) {
		$allow = [
			'jpg', 'jpeg', 'bmp', 'png'
		];
		$id = $_POST['id'];
		$brand_id = $_POST['brand_id'];
		$tmp_name = $_FILES["photo"]["tmp_name"];
		$photo_name = $_FILES["photo"]["name"];
		
		$photo_name = preg_replace('/[^A-Za-z0-9А-Яа-я.-]/iu', '_', $_FILES['photo']['name']);
	
		$sql = "SELECT * FROM shop WHERE photo_name=:photo_name";
		$statement = $pdo->prepare($sql);
		$statement->execute(['photo_name' => $photo_name]);
		$photo = $statement->fetch(PDO::FETCH_ASSOC);
		$path   = 'img/shop/';
		$prefix = '';
		$parts = pathinfo($photo_name);
		if (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
			set_flash_message("danger", "Недопустимый тип файла");
			if ($brand_id == 1){
				redirect_to("septics/unilos-astra/astra.php?id=$id");
			}
			if ($brand_id == 2){
				redirect_to("septics/volgar/volgar.php?id=$id");
			}
			if ($brand_id == 3){
				redirect_to("septics/garda/garda.php?id=$id");
			}
			exit;
		}
		if (!empty($photo['photo_name'])) {
			$i = 0;
			while (is_file($path . $parts['filename'] . $prefix . '.' . $parts['extension'])) {
				$prefix = '(' . ++$i . ')';
			}
			$photo_name = $parts['filename'] . $prefix . '.' . $parts['extension'];
		}
			
			$photo_path = $path . $photo_name;
			move_uploaded_file( $tmp_name, $photo_path );
	
			$sql = "UPDATE shop SET photo_name=:photo_name, photo_path=:photo_path WHERE id=:id";
			$statement = $pdo->prepare($sql);
			$statement->execute(['photo_name' => $photo_name, 'photo_path' => $photo_path, 'id' => $id]);
			set_flash_message("success", "Фото обновлено!");
			if ($brand_id == 1){
				redirect_to("septics/unilos-astra/astra.php?id=$id");
			}
			if ($brand_id == 2){
				redirect_to("septics/volgar/volgar.php?id=$id");
			}
			if ($brand_id == 3){
				redirect_to("septics/garda/garda.php?id=$id");
			}
			exit;
		}
}



function edit_item($prop)
{
	require "confDB.php";
	if (isset($_POST["btn_edit_$prop"])) { 
		$brand_id = $_POST['brand_id'];
		$data = [
			"$prop" => $_POST[$prop],
			"id" => $_POST['id']
		]; 
		$sql = "UPDATE shop SET $prop=:$prop WHERE id=:id";
		$statement = $pdo->prepare($sql);
		$res = $statement->execute($data);
		// var_dump($brand_id);
		set_flash_message("success", "Товар обновлен!");
		if ($brand_id == 1){
			redirect_to("septics/unilos-astra/astra.php?id=$data[id]");
		}
		if ($brand_id == 2){
			redirect_to("septics/volgar/volgar.php?id=$data[id]");
		}
		if ($brand_id == 3){
			redirect_to("septics/garda/garda.php?id=$data[id]");
		}
		exit;
	}
}

// $sql = "UPDATE $table SET $desc=:$desc WHERE $table_item=:$id";
//     $statement = $pdo->prepare($sql);
//     $res = $statement->execute($data);









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



function set_order_msg()
{
	# code...
}
 

function display_order_msg()
{
	if (isset($_SESSION["order-success"])){
		echo "
		<div class=\"d-flex justify-content-center align-items-center border border-success order-msg\" id=\"order-msg\">
			<div class=\"\">
				Заказ успешно оформлен! <br>
				Мы скоро с вами свяжемся
			</div>
			<button id=\"close-msg-icon\" class=\"close-msg-icon\">X</button>
		</div>
		";
		unset($_SESSION["order-success"]);
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


  function DelSession()
  {
    unset($_SESSION);
  }


?>
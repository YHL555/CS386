<?php

if($connection) {
echo“is connected”；
}
    
echo "from functions";

function set_message($msg){

if(!empty($msg)) {

$_SESSION['message'] = $msg;

} else {

$msg = "";

}

}

function display_message() {

	if(isset($_SESSION['message'])) {

		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}

}

function login_user(){

if(isset($_POST['submit'])){

$username = escape_string($_POST['username']);
$password = escape_string($_POST['password']);

$query = query("SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}' ");
confirm($query);


if(mysql_num_rows($query) == 0) {

set_message("Your Password or Username are wrong");
redirect("login.php");

} else {

set_message("Welcome to Admin {$username}");
redirect("admin");

}


}

}

?>
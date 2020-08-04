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

$_SESSION['username'] = $username;
redirect("admin");

}


}

}




·

/************* Admin Products **********/

function get_products_in_admin()
{
	$query = query(" SELECT * FROM products");

confirm($query);

while($row = fetch_array($query)){

$product = <<<DELIMETER


      <tr>
            <td>{$row['product_id']}</td>
            <td>{$row['product_title']}<br>
              <a href="index.php?edit_product$id={$row['product_id']}"><img src="h{$row['product_image']}" alt="">
            </td>
            <td>Category</td>
            <td>{$row['product_price']}</td>
            <td>{$row['product_quantity']}</td>
        </tr>
      

	

DELIMETER;

echo $product;


}

/*****BACK END FUNCTION ******/

function display_orders(){

	$query = query("SELECT * FROM orders");
	confirm($query);

	while($row = fetch_array($query)){

		$orders = <<<DELIMETER

		<tr>
		    <td>{$row['prder_id']}</td>
		    <td>{$row['prder_amount']}</td>
		    <td>{$row['prder_transaction']}</td>
		    <td>{$row['prder_currency']}</td>
		    <td>{$row['prder_status']}</td>
		    <td><a class="btn btn-danger href="../../resources/templates/back/delete_order.php?id={$row['order_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
		</tr>

		DELIMETER;

		echo " $orders";
	}
}


/************ ADD Products in admin**********/

function add_product() {


	if(isset($_POST['publish'])){


	 $product_title          = escape_string($_POST['product_title']);
	 $product_category_id    = escape_string($_POST['product_category_id']);
	 $product_price          = escape_string($_POST['product_price']);
	 $product_description    = escape_string($_POST['product_description']);
	 $product_short_desc     = escape_string($_POST['short_desc ']);

	$product_quantity        = escape_string($_POST['product_quantity']);

	$product_image           = escape_string($_FILES['file']['name']);

	$image_temp_location     = escape_string($_FILES['file']['tmp_name']);
     
     move_uploaded_file($image_temp_location , UPLOAD_DIRECTORY . DS . $product_image);   

	}
}

?>
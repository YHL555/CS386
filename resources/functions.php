<?php

$uploads_directory = "uploads";


//helper functions

function last_id(){


	global $connection;

	return mysqli_insert_id($connection);

}



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

/****************** Admin Products Page ****************/

function display_image($picture){

global $uploads_directory;

return $uploads_directory . DS . $picture;




}




function get_products_in_admin()
{
	$query = query(" SELECT * FROM products");

confirm($query);

while($row = fetch_array($query)){

$product_image = display_image($row['product_image']);

$category = show_product_category_title($row[product_category_id)]);

$product_image = display_image($row['product_image']);

$product = <<<DELIMETER


      <tr>
            <td>{$row['product_id']}</td>
            <td>{$row['product_title']}<br>
              <a href="index.php?edit_product$id={$row['product_id']}"><img width='100'src="../../resources/{$product_image}" alt="">
            </td>
            <td>{$category}</td>
            <td>{$row['product_price']}</td>
            <td>{$row['product_quantity']}</td>

        </tr>
     

DELIMETER;

echo $product;
	

}
//get products

function get_products(){
$query = query(" SELECT * FROM products");

confirm($query);

while($row = fetch_array($query)){

$product = <<<DELIMETER
<div class="col-sm-4 col-lg-4 col-md-4">
    <div class="thumbnail">
        <a href="item.php?id={$row['product_id']}"><img src="../resources/{$product_image}" alt=""></a>
        <div class="caption">
            <h4 class="pull-right">&36#;{$row['product_price']}</h4>
            <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
            </h4>
            <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
            <a class="btn btn-primary" target="_blank" href="item.php?id={$row['product_id']}">Add to cart</a>
        </div>


    </div>
</div>

	

DELIMETER;

echo $product;



	}

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
	 $product_short_desc     = escape_string($_POST['short_desc']);
	 $product_quantity       = escape_string($_POST['product_quantity']);
   $product_image          = escape_string($_FILES['file']['name']);
   $image_temp_location    = escape_string($_FILES['file']['tmp_name']);
     
     move_uploaded_file($image_temp_location , UPLOAD_DIRECTORY . DS . $product_image); 


     $query = query("INSERT INTO products(product_title, product_category_id, product_price, product_description, short_desc, product_quantity, product_image) VALUES('{$product_title}', '{$product_category_id}', '{$product_price}', '{$product_description}', '{$short_desc}', '{$product_quantity}', '{$product_image}')");
     
     confirm($query);

     set_message("New Product with id {$last_id} was Added");

     redirect("index.php?products");



	}
}

function show_categories_add_product_page(){

$query = query("SELECT * FROM categories");

confirm($query );


while($row = fetch_array($query)) {

$categories_opinions = <<<DELIMETER

<option value=">{$row['cat_id']}">{$row['cat_title']}</option>

DELIMETER;

echo $categories_opinions;


    }

}



function show_product_category_title($product_category_id){


$category_query = query("SELECT * FROM categories WHERE cat_id = '{$product_category_id}' ");

confirm($category_query);

while($category_row = fetch_array($category_query)) {

return $category_row['cat_title'];

}




}

function get_products_in_cat_page(){

$query = query(" SELECT * FROM products WHERE product_category_id = " . escape_string($_GET['id']) . " "); 
confirm($query);


while($row = fetch_array($query)){

$product_image = display_image($row['product_image']);

$product = <<<DELIMETER
   <div class="col-md-3 col-sm-6 hero-feature">
       <div class="thumbnail">
           <img src="../resources/{$product_image}" alt="">
           <div class="caption">
               <h3>{$row['product_title']}</h3>
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
               <p>
                   <a href="../resources/cart.php?add = {$row['product_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
               </p>
           </div>
       </div>
   </div>
 

DELIMETER;

echo $product;



 }

}



function get_products_in_shop_page(){

$query = query(" SELECT * FROM products"); 
confirm($query);


while($row = fetch_array($query)){

$product = <<<DELIMETER


   <div class="col-md-3 col-sm-6 hero-feature">
       <div class="thumbnail">
           <img src="../resources{$product_image}" alt="">
           <div class="caption">
               <h3>{$row['product_title']}</h3>
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
               <p>
                   <a href="../resources/car.php? add={$row['product_id']}" class="btn btn-primary">Buy Now!</a> 
                   <a href="item.php? id={$row['product_id']}" class="btn btn-default">More Info</a>
               </p>
           </div>
       </div>
   </div>
 

DELIMETER;

echo $product;



 }

}

/*******************updating product code******************/

function update_product() {


  if(isset($_POST['update'])){


   $product_title          = escape_string($_POST['product_title']);
   $product_category_id    = escape_string($_POST['product_category_id']);
   $product_price          = escape_string($_POST['product_price']);
   $product_description    = escape_string($_POST['product_description']);
   $product_short_desc     = escape_string($_POST['short_desc']);
   $product_quantity       = escape_string($_POST['product_quantity']);
   $product_image          = escape_string($_FILES['file']['name']);
   $image_temp_location    = escape_string($_FILES['file']['tmp_name']);


   if(empty($product_image)){


  $get_pic= query("SELECT product_image FROM products Where product_id = " .escape_string($_GET['id'])." ");

  comfirm($get_pic);

  while($pic =fetch_array($get_pic)){

    $product_image = $pic['product_image'];


  }

   }


     
     move_uploaded_file($image_temp_location , UPLOAD_DIRECTORY . DS . $product_image); 


     $query = "UPDATE products SET ";
     $query . = "product_title        = '{product_title}'         ,";
     $query . = "product_category_id  = '{product_category_id}'   ,";
     $query . = "product_price        = '{product_price}'         ,";
     $query . = "product_description  = '{product_description}'   ,";
     $query . = "short_desc           = '{short_desc'             ,";
     $query . = "product_quantity     = '{product_quantity}'      ,";
     $query . = "product_image        = '{product_image}'          ";
     $query . = "WHERE product_id=" . escape_string($GET['id']);
          
     




     $send_update_query = query($query);

     confirm($query);

     set_message("Product has been updated");

     redirect("index.php?products");



  }
}

/******************Categories in admin*****************/


function show_categories_in_admin(){


$category_query = query("SELECT * FROM categories");
confirm($category_query);



while($row =fetch_array($category_query)){

  $cat_id = $row['cat_id'];
  $cat_title = $row['cat_title'];


$category = <<<DELIMETER

<tr>
    <td>{$cat_id}</td>
    <td>{$cat_title}</td>
    <td> <a href="index.php?edit_product$id={$row['product_id']}"><img width='100'src="../../resources/{$product_image}" alt=""></td>
</tr>


DELIMETER

echo $category;

}

}


function add_category(){

if(isset($_POST['add_category'])){

$cat_title = escape_string($_POST['cat_title']);

$insert_cat = query("INSERT INTO categories(cat_title) VALUES ('{$cat_title}')");

confirm($insert_cat);

if(mysqli_affected_rows($insert_cat) == 0){

set_message("NOTHING WORKED");

}

redirect("index.php?categories");

}



}


















?>
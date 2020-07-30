<?php require_once(". ./resources/config.php"); ?>

<?php

if(isset($_GET['add'])) {

    $query = query("SELECT * FROM products WHERE product_id=" . escape_string($_GET['add']). " ");
    confirm($query);


    while($row = fetch_array($query)) {


        if($row['product_quantity'] != $_SESSION['product_' . $_GET['add']]) {

            $_SESSION['product_' . $_GET['add']] +=1;
            redirect("../public/checkout.php");

        } else {


            set_message("We only have " . $row['product_quantity'] . " " . "{$row['product_title']}" . " available");
            redirect("../public/checkout.php");



        }



    }

    //$_SESSION['product_' . $_GET['add']] +=1;

    //redirect("index.php");
}


if(isset($_GET['remove'])) {

    $_SESSION['product_' . $_GET['remove']]--;

    if($_SESSION['product_' . $_GET['remove']] < 1) {

        redirect("../publiccheckout.php");

    } else {

        redirect("../public/checkout.php");

    }
}


if(isset($_GET['delete'])) {

$_SESSION['product_' . $_GET['delete']] = '0';

redirect("../public/checkout.php");

}

function cart() {

$total = 0;

$item_quantity = 0;

$item_name = 1;

$item_number = 1;

$amount = 1;

$quantity = 1;

foreach ($_SESSION as $name => $value) {

if($value > 0 ) {

if(substr($name, 0, 8 ) == "product_") {

$length = strlen($name - 8);

$id = substr($name, 8 , $length);


$query = query("SELECT * FROM products WHERE product_id = " . escape_string($id). " ");
confirm($query);

while($row = fetch_array($query)) {

$sub = $row['product_price']*$value;

$item_quantity += $value;

$product_image = display_image($row['product_image']);

$product = <<<DELIMETER


<tr>
    <td>{$row['product_title']}<br>

    <img width= '100' src='../resources/{$product_image}'>

    </td>
    <td>&#36;{$row['product_price']}</td>
    <td>{$value}</td>
    <td>&#36;{$sub}</td> 
    <td><a class='btn btn-warning' href="../resources/cart.php?remove={$row['product_id']}"><span calss='glyphicon glyphicon-minus'></span></a>   <a class='btn btn-success' href="../resources/cart.php?add={$row['product_id']}"><span calss='glyphicon glyphicon-plus'></span></a>  
    <a class='btn btn-danger' href="../resources/cart.php?delete={$row['product_id']}"><span calss='glyphicon glyphicon-remove'></span></a> </td>

</tr>
<input type="hidden" name="item_name_{$item_name}" value="{$row['product_title']}">
<input type="hidden" name="item_number_{$item_number}" value="{$row['product_id']}">
<input type="hidden" name="amount_{$amount}" value="{$row['product_price']}">
<input type="hidden" name="quantity_{$quantity}" value="{$value}">

DELIMETER;

echo $product;

$item_name++;

$item_number++;

$amount++;

$quantity++;

}

$_SESSION['item_total'] = $total += $sub;

}

}

}

}

function show_paypal() {

    if(isset($_SESSION['item_quantity']) && $_SESSION['item_quantity'] >= 1){


        $paypal_button = <<<DELIMETER

        <input type="image" name="upload" border="0" src="https://www.paypalobject.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal - The safer, easier way to pay online">

        DELIMETER;

        return $paypal_button;
    }
}

function report() {

$total = 0;

$item_quantity = 0;

foreach ($_SESSION as $name => $value) {

if($value > 0 ) {

if(substr($name, 0, 8 ) == "product_") {

$length = strlen($name - 8);

$id = substr($name, 8 , $length);


$query = query("SELECT * FROM products WHERE product_id = " . escape_string($id). " ");
confirm($query);

while($row = fetch_array($query)) {

$sub = $row['product_price']*$value;
$product_price = $row['product_price'];

$item_quantity +=$value;



$insert_report = query("INSERT INTO reports(product_id, product_price, product_quantity) VALUES ('{$id}'),'{$product_price}','{$value}')");

confirm($insert_report);


}

$total += $sub;
echo $item_quantity;

}

}

}
else{

    redirect("index.php");
}




}

?>






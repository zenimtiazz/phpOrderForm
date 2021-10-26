<?php

declare(strict_types=1);




date_default_timezone_set("Europe/Brussels");


if (!isset($_SESSION['email'])) {
    $_SESSION['email'] = "";
}
if (!isset($_SESSION['street'])) {
    $_SESSION['street'] = "";
}
if (!isset($_SESSION['streetNumber'])) {
    $_SESSION['streetNumber'] = "";
}
if (!isset($_SESSION['city'])) {
    $_SESSION['city'] = "";
}
if (!isset($_SESSION['zipcode'])) {
    $_SESSION['zipcode'] = "";
}
$total = 0;
if (isset($_COOKIE['total'])) {
$total = ($_COOKIE['total']);
}

//Cookie variables

// function whatIsHappening()
// {
//     echo '<h2>$_GET</h2>';
//     var_dump($_GET);
//     echo '<h2>$_POST</h2>';
//     var_dump($_POST);
//     echo '<h2>$_COOKIE</h2>';
//     var_dump($_COOKIE);
//     echo '<h2>$_SESSION</h2>';
//     var_dump($_SESSION);
// }


$emailErr = $streetErr = $streetNumberErr = $cityErr = $zipcodeErr = "";
$email = $street = $streetNumber = $city = $zipcode = "";

$food = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];

$drinks = [
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 3],
];




if (isset($_GET['food'])) {
    if ($_GET['food'] == 1) {
        $products = $food;
       
    } else {
        $products = $drinks;
       
    }
}
if(isset($_POST['express_delivery'])){
    $totalvalue+=5;
    $deliveryTime = "45 Minutes";
}
else{
    $deliveryTime = "2 hours";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // var_dump($_POST["items"]);
  
    $_SESSION['email'] = $_POST["email"];
    $_SESSION['street'] = $_POST["street"];
    $_SESSION['streetNumber'] = $_POST["streetNumber"];
    $_SESSION['city'] = $_POST["city"];
    $_SESSION['zipcode'] = $_POST["zipcode"];


    if (empty($_POST["email"]) ){
        $email = "";
        } else {
        $email = ($_POST['email']);
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            $emailErr = "Invalid email";
        }
    }

    if (empty($_POST["street"]) || !preg_match("/^[a-zA-Z]+$/", $_POST["street"])) {
        $streetErr = "* Street name is required";
    } else {
        $street = ($_POST["street"]);
    }

    if (empty($_POST["streetNumber"]) || !preg_match('/^[1-9][0-9]*$/', $_POST["streetNumber"])) {
        $streetNumberErr = "* Street number is required";
    } else {
        $streetNumber = ($_POST["streetNumber"]);
    }

    if (empty($_POST["city"]) || !preg_match("/^[a-zA-Z]+$/", $_POST["city"])) {
        $cityErr = "* City name is required";
    } else {
        $city = ($_POST["city"]);
    }

    if (empty($_POST["zipcode"]) || !preg_match('/^[1-9][0-9]{3}+$/', $_POST["zipcode"])) {
        $zipcodeErr = "* Zipcode is required";
    } else {
        $zipcode = ($_POST["zipcode"]);
    }
    if (empty($_POST["items"])){
        $itemsErr = "* select items";
    } else {
        $items = ($_POST["items"]);
    }
    





    if ($emailErr == "" && $streetErr == "" && $streetNumberErr == "" && $cityErr == "" && $zipcodeErr == "") {
        
       
        ?>

    
<div class="alert alert-success" role="alert"><?php echo "Your order will arrive at $deliveryTime";?></div>
 <?php   }

    }  

//whatIsHappening();
require 'form-view.php';?>
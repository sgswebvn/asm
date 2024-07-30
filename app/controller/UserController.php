<?php
ob_start();

if (isset($_GET["act"])) {
    $action = $_GET["act"];
} else if (isset($_POST["act"])) {
    $action = $_POST["act"];
} else {
    $action = "HomePage";
}

switch ($action) {
    case "HomePage":
        include "../../public/view/HomePage.php";
        break;
    case"Product":
        include "../../public/view/Product.php";
        break;
    case"Checkout":
        include "../../public/view/Checkout.php";
        break;
    case"Login":
        include "../../public/view/Login.php";
        break;
    case"Register":
        include "../../public/view/Register.php";
        break;
    case"Password":
        include "../../public/view/Password.php";
        break;
    case"Account":
        include "../../public/view/Account.php";
        break;
    case"Promotion":
        include "../../public/view/Promotion.php";
        break;
    case"Logout":
        session_start();
        $_SESSION['username'] = null;
        header('location: ./UserController.php?act=Product');
    case"Order":
        include "../../public/view/Order.php";
        break;
    case"AdminCategory":
        include "../view/Category.php";
        break;
    case"AdminUser":
        include "../view/User.php";
        break;
    case"AdminProduct":
        include "../view/Product.php";
        break;
    case"AdminOrder":
        include "../view/Order.php";
        break;
    }

?>
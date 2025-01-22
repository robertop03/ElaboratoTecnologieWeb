<?php
require_once("bootstrapt.php");

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

// Retrieve the cart from cookies
$cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];

// Initialize an array for the complete cart details
$completeCart = [];

// Loop through the cart items to fetch their details and validate stock
foreach ($cart as $item) {
    $productDetails = $db->getProductDetails($item['id'], $_SESSION['lingua'] ?? 1);

    if ($productDetails) {
        $stock = $db->getProductStock($item['id']);

        // If the requested quantity exceeds the stock, adjust it
        if ($item['quantity'] > $stock) {
            $item['quantity'] = $stock; // Update to the max available stock
            $message = $productDetails['title'] . " - La quantità richiesta è stata modificata a causa di una disponibilità limitata.";
            echo "<p class='text-warning'>$message</p>";
        }

        // Add the product details and updated quantity to the complete cart
        $completeCart[] = [
            'id' => $productDetails['id'],
            'title' => $productDetails['title'],
            'price' => $productDetails['price'],
            'image' => $productDetails['image'],
            'quantity' => $item['quantity'],
            'stock' => $stock
        ];
    }
}

// Pass the complete cart details to JavaScript
echo "<script>const completeCart = " . json_encode($completeCart) . ";</script>";

// Set template parameters
$templateParams["titolo"] = "Carrello";
$templateParams["nome"] = "carrello-template.php";
$templateParams["mainClasses"] = "flex-grow-1";

// Include the base template
require("template/base.php");
?>
    
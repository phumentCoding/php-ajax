<?php


header('Content-Type: application/json');

$hostname = "127.0.0.1";
$username = "root";
$password = "";
$database = "php-ajax";
$port = 3306;

$con = mysqli_connect($hostname, $username, $password, $database, $port);

if (!$con) {
    echo json_encode([
        'status' => false,
        'message' => 'Database connection failed: ' . mysqli_connect_error()
    ]);
    exit;
}


$type = $_GET['type'] ?? '';

switch($type){
    case 'list' : {
        $sql = "SELECT * FROM `products` ";
        $run = mysqli_query($con,$sql);

        //convert data to accociative array
        $products = mysqli_fetch_all($run,MYSQLI_ASSOC);

        echo json_encode([
            'status' => true,
            'products' => $products
        ]);

        break;
    }
    case 'store'  : {

        $name = $_POST['name'] ?? '';
        $price = $_POST['price'] ?? '';
        $qty = $_POST['qty'] ?? '';
        $status = $_POST['status'] ?? '';


        try {

            $sql = "INSERT INTO `products`(`name`, `price`, `qty`,`status`) VALUES ('$name','$price','$qty','$status')";

            mysqli_query($con,$sql);

            echo json_encode([
                'status' => true,
                'message' => 'Added product to store successfully'
            ]);

    
        } catch (Exception $e) {
            echo json_encode([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }

        break;
    }

}


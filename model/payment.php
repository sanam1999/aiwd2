<?php
session_start();

function payment($product_id, $quantity, $price, $discountedPrice)
{
    include 'conn.php';

    // Ensure that the user is logged in
    if (!isset($_SESSION['userid'])) {
        $_SESSION['error'] = "You must be logged in to place an order.";
        header('Location: view/product/home.php');
        exit;
    }

    $user_id = $_SESSION['userid'];
    $order_id = generateUUID();
    $status = 'Pending';
    $sql = "INSERT INTO Orders (order_id, user_id, product_id, total, price, status, quntity) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {

        mysqli_stmt_bind_param($stmt, "ssssssi", $order_id, $user_id, $product_id, $discountedPrice, $price, $status, $quantity);
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['success'] = "Your order will be delivered within 10 working days successfully.";
        } else {
            $_SESSION['error'] = "There was an error processing your order. Please try again. Error: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['error'] = "Error occurred while preparing the statement: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    header('Location: view/product/home.php');
    exit;
}
?>
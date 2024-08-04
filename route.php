<?php
require ('model/user.php');
require ('model/card.php');
require ('model/RF.php');
require ('model/orders.php');
require ('model/payment.php');
require ('model/product.php');
require ('uplodphoto.php');
require ('model/Systemfeedback.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? null;
    if ($action) {
        switch ($action) {
            case 'login':
                $email = $_POST['email'];
                $passworD = $_POST['password'];
                LogdinUser($email, $passworD);
                break;
            case 'singup':
                $password = $_POST['password'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                SignUpUser($name, $email, $password);
                break;
            case 'like':
                $product_id = $_GET['product_id'] ?? null;
                if ($product_id) {
                    like($product_id);
                }
                break;
            case 'delike':
                $like_id = $_GET['like_id'] ?? null;
                if ($like_id) {
                    delike($like_id);
                }
                break;
            case 'comment':
                $product_id = $_GET['product_id'];
                $rating = $_POST['rating'];
                $comment = $_POST['comment'];
                if (empty($rating) || empty($comment)) {
                    $_SESSION['error'] = "Rating and comment are required";
                    header('Location: show.php?product_id=' . $product_id);
                    exit;
                }
                saveReview($product_id, $rating, $comment);
                break;
            case 'deleteComment':
                echo "comment";

                break;
            case 'deleteReview':
                $Review_id = $_GET['Review_id'];
                deleteReview($Review_id);
                break;
            case 'canceloder':
                $order_id = $_GET['order_id'];
                canceloder($order_id);
                break;
            case 'buy':
                $product_id = $_POST['product_id'] ?? null;
                $quantity = $_POST['quantity'] ?? null;
                $price = $_POST['price'] ?? null;
                $discountedPrice = $_POST['discountedPrice'] ?? null;
                payment($product_id, $quantity, $price, $discountedPrice);
                break;
            case 'deletepost':

                $product_id = $_GET['product_id'] ?? null;
                if ($product_id) {
                    deletePost($product_id);
                }
                break;
            case 'editpost':
                $product_id = $_GET['product_id'];
                $category = $_POST['category'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $imageurl = $_POST['imageurl'];
                $condition = $_POST['condition'];
                $stack = $_POST['stack'];
                editPost($product_id, $category, $title, $description, $price, $imageurl, $condition, $stack);
                break;
            case 'addpost':
                $category = $_POST['category'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $stock = $_POST['stock'];
                $condition = $_POST['condition'];
                $imageURL = upload($_FILES['imageurl']);
                addProduct($category, $title, $description, $price, $stock, $condition, $imageURL);

                break;


            case 'addAddress':
                $district = $_POST['district'] ?? null;
                $zip_code = $_POST['zip_code'] ?? null;
                $phone_number = $_POST['phone_number'] ?? null;
                $address = $_POST['address'] ?? null;
                $province = $_POST['province'] ?? null;
                addAddress($district, $zip_code, $phone_number, $address, $province);
                break;
            case 'feedback':
                $comments = $_POST['comments'];
                echo $comments;
                giveFeedback($comments);
                break;
            default:
                echo "Invalid action.";
        }
    }
}

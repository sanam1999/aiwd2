<?php
require ('UUIDGenerator.php');
function fetchProductsAsObjects() {
    include('conn.php');
    $sql = "SELECT * FROM Products ORDER BY created_at DESC ";
    $result = mysqli_query($conn, $sql);

    $products = array();

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
           
            $product = new stdClass();
            $product->product_id = $row['product_id'];
            $product->user_id = $row['user_id'];
            $product->category = $row['category'];
            $product->title = $row['title'];
            $product->description = $row['description'];
            $product->price = $row['price'];
            $product->stock = $row['stock'];
            $product->condition = $row['condition'];
            $product->created_at = $row['created_at'];

            $product->imageurl = $row['imageUrl'];
            
            $products[] = $product;

        }
    }

    mysqli_free_result($result);

    return $products;
}
function fetchProductuser($uid)
{
    
    include ('conn.php');
    $sql = "SELECT * FROM Products WHERE user_id = '$uid'";
    $result = mysqli_query($conn, $sql);

    $products = array();

    if ($result && mysqli_num_rows($result) > 0) {
       // print_r($result);
        while ($row = mysqli_fetch_assoc($result)) {

            $product = new stdClass();
            $product->product_id = $row['product_id'];
            $product->user_id = $row['user_id'];
            $product->category = $row['category'];
            $product->title = $row['title'];
            $product->description = $row['description'];
            $product->price = $row['price'];
            $product->stock = $row['stock'];
            $product->condition = $row['condition'];
            $product->created_at = $row['created_at'];

            $product->imageurl = $row['imageUrl'];

            $products[] = $product;

        }
    }

    mysqli_free_result($result);

    return $products;
}

function fetchSingleProduct($id) {
    include('conn.php');

    $id = mysqli_real_escape_string($conn, $id);
    $sql = "SELECT * FROM Products WHERE product_id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        $product = new stdClass();
        $product->product_id = $row['product_id'];
        $product->user_id = $row['user_id'];
        $product->category = $row['category'];
        $product->title = $row['title'];
        $product->description = $row['description'];
        $product->price = $row['price'];
        $product->stock = $row['stock'];
        $product->condition = $row['condition'];
        $product->created_at = $row['created_at'];
        $product->imageurl = $row['imageUrl'];
        

        mysqli_free_result($result);
        return $product;
    }

    mysqli_free_result($result);
    return null;
}

function fetchRelatedProducts($category, $type) {

    include('conn.php');
    $category = mysqli_real_escape_string($conn, $category);
    $sql = "SELECT * FROM Products WHERE $type = '$category'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $RProducts = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $product = new stdClass();
            $product->product_id = $row['product_id'];
            $product->user_id = $row['user_id'];
            $product->category = $row['category'];
            $product->title = $row['title'];
            $product->description = $row['description'];
            $product->price = $row['price'];
            $product->stock = $row['stock'];
            $product->condition = $row['condition'];
            $product->created_at = $row['created_at'];

            $product->imageurl = $row['imageUrl'];
            $RProducts[] = $product;
        }

        mysqli_free_result($result);
        return $RProducts;
    } else {
        return;
    }
}

function addProduct($category, $title, $description, $price, $stock, $condition, $imageURL)
{
    include('conn.php');
    $product_id = generateUUID();
    $user_id = $_SESSION['userid'];

    try {
        if (!isset($imageURL) || $imageURL == null) {
            $sql = "INSERT INTO Products (product_id, user_id, category, title, description, price, stock, `condition`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssssdis", $product_id, $user_id, $category, $title, $description, $price, $stock, $condition);
        } else {
            $sql = "INSERT INTO Products (product_id, user_id, category, title, description, price, stock, `condition`, imageUrl) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssssdiss", $product_id, $user_id, $category, $title, $description, $price, $stock, $condition, $imageURL);
        }

        if ($stmt) {
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['success'] = "Product added successfully.";
                header('Location: ../product/home.php');
                exit();  
            } else {
                $_SESSION['error'] = "Error occurred during execution: " . mysqli_error($conn);
                  header('Location: ../product/addProduct.php');
            }
            
            mysqli_stmt_close($stmt);
        } else {
            $_SESSION['error'] = "Error occurred while preparing the statement: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
    }

    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_GET['product_id'] ?? null;
    $action = $_POST['action'] ?? null;

    if ($product_id && $action) {
        switch ($action) {
            case 'delete':
                deleteOrder($product_id);
                break;
            case 'edit':
                editOrder($product_id, $name);
                break;
            default:
                echo "Invalid action.";
        }
    } else {
        echo "Missing order ID or action.";
    }
}
function deleteOrder($product_id){
    include ('conn.php');
    $sql = "DELETE FROM Products WHERE product_id = '$product_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Product with ID $product_id has been deleted successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
}


function editOrder($product_id, $name) {
 
    echo $name;
   
}

?>

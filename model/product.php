<?php

function fetchProductsAsObjects()
{
    include ('conn.php');
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
            $product->condition = $row['conditio'];
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
            $product->condition = $row['conditio'];
            $product->created_at = $row['created_at'];

            $product->imageurl = $row['imageUrl'];

            $products[] = $product;

        }
    }

    mysqli_free_result($result);

    return $products;
}

function fetchSingleProduct($id)
{
    include ('conn.php');
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
        $product->condition = $row['conditio'];
        $product->created_at = $row['created_at'];
        $product->imageurl = $row['imageUrl'];


        mysqli_free_result($result);
        return $product;
    }

    mysqli_free_result($result);
    return null;
}

function fetchRelatedProducts($category)
{

    include ('conn.php');
    $category = mysqli_real_escape_string($conn, $category);
    $sql = "SELECT * FROM Products WHERE category = '$category'";
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
            $product->condition = $row['conditio'];
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

function fetchlikes($product_id)
{



    if (isset($_SESSION['userid'])) {
        $user_id = $_SESSION['userid'];
    } else {
        $liked = new stdClass();
        $liked->status = "not";
        return $liked;

    }
    include ('conn.php');
    $sql = "SELECT like_id , status FROM liked WHERE product_id = '$product_id'and user_id= '$user_id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $liked = new stdClass();
        $liked->like_id = $row['like_id'];
        $liked->status = $row['status'];
        mysqli_free_result($result);
        return $liked;
    }


    $liked = new stdClass();

    $liked->status = "not";
    return $liked;

}
function addProduct($category, $title, $description, $price, $stock, $condition, $imageURL)
{

    include ('conn.php');
    $product_id = generateUUID();
    $user_id = $_SESSION['userid'];

    try {

        $sql = "INSERT INTO Products (product_id, user_id, category, title, price,stock,description,imageUrl,conditio) VALUES (?, ?, ?, ?, ?,?,?,?,?)";
            $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssiisss", $product_id, $user_id, $category, $title, $price, $stock, $description, $imageURL, $condition);

        if ($stmt) {
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['success'] = "Product added successfully.";
                header('Location: view/product/profile.php');
                exit();
            } else {
                $_SESSION['error'] = "Error occurred during execution: " . mysqli_error($conn);
                header('Location: view/product/AddProfile.php');
                exit();
            }

           
        } else {
            $_SESSION['error'] = "Error occurred while preparing the statement: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
    }
    header('Location: view/product/AddProfile.php');
    exit;
    
}
function fetchSearchProducts($searchItem)
{
    include ('conn.php');
    $searchItem = mysqli_real_escape_string($conn, $searchItem);
    $sql = "SELECT * FROM Products WHERE title LIKE '%$searchItem%' OR description LIKE '%$searchItem%' OR category LIKE '%$searchItem%'";
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
            $product->condition = $row['conditio'];
            $product->created_at = $row['created_at'];
            $product->imageurl = $row['imageUrl'];
            $RProducts[] = $product;
        }

        mysqli_free_result($result);
        return $RProducts;
    } else {
        return array();
    }
}

function deletePost($product_id)
{
    session_start();
    include ('conn.php');
    echo "dfsdaf";
    if (isset($_SESSION['userid'])) {
        $sql = "DELETE FROM Products WHERE product_id='$product_id'";
        $conn->query($sql);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        echo "dfsdaf no";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
    exit;
}

function editPost($product_id, $category, $title, $description, $price, $imageurl, $condition, $stack)
{
    session_start();
    include ('conn.php');
    $sql = "UPDATE Products SET category = ?, title = ?, description = ?, price = ?, imageUrl = ?, `conditio` = ?, stock = ? WHERE product_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('ssssssis', $category, $title, $description, $price, $imageurl, $condition, $stack, $product_id);
        if ($stmt->execute()) {
            $_SESSION['success'] = "Post edit successuful";
        } else {
            $_SESSION['error'] = "Error executing statement: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = "Error preparing statement: " . $conn->error;
    }
    $conn->close();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}



?>
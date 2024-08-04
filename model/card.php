<?php

function fetchcardAsObjects()
{
    include ('conn.php');
    $user_id = $_SESSION['userid'];
    $sql = "SELECT * FROM liked where user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);
    $cards = array();
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $card = new stdClass();
            $card->product_id = $row['product_id'];
            $card->user_id = $row['user_id'];
            $card->like_id = $row['like_id'];
            $card->status = $row['status'];
            $cards[] = $card;
        }
    }
    mysqli_free_result($result);
    return $cards;
}
function like($product_id)
{
    session_start();
    include ('conn.php');

    if (isset($_SESSION['userid'])) {
        $user_id = $_SESSION['userid'];
    } else {
        $_SESSION['error'] = "You are not logged in.";
        header('Location: ../view/product/login.php');
        exit();
    }

    $like_id = generateUUID();
    $status = "liked";
    try {
        $sql = "INSERT INTO liked (like_id, product_id, user_id, status) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $like_id, $product_id, $user_id, $status);
        mysqli_stmt_execute($stmt);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
    }
    exit;
}

function delike($like_id)
{
    session_start();
    include ('conn.php');
    echo "dfsdaf";
    if (isset($_SESSION['userid'])) {
        $sql = "DELETE FROM liked WHERE like_id='$like_id'";
        $conn->query($sql);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        echo "dfsdaf no";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
    exit;

}
?>
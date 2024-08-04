<?php
session_start();

function giveFeedback($comments)
{


    if (isset($_SESSION['userid'])) {
        $user_id = $_SESSION['userid'];
    } else {
        $_SESSION['error'] = "You are not logged in.";
        header('Location: ../view/product/login.php');
        exit();
    }

    include ('conn.php');

    $feedback_id = generateUUID();

    $sql = "INSERT INTO SystemFeedback (feedback_id, user_id, comment) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $feedback_id, $user_id, $comments);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Thank you for giving feedback";
    } else {
        $_SESSION['error'] = "Error occurred during execution: " . mysqli_stmt_error($stmt);
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();

}
?>
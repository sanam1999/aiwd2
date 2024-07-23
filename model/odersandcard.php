<?php

function fetchOdersAsObjects()
{
    $user_id = $_SESSION['userid'];
    include ('conn.php');
    $sql = "SELECT * FROM Orders where user_id = '$user_id'  ORDER BY oder_date DESC ";
    $result = mysqli_query($conn, $sql);

    $ordes = array();

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $orde = new stdClass();
            $orde->order_id = $row['order_id'];
            $orde->product_id = $row['product_id'];
            $orde->total = $row['total'];
            $orde->price = $row['price'];
            $orde->status = $row['status'];
            $orde->oder_date = $row['oder_date'];
            $orde->quntity = $row['quntity'];
            $ordes[] = $orde;

        }
    }

    mysqli_free_result($result);

    return $ordes;
}

function addAddress($district, $zip_code, $phone_number, $address, $province)
{
    include ('conn.php');
    $address_id = generateUUID();
    $user_id = $_SESSION['userid'];

  $sql = "INSERT INTO Address (address_id,user_id,district, zip_code, phone_number, address, province) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssiiss",$address_id,$user_id, $district, $zip_code, $phone_number, $address, $province);
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['success'] = "Address added successfully.";
                header('Location: ../product/profile.php');
                exit();
            } else {
                $_SESSION['error'] = "Error occurred during execution: " . mysqli_error($conn);
                header('Location: ../product/profile.php');
            }
        mysqli_close($conn);
    

    return;
}
function fetchAddress()
{
    $user_id = $_SESSION['userid'];
    include ('conn.php');

    $sql = "SELECT district, zip_code, phone_number, address, province FROM Address WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);

    $address = null;
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $address = new stdClass();
        $address->district = $row['district'];
        $address->zip_code = $row['zip_code'];
        $address->phone_number = $row['phone_number'];
        $address->address = $row['address'];
        $address->province = $row['province'];
    }
    return $address;
}



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['order_id'])) {

    $order_id = $_GET['order_id'];
    include ('conn.php');
    $sql = "UPDATE Orders SET status = 'Cancelled' WHERE order_id='$order_id'";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = "your order was canced";
    } else {
        $_SESSION['error'] = "Welcome ";
    }
    header('Location: ../view/product/oders.php');
}


?>
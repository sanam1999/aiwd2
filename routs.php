<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_GET['product_id'] ?? null;
    $action = $_POST['action'] ?? null;

    if ($product_id && $action) {
        switch ($action) {
            case 'delete':
                $time = $_POST['time'] ?? null;
                deleteOrder($product_id, $time);
                break;
            case 'edit':
                $username = $_POST['username'] ?? null;
                $password = $_POST['password'] ?? null;
                editOrder($product_id, $username, $password);
                break;
            default:
                echo "Invalid action.";
        }
    } else {
        echo "Missing order ID or action.";
    }
}

function editOrder($product_id, $username, $password){

}
function deleteOrder($product_id, $time){

}
?>



<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_GET['product_id'] ?? null;
    $action = $_POST['action'] ?? null;

    if ($product_id && $action) {
        switch ($action) {
            case 'delete':
                
                deleteOrder($product_id, $time);
                break;
            case 'edit':
               
                editOrder($product_id);
                break;
            default:
                echo "Invalid action.";
        }
    } else {
        echo "Missing order ID or action.";
    }
}

function editOrder($product_id)
{
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

}
function deleteOrder($product_id){
$time = $_POST['time'] ?? null;


}
?>
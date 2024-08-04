<?php
include ('../isAuthenticate.php');
require ('function.php');
include ('../include/header.php');
require ('../../model/orders.php');
require ('../../model/product.php');
$orders = fetchOdersAsObjects();
?>
<style>
    .f {
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
    }

    .odercard {
        display: flex;
        border: 1px solid #ccc;
        border-radius: 8px;
        width: 50rem;
        padding: 16px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .odercard img {
        width: 150px;
        height: 150px;
        border-radius: 8px;
        margin-right: 16px;
    }

    .odercard .status {
        display: flex;
        justify-content: space-between;
        flex-direction: column;

        left: 19rem;

        width: 100%;
    }

    .odercard .status p {
        color: #ba6f58;
        text-align: end;
    }

    .odercard-content {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .odercard-content h3 {
        margin: 0;
    }

    .odercard-content p {
        margin: 8px 0;
    }

    .odercard-content button {
        padding: 8px 10px;
        border: none;
        border-radius: 4px;
        background-color: #007BFF;
        color: white;
        cursor: pointer;
        width: 10rem;
    }
</style>
<div class="f">
    <?php if ($orders): ?>
        <?php foreach ($orders as $order):

            $product = fetchSingleProduct($order->product_id);
            ?>

            <div class="odercard margintop-0-5">
                <img src="../../<?= $product->imageurl ?>" alt="Card Image">
                <div class="odercard-content">
                    <span>
                        <h3 class="titale"> <?php echo $product->title ?></h3>
                        <p><?php echo htmlspecialchars($product->description); ?></p>
                    </span>
                    <?php if ($order->status == "Pending"): ?>
                        <form action="../../route.php?order_id=<?= urlencode($order->order_id) ?>" method="post">
                            <input type="hidden" name="action" value="canceloder">
                            <button type="submit" class="cancelbtn">Cancel</button>
                        </form>
                    <?php elseif ($order->status == "Cancelled" || $order->status == "Delivered"): ?>
                        <button class="btn">
                            <a class="a" href="show.php?product_id=<?= $product->product_id; ?>">buy again</a>
                        </button>
                    <?php else: ?>
                        <p>processing</p>
                    <?php endif; ?>




                </div>

                <div class="status">
                    <p class="pending"><?php echo $order->status ?></p>
                    <p><?php echo timeDifference($order->oder_date); ?> ago</p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<?php
include ('../include/footer.php');
?>
<?php

?>
<script>
    const cancelBtns = document.querySelectorAll('.cancelbtn');
    cancelBtns.forEach(button => {
        button.addEventListener("click", () => {


        });
    });
</script>
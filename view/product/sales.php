<?php
include ('../isAuthenticate.php');
require ('function.php');
require ('../../model/orders.php');
require ('../../model/product.php');
include ('../include/header.php');
$orders = fetchMyAllsales();
?>
<style>
    .f {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
        flex-direction: row;
        gap: 4rem;
    }


    .cards {
        width: 300px;
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border: 1px solid black;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;

    }



    /* Anchor Tag Styling */
    .cards a {
        text-decoration: none;
        /* Removes underline from the link */
        color: inherit;
        /* Inherit the text color */
        display: block;
        /* Allows the entire card to be clickable */
    }

    /* Inner Action Div */
    .action {
        padding: 20px;
        /* Padding inside the card */
        text-align: center;
        /* Center align the text */
    }

    /* Title (h2) Styling */
    .odert {
        font-size: 1.5rem;
        /* Font size for the title */
        color: #333;
        /* Darker grey color */
        margin: 0;
        /* No margin */
        font-weight: 600;
        display: flex;

        justify-content: center;
        flex-direction: row;
        /* Bold text */
    }

    /* Superscript (for number) Styling */
    .salesmsf {
        font-size: 1.2rem;
        /* Size of the number */
        color: #ff5722;
        /* Orange color for contrast */
        font-weight: 700;
        /* Bold number */
        margin-left: 2px;
        /* Space between title and number */
    }

    /* Media Queries for Responsiveness */
    @media (max-width: 768px) {
        .cards {
            width: 80%;
            /* Card takes more space on smaller screens */
            margin-bottom: 20px;
            /* Adds space below card */
        }
    }

    @media (max-width: 480px) {
        .odert {
            font-size: 1.2rem;
            /* Smaller title font on very small screens */
        }

        .salesmsf {
            font-size: 1rem;
            /* Smaller number font on very small screens */
        }
    }

    .productoders {
        display: flex;
        text-align: center;
        flex-direction: column;
        justify-content: center;
    }

    .odercard {
        margin-left: 25%;
    }
</style>

<?php
$totaloder = 0;
$totalsales = 0;
$totalprice = 0;

if ($orders) {
    foreach ($orders as $order) {
        $totaloder += $order['pending_orders_count'];
        $totalprice += $order['total_sales'];
        $totalsales += $order['total_quantity'];
    }
}
?>

<div class="f margint-1">
    <div class="cards">
        <a href="getOrders.php">
            <div class="action">
                <h2 class="odert"> Placed Orders
                    <?php if ($totaloder > 0) {
                        echo '<sup class="salesmsf">' . $totaloder . '</sup>';
                    }
                    ?>
                </h2>
            </div>
        </a>
    </div>
    <div class="cards">

        <div class="action">
            <h2 class="odert"> Total Sales <?php echo '<sup class="salesmsf">' . $totalsales . '</sup>'; ?>

            </h2>
        </div>

    </div>
    <div class="cards">

        <div class="action">
            <h2 class="odert"> Rs:<?php echo $totalprice; ?></h2>
        </div>

    </div>
</div>
<section>

    <div style="margin-top: 2rem;" class="productoders">

        <?php

        if ($orders): ?>
            <?php foreach ($orders as $order):
                ?>

                <div class="odercard margintop-0-5">
                    <img src="../../<?= $order['imageUrl'] ?>" alt="Card Image">
                    <div class="odercard-content">
                        <span>
                            <h3 class="titale"> <?php echo $order['title'] ?></h3>
                            <p><?php echo $order['description'] ?></p>
                            <p>Rs:<?php echo $order['total_sales'] ?></p>

                        </span>
                    </div>

                    <div class="status">
                        <p class="pending"><?php echo $order['total_quantity'] ?>x</p>
                        <p><?php echo timeDifference($order['created_at']); ?> ago</p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<?php
include ('../include/footer.php');
?>
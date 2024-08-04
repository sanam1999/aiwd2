<?php

if (!isset($_GET['product_id']) || !isset($_GET['quantity'])) {
    header('Location: home.php');
    exit;
}

$product_id = $_GET['product_id'];
$quantity = $_GET['quantity'];

require ('../../model/product.php');
require ('../../model/orders.php');
include ('../include/header.php');

$product = fetchSingleProduct($product_id);
$price = (int) $product->price;
$total = $quantity * $price;
$deliveryCharge = 150;
$discountedPrice = ($total * 0.95) + $deliveryCharge;
$total += $deliveryCharge;
?>

<style>
    .line-through {
        text-decoration: line-through;
    }

    .payment,
    .otp,
    .f {
        margin: 20px;
    }

    .paymentnext,
    .getpay {
        margin-top: 10px;
    }

    .info-icon {
        cursor: pointer;
    }

    .cancel-btn {
        cursor: pointer;
        color: red;
        float: right;
    }
</style>

<div class="payment" style="display: none;">
    <div class="invoice-form">
        <h2>Invoice <span class="cancel-btn" id="cancel-invoice">X</span></h2>
        <div class="form-group">
            <label for="card-number">Card number</label>
            <input type="text" required id="card-number" placeholder="1234 5678 9012 3456">
        </div>
        <div class="form-group">
            <label for="card-name">Name on card</label>
            <input type="text" required id="card-name" placeholder="Ex. John Doe">
        </div>
        <div class="form-group">
            <label for="expiry-date">Expiry date</label>
            <input type="text" required id="expiry-date" placeholder="01 / 19">
        </div>
        <div class="form-group">
            <label for="security-code">Security code</label>
            <input type="text" required id="security-code" placeholder="•••">
            <span class="info-icon">?</span>
        </div>
        <button class="book paymentnext">Next</button>
    </div>
</div>

<div class="otp" style="display: none;">
    <div class="invoice-form">
        <h2>Nearby Home <span class="cancel-btn" id="cancel-otp">X</span></h2>
        <p>Enter OTP</p>
        <div class="form-group">
            <label for="otp-code">One Time Password</label>
            <input type="text" required id="otp-code" name="otp" placeholder="* * * *">
            <p class="errorotp danger"></p>
        </div>
        <form id="paymentForm" action="../../route.php" method="POST">
            <input type="hidden" name="action" value="buy">
            <input type="hidden" name="product_id" value="<?= htmlspecialchars($product_id); ?>">
            <input type="hidden" name="quantity" value="<?= htmlspecialchars($quantity); ?>">
            <input type="hidden" name="price" value="<?= htmlspecialchars($price); ?>">
            <input type="hidden" name="discountedPrice" value="<?= htmlspecialchars($discountedPrice); ?>">
            <button type="submit" id="buyNowLink">Buy Now</button>
        </form>
        </div>
        </div>

<div class="f">
    <div class="paymentProsess">
        <?php
        $Address = fetchAddress();
        if ($Address) {
            echo '<p>' . $Address->address . '</p>';
        } else {
            echo '<a href="profile.php" >+ Add Address</a>';
        }
        ?>
        
        <p><span>Quantity</span> <span><?= htmlspecialchars($quantity); ?></span></p>
        <p><span>Price</span> <span>Rs <?= htmlspecialchars($product->price); ?></span></p>
        <p><span>Delivery charge</span> <span>Rs <?= $deliveryCharge; ?></span></p>
        <p><span>Total</span> <span class="line-through">Rs <?= htmlspecialchars($total); ?></span> &nbsp;&nbsp;Rs
            <?= htmlspecialchars($discountedPrice); ?></span>
        </p>
        <br>
        <?php
        if ($Address) {
            echo '<button class="book getpay">Confirm</button>';
        } else {
            echo '<a href="profile.php" class="address deanger btn">+ Add Address</a>';
        }
        ?>
        
        </div>
        </div>

<?php include ('../include/footer.php'); ?>

<script>
    let systemOtp;

    document.querySelector('.getpay').addEventListener('click', () => {
        document.querySelector('.payment').style.display = 'block';
    });

    document.querySelector('.paymentnext').addEventListener('click', () => {
        systemOtp = Math.floor(1000 + Math.random() * 9000).toString();
        alert("Don't share this one-time password with anyone. It's for your security. If you didn't request it, contact support immediately. Your OTP is:- " + systemOtp);
        document.querySelector('.payment').style.display = 'none';
        document.querySelector('.otp').style.display = 'block';
    });

    document.querySelector('#cancel-invoice').addEventListener('click', () => {
        document.querySelector('.payment').style.display = 'none';
    });

    document.querySelector('#cancel-otp').addEventListener('click', () => {
        document.querySelector('.otp').style.display = 'none';
    });

    document.querySelector('#paymentForm').addEventListener('submit', function (event) {
        const userOtp = document.querySelector('#otp-code').value;
        if (userOtp !== systemOtp) {
            document.querySelector('#otp-code').style.borderColor = 'red';
            document.querySelector('.errorotp').innerText = "Invalid OTP";
            event.preventDefault();
        }
    });
</script>
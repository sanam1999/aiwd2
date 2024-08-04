<?php

require ('../../model/product.php');
require ('../../model/RF.php');

if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $product = fetchSingleProduct($product_id);

    if ($product) {
        include ('../include/header.php');
        ?>

        <style>
            .line-through {
                text-decoration: line-through;
            }

            .order {
                display: flex;
                width: 40rem;
                justify-content: space-evenly;
                align-items: center;
                height: 3rem;
                border-radius: 10px;
                border: solid black 1px;
            }

            .order a {
                border: solid black 1px;
                padding: 0.5rem 1rem;
                border-radius: 10px;
                cursor: pointer;
                background-color: black;
                color: white;
            }

            .addcard,
            .buynow,
            .qnt {
                background-color: black;
                color: white;
            }

            .qnt {
                width: 80px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
        </style>

        <div class="card-deck">
            <div class="user">
                <form action="profile.php" method="get">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($product->user_id); ?>">
                    <button type="submit">Profile</button>
                </form>
            </div>

            <?php
            $newPrice = (int) $product->price;
            $discountedPrice = $newPrice - ($newPrice * 0.05);
            ?>
            <div class="card offset-3" style="width: 70rem;">
                <img class="card-img-top" src="../../<?php echo htmlspecialchars($product->imageurl); ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($product->title); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($product->description); ?></p>
                    <p class="card-text"><?php echo htmlspecialchars($product->stock); ?></p>
                    <p class="card-text"><?php echo htmlspecialchars($product->condition); ?></p>
                    <p class="card-text"><?php echo htmlspecialchars($product->created_at); ?></p>
                    <p>
                        <span style="font-size:2rem;">&#8360; </span>
                        <span class="line-through"><?php echo htmlspecialchars($product->price); ?></span>
                    </p>
                    <p>
                        <span style="font-size:2rem;">&#8360; </span><?php echo $discountedPrice; ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="order">
            <div class="addcard">Add to Cart</div>
            <a id="buyNowLink" href="book.php?product_id=<?php echo htmlspecialchars($product_id); ?>&quantity=1">Buy Now</a>
                <div class="qnt">
                    <button class="m">-</button>
                    <p class="countdisplay">1</p>
                    <button class="p">+</button>
                </div>
        </div>

        <div class="col-4 offset-3">
            <form action="../../route.php?product_id=<?php echo htmlspecialchars($product->product_id); ?>" novalidate
                class="needs-validation" method="post">
                <div class="mt-5">
                    <input type="hidden" name="action" value="comment">
                    <fieldset class="starability-slot">
                        <legend>First rating:</legend>
                        <input type="radio" id="no-rate" class="input-no-rate" name="rating" value="1" checked
                            aria-label="No rating." />
                        <input type="radio" id="second-rate1" class="input-no-rate" name="rating" value="1" />
                        <label for="second-rate1" title="Terrible">1 star</label>
                        <input type="radio" id="second-rate2" name="rating" value="2" />
                        <label for="second-rate2" title="Not good">2 stars</label>
                        <input type="radio" id="second-rate3" name="rating" value="3" />
                        <label for="second-rate3" title="Average">3 stars</label>
                        <input type="radio" id="second-rate4" name="rating" value="4" />
                        <label for="second-rate4" title="Very good">4 stars</label>
                        <input type="radio" id="second-rate5" name="rating" value="5" />
                        <label for="second-rate5" title="Amazing">5 stars</label>
                    </fieldset>
                </div>
                <div class="mt-3">
                    <label for="review" class="form-label">Comments</label>
                    <textarea name="comment" class="form-control" id="comment" cols="30" rows="5"></textarea>
                    <div class="invalid-feedback">Please add some comments for review</div>
                </div>
                <br>
                <button class="btn btn-outline-dark mb-3">Submit</button>
            </form>
        </div>

        <?php
        $pid = $product->product_id;
        $Reviews = GetReview($pid);
        $curuserid = $_SESSION['userid'];

        if ($Reviews): ?>
            <div class="card offset-3 col-6">
                <h1 class="card-header" style="text-align: center;">Reviews</h1>
                <div class="p-2">
                    <?php foreach ($Reviews as $Review): ?>
                        <div class="card-body card mt-3">
                            <h4 class="card-title">@<?php echo htmlspecialchars($Review->uname); ?></h4>
                            <p class="starability-result" data-rating="<?php echo htmlspecialchars($Review->rating); ?>"></p>
                            <p class="card-text"><?php echo htmlspecialchars($Review->comment); ?></p>
                            <?php if ($curuserid == $Review->user_id): ?>


                                <form action="../../route.php?Review_id=<?php echo $Review->review_id ?>" method="POST">
                                    <input type="hidden" name="action" value="deleteReview">
                                    <button type="submit" class="btn">
                                        Delete
                                    </button>
                                </form>
                                <?php endif; ?>
                                </div>
                                <?php endforeach; ?>
                                </div>
                                </div>
                                <?php endif; ?>

        <h1 class="card-header" style="text-align: center;">Related Items</h1>
        <section class="course-2">
            <?php
            $RProducts = fetchRelatedProducts($product->category);
            if ($RProducts): ?>
                <?php foreach ($RProducts as $RProduct): ?>
                    <?php
                    if ($product->product_id === $RProduct->product_id) {
                        continue;
                    }
                    $newPrice = (int) $RProduct->price;
                    $discountedPrice = $newPrice - ($newPrice * 0.05);
                    ?>
                    <div class="card" style="width: 25rem;">
                        <a class="a" href="show.php?product_id=<?php echo htmlspecialchars($RProduct->product_id); ?>">
                            <img class="card-img-top" src="../../<?php echo htmlspecialchars($RProduct->imageurl); ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($RProduct->title); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($RProduct->description); ?></p>
                                <p>
                                    <span style="font-size:2rem;">&#8360; </span>
                                    <span style="text-decoration: line-through;"><?php echo htmlspecialchars($RProduct->price); ?></span>
                                </p>
                                <p>
                                    <span style="font-size:2rem;">&#8360; </span><?php echo $discountedPrice; ?>
                                </p>
                                </div>
                                </a>
                    </div>
                <?php endforeach; ?>
                <?php else: ?>
                <h3>Items Not Available</h3>
                <?php endif; ?>
                </section>

        <script>
            let p = document.querySelector('.p');
            let m = document.querySelector('.m');
            let countdisplay = document.querySelector('.countdisplay');
            let buyNowLink = document.getElementById('buyNowLink');

            let count = 1;

            function updateDisplay() {
                countdisplay.innerText = count;
                buyNowLink.href = `book.php?product_id=<?php echo htmlspecialchars($product_id); ?>&quantity=${count}`;
            }

            p.addEventListener('click', () => {
                if (count < 10) {
                    count++;
                    updateDisplay();
                }
            });

            m.addEventListener('click', () => {
                if (count > 1) {
                    count--;
                    updateDisplay();
                }
            });

            updateDisplay();
        </script>

        <?php
        include ('../include/footer.php');
    } else {
        $_SESSION['error'] = "Product not found";
        header('Location: home.php');
        exit;
    }
} else {
    $_SESSION['error'] = "Select an item";
    header('Location: home.php');
    exit;
}
?>
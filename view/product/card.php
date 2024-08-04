<?php
include ('../isAuthenticate.php');
include ('../include/header.php');
require ('../../model/card.php');
require ('../../model/product.php');

$cards = fetchcardAsObjects();
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
        width: 41rem;
        padding: 16px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 1rem;
    }

    .odercard img {
        width: 150px;
        height: 150px;
        border-radius: 8px;
        margin-right: 16px;
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

    .like {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
        font-size: 1.8rem;
    }

    .likebox {
        position: relative;
        top: -8rem;
        left: 100px;
        align-self: flex-end;
    }

    .liked {
        color: red;
    }
</style>

<!-- HTML Content -->
<div class="f">
    <?php if ($cards): ?>
        <?php foreach ($cards as $card): ?>
            <?php $product = fetchSingleProduct($card->product_id); ?>
            <div class="odercard margintop-0-5">
                <img src="../../<?php echo $product->imageurl ?>">
                <div class="odercard-content">
                    <span>
                        <h3 class="titale"><?php echo htmlspecialchars($product->title); ?></h3>
                        <p><?php echo htmlspecialchars($product->description); ?></p>
                    </span>
                    <a class="a" href="show.php?product_id=<?= $product->product_id ?>">
                        <button type="submit" class="cancelbtn">Buy now</button>
                    </a>
                </div>
                <span class="likebox status">
                    <form action="../../route.php?like_id=<?= $card->like_id; ?>" method="post">
                        <input type="hidden" name="action" value="delike">
                        <button type="submit" class="like">
                            <i class="liked fa-solid fa-heart"></i>
                        </button>
                    </form>
                </span>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No cards found.</p>
    <?php endif; ?>
</div>

<?php
include ('../include/footer.php');
?>
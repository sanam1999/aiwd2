<?php
session_start();
require ('../../model/product.php');

if (isset($_GET['searchitem'])) {
    $searchItem = $_GET['searchitem'];
    $products = fetchsearchProducts($searchItem);
} else if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $products = fetchRelatedProducts($category);
} else {
    $products = fetchProductsAsObjects();
}
include ('../include/header.php');
?>
<style>
    .like {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
        font-size: 1.8rem;
    }

    .likebox {
        position: relative;
        top: -13rem;
        left: 5rem;
    }

    .liked {
        color: red;
    }
    .homeimage{
        width: 100%;
        background-color: black;
        display: flex;
        align-items: center;
        justify-content: center;
       
    }
</style>
<section class="home">
  
    
    <div class="homeimage">
     <img src="../../image/staticImg/image.png" alt="img">
    </div>
    <br>
</section>
<?php if ($products): ?>
    <div class="product-grid">
        <?php foreach ($products as $product):
            $newPrice = (int) $product->price;
            $discountedPrice = $newPrice - ($newPrice * 0.05);
            ?>
            <a class="a" href="show.php?product_id=<?= $product->product_id ?>">
                <div class="product-item">
                    <img src="../../<?= $product->imageurl ?>" alt="<?= $product->description ?>">

                    <?php $liked = fetchlikes($product->product_id);

                    if ($liked->status == "liked"):
                        ?>
                                <span class="likebox">
                                    <form action="../../route.php?like_id=<?php echo $liked->like_id ?>" method="POST">
                                        <input type="hidden" name="action" value="delike">
                                        <button type="submit" class="like">
                                            <i class="liked fa-solid fa-heart"></i>
                                        </button>
                                    </form>
                                </span>
                    <?php elseif ($liked->status == "not"): ?>
                                <span class="likebox">
                                    <form action="../../route.php?product_id=<?php echo $product->product_id ?>" method="post">
                                        <input type="hidden" name="action" value="like">
                                        <button type="submit" class="like">
                                            <i class="fa-regular fa-heart"></i>
                                        </button>
                                    </form>
                                </span>
                    <?php endif; ?>


                    <h3><?= htmlspecialchars($product->title, ENT_QUOTES, 'UTF-8') ?></h3>
                    <p>Rs <?= number_format($product->price, 2) ?></p>
                    <p>Rs <?= number_format($discountedPrice, 2) ?></p>
                    </div>
            </a>
        <?php endforeach; ?>
            </div>
            <?php endif;


include ('../include/footer.php');
?>
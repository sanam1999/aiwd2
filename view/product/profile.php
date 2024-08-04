<?php
require ('../../model/product.php');
require ('../../model/orders.php');
require ('function.php');
session_start();
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
} else {
    include ('../isAuthenticate.php');
    $user_id = $_SESSION['userid'];
}

include ('../include/header.php');
$Products = fetchProductuser($user_id);
?>
<style>
    .flex {
        display: flex;
        gap: 5px;
    }

    .editbox {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 40%;
        display: none;
        margin-top: 4rem;
        z-index: 1000;
    }

    .danger {
        display: inline-block;
        font-weight: 400;
        color: #fff;
        text-align: center;
        vertical-align: middle;
        user-select: none;
        background-color: red;
        border: 1px solid #007bff;
        padding: 0.375rem 0.45rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .invoice-form {
        background: red;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: 600px;
    }

    .invoice-form h3 {
        text-align: end;
        display: block;
    }
    .adressform{
        display: none;
    }
</style>

<div class="f margintop-0-5">
    <div class="profileEdit">
        <div class="profile">
            <i class="fa-solid fa-user"></i>
            <div class="post">
                <span><?php echo count($Products); ?> posts</span>
                <span>5 stars</span>
            </div>
        </div>
        <br>
        <hr>
        <?php if (isset($_SESSION['userid']) && ($_SESSION['userid'] == $user_id)): ?>
            <div class="userdata margintop-1">
                <div class="form-row">
                    <div class="form-group">
                        <label for="inputName">Name</label>
                        <p><?php echo $_SESSION['user']; ?></p>
                        </div>
                        <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <p><?php echo $_SESSION['email']; ?></p>
                        </div>
                        </div>
                <?php $Address = fetchAddress(); ?>
                <br>
                <h3 class="close">Address</h3>
            <?php if ($Address && !empty($Address)): ?>

                <div class="form-row">
                    <div class="form-group">
                            <label for="inputProvince">Province</label>
                            <p><?php echo $Address->province; ?></p>
                            </div>
                            <div class="form-group">
                            <label for="inputDistrict">District</label>
                            <p><?php echo $Address->district; ?></p>
                            </div>
                            <div class="form-group">
                            <label for="inputZipCode">Zip Code</label>
                            <p><?php echo $Address->zip_code; ?></p>
                            </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                            <label for="inputPhoneNumber">Phone number</label>
                            <p><?php echo $Address->phone_number; ?></p>
                            </div>
                            <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <p><?php echo $Address->address; ?></p>
                            </div>
                            </div>
                <?php else: ?>
                    <form class="adressform" action="../../route.php" method="post">
                        <input type="hidden" name="action" value="addAddress">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="inputProvince">Province</label>
                                <input type="text" class="form-control" id="inputProvince" name="province" required>
                            </div>
                            <div class="form-group">
                                <label for="inputDistrict">District</label>
                                <input type="text" class="form-control" id="inputDistrict" name="district" required>
                            </div>
                            <div class="form-group">
                                <label for="inputZipCode">Zip Code</label>
                                <input type="text" class="form-control" id="inputZipCode" name="zip_code" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="inputPhoneNumber">Phone number</label>
                                <input type="text" class="form-control" id="inputPhoneNumber" name="phone_number" required>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Address</label>
                                <input type="text" class="form-control" id="inputAddress" name="address" required>
                            </div>
                        </div>
                        <button type="submit" class="btn submitAddersss btn-primary">Submit</button>
                    </form>
                    <span>
                        <div class="btn addAddersssbtn">+ address</div>
                    </span>
                <?php endif; ?>
                </div>
                <br>
                <hr>
                <br>
        <?php endif; ?>

        <?php foreach ($Products as $Product): ?>
        <div class="odercard margintop-0-5">
                <img src="../../<?php echo $Product->imageurl; ?>" alt="Card Image">
                <div class="odercard-content">
                    <span>
                        <h3 class="titale"><?php echo $Product->title; ?></h3>
                        <p><?php echo $Product->description; ?></p>
                        </span>

                    <?php if ($_SESSION['userid'] == $user_id): ?>
                    <div class="flex">
                            <form action="../../route.php?product_id=<?= $Product->product_id; ?>" method="post">
                                <input type="hidden" name="action" value="deletepost">
                                <button type="submit" class="btn">Delete</button>
                            </form>
                                <button type="submit" class="danger book getpay">Edit</button>
                            </div>
                    <?php endif; ?>
                    </div>
                    <div class="status">
                        <p><?php echo timeDifference($Product->created_at); ?> ago</p>
                    </div>
                    </div>
            <div class="editbox">
                <div class="invoice-form">
                    <h3 class="close"><i class="fa-solid fa-x"></i></h3>
                    <h2>Edit Your Post</h2>
                   <form action="../../route.php?product_id=<?= htmlspecialchars($Product->product_id); ?>" method="post">
                    <input type="hidden" name="action" value="editpost">
                
                    <div class="mb-3">
                        <label for="inputCategory" class="form-label">Category</label>
                        <select class="form-select" name="category" id="inputCategory" required>
                            <option value="" disabled>Select a category</option>
                            <option value="Electronics" <?= $Product->category === 'Electronics' ? 'selected' : ''; ?>>Electronics</option>
                            <option value="Fashion" <?= $Product->category === 'Fashion' ? 'selected' : ''; ?>>Fashion</option>
                            <option value="Home & Garden" <?= $Product->category === 'Home & Garden' ? 'selected' : ''; ?>>Home & Garden
                            </option>
                            <option value="Mobile Phones" <?= $Product->category === 'Mobile Phones' ? 'selected' : ''; ?>>Mobile Phones
                            </option>
                            <option value="Laptops" <?= $Product->category === 'Laptops' ? 'selected' : ''; ?>>Laptops</option>
                            <option value="Cameras" <?= $Product->category === 'Cameras' ? 'selected' : ''; ?>>Cameras</option>
                            <option value="Men's Clothing" <?= $Product->category === "Men's Clothing" ? 'selected' : ''; ?>>Men's Clothing
                            </option>
                            <option value="Women's Clothing" <?= $Product->category === "Women's Clothing" ? 'selected' : ''; ?>>Women's
                                Clothing</option>
                            <option value="Shoes" <?= $Product->category === 'Shoes' ? 'selected' : ''; ?>>Shoes</option>
                            <option value="Furniture" <?= $Product->category === 'Furniture' ? 'selected' : ''; ?>>Furniture</option>
                            </select>
                            <div class="invalid-feedback">Please select a category.</div>
                            </div>
                
                    <div class="mb-3">
                        <label for="inputTitle" class="form-label">Title</label>
                        <input type="text" required name="title" class="form-control" id="inputTitle"
                            value="<?= htmlspecialchars($Product->title); ?>">
                        <div class="invalid-feedback">Please provide a title.</div>
                        </div>
                
                    <div class="mb-3">
                        <label for="inputDescription" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="inputDescription"
                            rows="3"><?= htmlspecialchars($Product->description); ?></textarea>
                    </div>
                
                    <div class="mb-3">
                        <label for="inputPrice" class="form-label">Price</label>
                        <input type="text" required name="price" class="form-control" id="inputPrice"
                            value="<?= htmlspecialchars($Product->price); ?>">
                        <div class="invalid-feedback">Please provide a price.</div>
                        </div>
                
                    <div class="mb-3">
                        <label for="inputImage" class="form-label">Image URL</label>
                        <input type="text" name="imageurl" class="form-control" id="inputImage"
                            value="<?= htmlspecialchars($Product->imageurl); ?>">
                        </div>
                
                    <div class="mb-3">
                        <label for="inputCondition" class="form-label">Condition</label>
                        <select class="form-select" name="condition" id="inputCondition" required>
                            <option value="" disabled>Select a condition</option>
                            <option value="New" <?= $Product->condition === 'New' ? 'selected' : ''; ?>>New</option>
                            <option value="Used" <?= $Product->condition === 'Used' ? 'selected' : ''; ?>>Used</option>
                            <option value="Refurbished" <?= $Product->condition === 'Refurbished' ? 'selected' : ''; ?>>Refurbished
                            </option>
                            </select>
                            <div class="invalid-feedback">Please select a condition.</div>
                            </div>
                    <div class="mb-3">
                        <label for="inputStack" class="form-label">Stack</label>
                        <input type="number" required name="stack" class="form-control" id="inputStack"
                            value="<?= htmlspecialchars($Product->stack); ?>">
                        <div class="invalid-feedback">Please provide a stack value.</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>

                        </div>
                        </div>
                        <?php endforeach; ?>
    </div>
    </div>
    <script>
        document.querySelectorAll('.danger.book.getpay').forEach((editBtn, index) => {
            editBtn.addEventListener('click', (e) => {
                e.preventDefault();
                document.querySelectorAll('.editbox')[index].style.display = 'block';
            });
        });

    document.querySelectorAll('.close').forEach((closeBtn, index) => {
        closeBtn.addEventListener('click', () => {
            document.querySelectorAll('.editbox')[index].style.display = 'none';
        });
    });
    const closeButton = document.querySelectorAll(".close");
    closeButton.forEach(button => {
        button.addEventListener("click", () => {
            button.parentElement.style.display = "none";
        });
    });

 let adressform = document.querySelector(".adressform");
let addAddersssbtn = document.querySelector(".addAddersssbtn");


addAddersssbtn.addEventListener('click', () => {
    adressform.style.display = "block";
    addAddersssbtn.style.display = "none";
});
</script>
<?php include ('../include/footer.php'); ?>
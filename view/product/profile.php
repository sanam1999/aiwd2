<?php



include ('../isAuthenticate.php');
include ('../include/header.php');
require ('../../model/product.php');
require ('../../model/odersandcard.php')

    ?>
<style>
    
    .flex {
        display: flex;
        gap: 5px;

    }

    .editbox {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 40%;
        display: none;
        margin-top: 4rem;
    }

    .denger {
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
   
   .invoice-form h3{
        text-align: end;
         display: block;
    }
</style>
<div class="f margintop-0-5">
    <div class="profileEdit">
        <div class="profile">
            <i class="fa-solid fa-user"></i>
            <div class="post">
                <span>10 posts</span><span>5 stars</span>
            </div>
        </div>
        <br>
        <hr>
        <div class="userdata margintop-1">
            <div class="form-row">
                <div class="form-group">
                    <label for="inputEmail4">Name</label>
                    <p><?php echo $_SESSION['user'] ?></p>
                </div>
                <div class="form-group">
                    <label for="inputEmail4">Email</label>
                    <p><?php echo $_SESSION['email'] ?></p>
                </div>
            </div>
            <?php $Address = fetchAddress();

            ?>

            <br>
            <h3 class="close">Address</h3>

            <div class="form-row">
                <div class="form-group">
                    <label for="inputEmail4">Province</label>
                    <p><?php echo $Address->province ?></p>
                </div>
                <div class="form-group">
                    <label for="inputPassword4">District</label>
                    <p><?php echo $Address->district ?></p>
                </div>
                <div class="form-group">
                    <label for="inputPassword4">Zip Code</label>
                    <p><?php echo $Address->zip_code ?> </p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="inputEmail4">Phome number</label>
                    <p><?php echo $Address->phone_number ?></p>
                </div>
                <div class="form-group">
                    <label for="inputPassword4">Address</label>
                    <p><?php echo $Address->address ?></p>
                </div>
            </div>


        </div>
        <br>
        <hr>
        <br>
        <?php

        if (!isset($uid) || $uid === null) {
            $uid = $_SESSION['userid'];
        }

        $Result = fetchProductuser($uid);


        if ($Result):
            foreach ($Result as $Product): ?>

                <div class="odercard margintop-0-5">
                    <img src=<?php echo $Product->imageurl ?> alt="Card Image">
                    <div class="odercard-content">
                        <span>
                            <h3 class="titale"><?php echo $Product->title ?></h3>
                            <p><?php echo $Product->description ?></p>
                        </span>

                        <?php if (true): ?>
                            <div class="flex">
                                <form action="../../model/product.php?product_id=<?= $Product->product_id ?>" method="post">
                                    <input type="hidden" name="action" value="delete">
                                    <button type="submit" class="btn">Delete</button>
                                </form>
                              
                                
                                <button type="submit" class="denger book getpay">Edit</button>
                             
                            </div>

                        <?php endif; ?>
                    </div>
                    <div class="status">
                        <p><?php echo timeDifference($Product->created_at); ?> ago</p>
                    </div>
                </div>
                <div class="editbox ">
                    <div class="invoice-form">
                        <h3 class="close"><i class="fa-solid fa-x"></i></h3>
                        
                        <h2>Edit Your Post</h2>
                        <form action="../../model/product.php?product_id=<?= $Product->product_id ?>" method="post">
                            <div class="mb-3">
                                <label for="inputCategory" class="form-label">Category</label>
                                <select class="form-select" name="category" id="inputCategory" required>
                                    <option selected disabled value=<?php echo $Product->category ?>><?php echo $Product->category ?></option>
                                    <option value="Electronics">Electronics</option>
                                    <option value="Fashion">Fashion</option>
                                    <option value="Home & Garden">Home & Garden</option>
                                    <option value="Mobile Phones">Mobile Phones</option>
                                    <option value="Laptops">Laptops</option>
                                    <option value="Cameras">Cameras</option>
                                    <option value="Men's Clothing">Men's Clothing</option>
                                    <option value="Women's Clothing">Women's Clothing</option>
                                    <option value="Shoes">Shoes</option>
                                    <option value="Furniture">Furniture</option>
                                </select>
                                <div class="invalid-feedback">Please select a category.</div>
                            </div>
                            <div class="mb-3">
                                <label for="inputTitle" class="form-label">Title</label>
                                <input type="text" required name="title" class="form-control" id="inputTitle" value=<?php echo $Product->title ?>>
                                <div class="invalid-feedback">Please provide a title.</div>
                            </div>
                            <div class="mb-3">
                                <label for="inputDescription" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="inputDescription"
                                    rows="3"><?php echo htmlspecialchars($Product->description); ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="inputPrice" class="form-label">Price</label>
                                <input type="number" step="0.01" required name="price" class="form-control" id="inputPrice"
                                    value=<?php echo $Product->price ?>>
                                <div class="invalid-feedback">Please provide a valid price.</div>
                            </div>
                            <div class="mb-3">
                                <label for="inputStock" class="form-label">Stock</label>
                                <input type="number" required name="stock" class="form-control" id="inputStock" value=<?php echo $Product->stock ?>>
                                <div class="invalid-feedback">Please provide a valid stock quantity.</div>
                            </div>
                            <div class="mb-3">
                                <label for="inputStock" class="form-label">image</label>
                                <input type="text" name="imageurl" class="form-control" id="inputImage" value=<?php echo $Product->imageurl ?>>
                                <div class="invalid-feedback">Please provide a valid stock quantity.</div>
                            </div>
                            <div class="mb-3">
                                <label for="inputCondition" class="form-label">Condition</label>
                                <select class="form-select" name="condition" id="inputCondition" required>
                                    <option selected disabled value=<?php echo $Product->condition ?>><?php echo $Product->condition ?></option>
                                    <option value="New">New</option>
                                    <option value="Used">Used</option>
                                    <option value="Refurbished">Refurbished</option>
                                </select>
                                <div class="invalid-feedback">Please select a condition.</div>
                            </div>

                            <button class="btn">Update</button>

                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>


    </div>
</div>

<?php
include ('../include/footer.php');

function timeDifference($targetDateTime)
{
    $targetDate = new DateTime($targetDateTime);
    $now = new DateTime();
    $diff = $targetDate->diff($now);
    if ($diff->days > 0) {
        return $diff->days . " days";
    } elseif ($diff->h > 0) {
        return $diff->h . " hours";
    } else {
        return $diff->i . " minutes";
    }
}
?>
<script>
    document.querySelector('.getpay').addEventListener('click', () => {
        document.querySelector('.editbox').style.display = 'block';
    });
    let btns = document.querySelectorAll('h3.close');
for (let btn of btns) {
    btn.addEventListener('click', () => {
        console.log("dfgdsg");
        document.querySelector('.editbox').style.display = 'none';
    });
}

 
</script>
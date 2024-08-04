<?php
include ('../isAuthenticate.php');
include ('../include/header.php');
?>

<div class="form">
    <h1>Add Product</h1>
    <?php
    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }
    ?>
    <form action="../../route.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
        <input type="hidden" name="action" value="addpost">
        <div class="mb-3">
            <label for="inputCategory" class="form-label">Category</label>
            <select class="form-select" name="category" id="inputCategory" required>
                <option selected disabled value="">Choose...</option>
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
            <input type="text" required name="title" class="form-control" id="inputTitle">
            <div class="invalid-feedback">Please provide a title.</div>
        </div>
        <div class="mb-3">
            <label for="inputDescription" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="inputDescription" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="inputPrice" class="form-label">Price</label>
            <input type="number" step="0.01" required name="price" class="form-control" id="inputPrice">
            <div class="invalid-feedback">Please provide a valid price.</div>
        </div>
        <div class="mb-3">
            <label for="inputStock" class="form-label">Stock</label>
            <input type="number" required name="stock" class="form-control" id="inputStock">
            <div class="invalid-feedback">Please provide a valid stock quantity.</div>
        </div>
        <div class="mb-3">
            <label for="inputImage" class="form-label">Image</label>
            <input type="file" name="imageurl" class="form-control" id="inputImage" required>
            <div class="invalid-feedback">Please upload an image.</div>
        </div>
        <div class="mb-3">
            <label for="inputCondition" class="form-label">Condition</label>
            <select class="form-select" name="condition" id="inputCondition" required>
                <option selected disabled value="">Choose...</option>
                <option value="New">New</option>
                <option value="Used">Used</option>
                <option value="Refurbished">Refurbished</option>
            </select>
            <div class="invalid-feedback">Please select a condition.</div>
        </div>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>

<?php
include ('../include/footer.php');
?>
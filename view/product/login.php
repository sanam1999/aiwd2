<?php
include ('../include/header.php');
?>
<div class="form ">
    <h1>Login</h1>
    <form action="../../route.php" method="post" class="needs-validation" novalidate>
        <input type="hidden" name="action" value="login">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" required name="email" class="form-control" id="exampleInputEmail1">
            <div class="invalid-feedback"> Give a valid Email</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" required name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-success mb-5">Login</button>
    </form>
</div>
<?php
include ('../include/footer.php');
?>
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>amazon-clone</title>

   <link rel="stylesheet" href="../../css/templed.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="../../css/style2.css">

 <style>
    * {
    margin: 0;
    font-family: "Amazon Ember", Arial, sans-serif;
    border: border-box;
    text-decoration: none;

}

    .navbar {
    background-color: black;
    height: 53px;
    color: white;
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    padding: 0.5rem;
}
.nav {
    height: 94%;
    width: 150px;


}
.border {
    border: 1px solid transparent;
    border-radius: 5px;
        padding: 0.5rem;

}

.border:hover {
    border: 1px solid rgb(255, 255, 255);
    border-radius: 5px;
        padding: 0.5rem;
}
.logo {
    background-image: url('amazon-logo.png');
    background-size: cover;
    height: 100%;
    width: 100%;
}
.nav-sea {
    display: flex;
    justify-content: space-evenly;
    width: 790px;
    height: 80%;


}
.se {
    background-color: #e4e4e4;
    width: 50px;
    text-align: center;
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
    border: none;

}
.search-item {
    width: 100%;
    font-size: 1rem;
    border: none;



}
.search-icon {
    width: 59px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1.7rem;
    background-color: rgb(255, 186, 57);
    border-bottom-right-radius: 3px;
    border-top-right-radius: 3px;



}
.nav-signin:hover .option {
    display: block;
   
}

 </style>

</head>


<header>
   
    <div class="navbar">
        <div class="nav border">
            <a href="amazon.html">
                <div class="logo"></div>
        </div> </a>

        <div class="nav-sea ">
            <select class="se">
                <option>All</option>
            </select>
            <input class="search-item" placeholder="Search Amazon">
            <div class="search-icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </div>

        <div class="nav-signin border">
            <span>
                <p><samp class="same1">Hello, sign in</samp></p>
                <p class="same2">Account & Lists</p>
            </span>
            <div class="option">
                <?php if ($_SESSION['login'] == true && isset($_SESSION['login'])): ?>
                    <a href="../user/logout.php">Logout</a>
                    <a href="../product/profile.php">Profile</a>
                <?php else: ?>
                    <a href="../user/SingUp.php">SignIn</a>
                    <a href="../user/login.php">Login</a>
                <?php endif ?>
            </div>
        </div>


        <a href="../product/oders.php" class="return border">
    <div>
        <p class="same1">Return</p>
        <p class="same2">& Orders</p>
    </div>
</a>

        <div class="card border">
            <i class="fa-solid fa-cart-shopping fa-beat"></i>
            <p id="card">Card</p>
        </div>
    </div>

</header>
<div class="panal ">

    <div class="filters">
        <i class="fa-solid toggleButton border fa-bars"></i>
        <a class="filter  border" href="/final">
            <div><i class="fa-solid fa-fire"></i></div>
            <p>Trending</p>
        </a>
        <a class="filter border" href="/listings">

            <div><i class="fa-solid fa-bed"></i></div>
            <p>Rooms</p>
        </a>
        <a class="filter border" href="/listings">
            <div><i class="fa-solid fa-mountain-city"></i></div>
            <p>Iconic Cities</p>
        </a>
        <a class="filter border" href="/listings">
            <div><i class="fa-solid fa-mountain"></i></div>
            <p>Mountain</p>
        </a>
        <a class="filter border" href="/listings">
            <div><i class="fa-brands fa-fort-awesome"></i></div>
            <p>Castles</p>
        </a>
        <a class="filter border" href="/listings">
            <div><i class="fa-solid fa-person-swimming"></i></div>
            <p>Amazing Pools</p>
        </a>
        <a class="filter border" href="/listings">
            <div><i class="fa-solid fa-campground"></i></div>
            <p>Camping</p>
        </a>
        <a class="filter border" href="/listings">
            <div> <i class="fa-solid fa-tractor"></i> </div>
            <p>Farms</p>
        </a>

        <a class="filter border" href="/listings">
            <div> <i class="fa-solid fa-snowflake"></i> </div>
            <p>Arctic</p>
        </a>
        <a class="filter border" href="/listings">
            <div><i class="fa-solid fa-mountain-city"></i></div>
            <p>Iconic Cities</p>
        </a>
        <a class="filter border" href="/listings">
            <div><i class="fa-solid fa-campground"></i></div>
            <p>Camping</p>
        </a>

    </div>

</div>


<div id="sidebar" class="sidebar oc">
<?php if ($_SESSION['login'] == true && isset($_SESSION['login'])): ?>
    <a class="sidebar-item oc" href="../user/logout.php"><i class="fa-solid fa-user"></i>
        <?php echo $_SESSION['user']; ?></a>
<?php endif ?>
<a href="../product/home.php" class="sidebar-item oc"> <i class="fa-solid fa-house"></i> Home</a>
<a href="#" class="sidebar-item oc"> <i class="fa-solid fa-handshake-angle"></i> Help</a>
<a href="#" class="sidebar-item oc"> <i class="fa-solid fa-cart-shopping"></i> Orders</a>
<a href="#" class="sidebar-item oc"> <i class="fa-solid fa-bookmark"></i> Card</a>
<a href="#" class="sidebar-item oc"> Contact</a>
<a href="#" class="sidebar-item oc"> Contact</a>
<a href="#" class="sidebar-item oc"> Contact</a>
<a href="#" class="sidebar-item oc"> Contact</a>
<a href="#" class="sidebar-item oc"> Contact</a>
<a href="#" class="sidebar-item oc"> Contact</a>

</div>

<?php
include ("flassmsg.php");
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


?>
<body>
    <main class="main-content">





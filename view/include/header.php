<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>amazon-clone</title>

    
  </head>

  <link rel="icom" href="https://cdn.pixabay.com/photo/2017/03/16/21/18/logo-2150297_640.png">
    <link rel="stylesheet" href="../../css/templed.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../css/style2.css">
    <link rel="stylesheet" href="../../css/star.css">

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
            border: none;



        }

        .nav-signin:hover .option {
            display: block;

        }
        .weblogo{
            color: white;
            font-size: 2rem;

        }
    </style>

</head>


<header>

    <div class="navbar">
        
            <a class="border" href="../product/home.php">
                <i class="fa-solid weblogo fa-cart-flatbed"></i>
       </a>
        
           
                <form class="nav-sea " action="home.php" method="get">
                <input class="search-item" name="searchitem" placeholder="Search">
                <button class="search-icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                </form>
          
        
        <div class="nav-signin border">
            <span>
                <p><samp class="same1">Hello, sign in</samp></p>
                <p class="same2">Account & Lists</p>
            </span>
            <div class="option">
                <?php if ($_SESSION['login'] == true && isset($_SESSION['login'])): ?>
                    <a href="../product/logout.php">Logout</a>
                    <a href="../product/profile.php">Profile</a>
                <?php else: ?>
                    <a href="../product/SingUp.php">SignIn</a>
                    <a href="../product/login.php">Login</a>
                <?php endif ?>
            </div>
        </div>


        <a href="../product/orders.php" class="return border">
            <div>
                <p class="same1">Return</p>
                <p class="same2">& Orders</p>
            </div>
        </a>
 <a href="../product/card.php" class="card return border">
            
            <i class="fa-solid fa-cart-shopping fa-beat"></i>
            <p id="card">Card</p>
       
        </a>
       
    </div>

</header>
<div class="panal">

    <div class="filters">
        <i class="fa-solid toggleButton border fa-bars"></i>
        <a class="filter border" href="home.php?category=Electronics">
            <div><i class="fa-solid fa-bolt-lightning"></i></div>
            <p>Electronics</p>
        </a>
        <a class="filter border" href="home.php?category=Fashion">
            <div><i class="fa-solid fa-vest-patches"></i></div>
            <p>Fashion</p>
        </a>
        <a class="filter border" href="home.php?category=HomeGardens">
            <div><i class="fa-solid fa-warehouse"></i></div>
            <p>Home & Gardens</p>
        </a>
        <a class="filter border" href="home.php?category=MobilePhones">
            <div><i class="fa-solid fa-mobile-screen-button"></i></div>
            <p>Mobile Phones</p>
        </a>
        <a class="filter border" href="home.php?category=Laptops">
            <div><i class="fa-solid fa-laptop"></i></div>
            <p>Laptops</p>
        </a>
        <a class="filter border" href="home.php?category=Cameras">
            <div><i class="fa-solid fa-camera-retro"></i></div>
            <p>Cameras</p>
        </a>
        <a class="filter border" href="home.php?category=MensClothing">
            <div><i class="fa-solid fa-person"></i></div>
            <p>Men's Clothing</p>
        </a>
        <a class="filter border" href="home.php?category=WomensClothing">
            <div><i class="fa-solid fa-person-dress"></i></div>
            <p>Women's Clothing</p>
        </a>
        <a class="filter border" href="home.php?category=Shoes">
            <div><i class="fa-solid fa-shoe-prints"></i></div>
            <p>Shoes</p>
        </a>
        <a class="filter border" href="home.php?category=Furniture">
            <div><i class="fa-solid fa-couch"></i></div>
            <p>Furniture</p>
        </a>
    </div>

</div>




<div id="sidebar" class="sidebar oc">
<?php if ($_SESSION['login'] == true && isset($_SESSION['login'])): ?>
        <a class="sidebar-item oc" href="../product/profile.php"><i class="fa-solid fa-user"></i>
        <?php echo $_SESSION['user']; ?></a>
<?php endif ?>
<a href="../product/home.php" class="sidebar-item oc"> <i class="fa-solid fa-house"></i> Home</a>
<a href="#" class="sidebar-item oc"> <i class="fa-solid fa-handshake-angle"></i> Help</a>
<a href="#" class="sidebar-item oc"> <i class="fa-solid fa-cart-shopping"></i> Orders</a>
<a href="#" class="sidebar-item oc"> <i class="fa-solid fa-bookmark"></i> Card</a>
<a href="../product/AddProduct.php" class="sidebar-item oc"><i class="fa-solid fa-plus"></i> Add Post</a>
<a href="../product/sales.php" class="sidebar-item oc"> <i class="fa-brands fa-sellsy"></i> Seles</a>
<a href="#" class="sidebar-item oc"> <i class="fa-solid fa-truck-fast"></i> Placed Orders</a>
<?php if ($_SESSION['login'] == true && isset($_SESSION['login'])): ?>
    <a class="sidebar-item oc" href="../product/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a>
<?php endif ?>
</div>

<?php
include ("flassmsg.php");
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


?>

<body>
    <main class="main-content">
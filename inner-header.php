<?php 
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin= true;
  $userId = $_SESSION['userId'];
  $username = $_SESSION['username'];
}
else{
  $loggedin = false;
  $userId = 0;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
    <!-- main style -->
  <link rel="stylesheet" href="assets/css/main.css">
  <!-- responsive -->
  <link rel="stylesheet" href="assets/css/responsive.css">
    <title>Kitchen</title>
    <link rel = "icon" href ="img/chef-restaurant-logo.png" type = "image/x-icon">
  </head>
<body>
  <?php include 'partials/_dbconnect.php';
        include 'partials/_loginModal.php';
        include 'partials/_signupModal.php';
    ?>
    <!-- header -->
  <div class="top-header-area" id="sticker">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-sm-12 text-center">
          <div class="main-menu-wrap">
            <!-- logo -->
            <div class="site-logo">
              <a href="index.php">
                <img src="img/chef-restaurant-logo.png" alt="">
              </a>
            </div>
            <!-- logo -->

            <!-- menu start -->
            <nav class="main-menu">
              <ul>
                <li class="current-list-item"><a href="index.php">Home</a></li>
                <li><a href="about.php" >About</a></li>
                <li><a href="viewOrder.php">Track Order</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <?php
                $countsql = "SELECT SUM(`itemQuantity`) FROM `tbl_viewcart` WHERE `userId`=$userId"; 
                $countresult = mysqli_query($conn, $countsql);
                $countrow = mysqli_fetch_assoc($countresult);      
                $count = $countrow['SUM(`itemQuantity`)'];
                if(!$count) {
                $count = 0;
                }
                ?>
                <li>
                  <div class="header-icons">
                    <?php
                    if($count!=0){?>
                    <a class="shopping-cart" href="viewCart.php"><i class="fas fa-shopping-cart"> (<?php echo $count; ?>)</i></a>
                    <?php } else{?>
                      <a class="shopping-cart" href="viewCart.php"><i class="fas fa-shopping-cart"></i></a>
                    <?php } 
                    if($loggedin){
          echo '<a href="viewProfile.php"><img src="img/person-' .$userId. '.jpg" class="rounded-circle" onError="this.src = \'img/profilePic.jpg\'" style="width:40px; height:40px"></a>
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"> Welcome ' .$username. '</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" style="color:#555;" href="partials/_logout.php">Logout</a>
              </div>';
        } else {?>

                    <a class="cart-btn2" data-toggle="modal" data-target="#loginModal">Login</a>
                    <a class="cart-btn2"  data-toggle="modal" data-target="#signupModal">SignUp</a>
                  <?php } ?>
                
                  </div>
                </li>
              </ul>
            </nav>
              
              <a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
            <div class="mobile-menu"></div>
            <!-- menu end -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end header -->
  <!-- breadcrumb-section -->
  <?php
    if(basename($_SERVER['PHP_SELF'])=='viewitem.php')
    {
  echo '<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2 text-center">
          <div class="breadcrumb-text">
            <h1>Item</h1>
          </div>
        </div>
      </div>
    </div>
  </div>';
}
else if(basename($_SERVER['PHP_SELF'])=='viewOrder.php')
{
    echo '<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2 text-center">
          <div class="breadcrumb-text">
            <h1>Orders</h1>
          </div>
        </div>
      </div>
    </div>
  </div>';
}
else if(basename($_SERVER['PHP_SELF'])=='contact.php')
{
    echo '<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2 text-center">
          <div class="breadcrumb-text">
            <h1>Contact Us</h1>
          </div>
        </div>
      </div>
    </div>
  </div>';
}
else if(basename($_SERVER['PHP_SELF'])=='about.php')
{
    echo '<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2 text-center">
          <div class="breadcrumb-text">
            <h1>About Us</h1>
          </div>
        </div>
      </div>
    </div>
  </div>';
}
else if(basename($_SERVER['PHP_SELF'])=='viewProfile.php')
{
    echo '<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2 text-center">
          <div class="breadcrumb-text">
            <h1>Profile</h1>
          </div>
        </div>
      </div>
    </div>
  </div>';
}
else
{
  echo '<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2 text-center">
          <div class="breadcrumb-text">
            <h1>Cart</h1>
          </div>
        </div>
      </div>
    </div>
  </div>';
}     
?>
  <!-- end breadcrumb section -->
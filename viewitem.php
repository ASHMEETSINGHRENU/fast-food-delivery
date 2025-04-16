<?php
require_once 'inner-header.php';

$foodId = $_GET['foodid'];
$sql = "SELECT * FROM `tbl_food` WHERE id = $foodId";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$foodName = $row['item'];
$foodprice = $row['price'];
$fooddesc = $row['description'];
?> 
            <!-- single product -->
    <div class="single-product mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="single-product-img">
                        <img src="img/item-<?php echo $foodId; ?>.jpg" alt="">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="single-product-content">
                        <h3><?php echo $foodName; ?></h3>
                        <p class="single-product-pricing">Rs. <?php echo $foodprice; ?>/-</p>
                        <p><?php echo $fooddesc; ?></p>
                <?php
                if($loggedin){
                    $quaSql = "SELECT `itemQuantity` FROM `tbl_viewcart` WHERE foodId = '$foodId' AND `userId`='$userId'";
                    $quaresult = mysqli_query($conn, $quaSql);
                    $quaExistRows = mysqli_num_rows($quaresult);
                    if($quaExistRows == 0) {
                        echo '<form action="partials/_manageCart.php" method="POST">
                             <input type="number" name="quant" placeholder=0 required><br>
                              <input type="hidden" name="itemId" value="'.$foodId. '">
                              <button type="submit" name="addToCart" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</button></form>';
                    }else {?>
                        <div class="single-product-form">
                            
                            <a href="viewCart.php" class="cart-btn"><i class="fas fa-shopping-cart"></i> Go to Cart</a>
                            
                        </div>
                    <?php }
                    }
                else{ ?>
                    <div class="single-product-form">
                    <form action="index.html">
                        <input type="number" value="1">
                    </form>
                    <a class="cart-btn" data-toggle="modal" data-target="#loginModal"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                </div>
                <?php  }?>
                
                        <h4>Share:</h4>
                        <ul class="product-share">
                            <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href=""><i class="fab fa-twitter"></i></a></li>
                            <li><a href=""><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end single product -->
    <?php require_once 'footer.php' ?>

    
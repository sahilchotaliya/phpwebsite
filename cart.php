<?php
    include 'connection.php';
    session_start();
    $admin_id = $_SESSION['user_name'];

    if (!isset($admin_id)) {
        header('location:login.php');
    }

    if(isset($_POST['logout'])){
        session_destroy();
        header('location:login.php');
    }
    if(isset($_POST['logout'])){
        session_destroy();
        header('location:login.php');
    }

  	//updateing qty

  	if (isset($_POST['update_qty_btn'])) {
  		$update_qty_id = $_POST['update_qty_id'];
  		$update_value = $_POST['update_qty'];

  		$update_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id='$update_qty_id' ")or die('query failed');
  		if($update_query){
  			header('location:cart.php');
  		}
  	}


     // delete product from cart
    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
       
        mysqli_query($conn,"DELETE FROM `cart` WHERE id = '$delete_id' ")or die('query failed');
        header('location:cart.php');
    }

    // delete product from cart
    if(isset($_GET['delete_all'])){
    $user_id = $_SESSION['user_id'];

    mysqli_query($conn,"DELETE FROM `cart` WHERE user_id = '$user_id'")or die('query failed');
    header('location:cart.php');
}

   
?>
<!DOCTYPE html>
<html lang="en">
<head>
       <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- bootstrap icon link -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet"  href="main.css">
        <title>wishlist</title>
    </head>
<body>
<?php include 'header.php';  ?>

    <div class="banner">    
    <div class="detail">
        <h1>my cart</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiudmod tempor.</p>
        <a href="index.php">home </a><span>/ wishlist</span>
    </div>
</div>
<div class="line4"></div>
<!-- ----------------cart------------------- -->
<section class="shop">
    <h1 class="title">Products added in cart</h1>
    <?php
                if (isset($message)) {
                    foreach ($message as $message) {
                        echo '
                        <div class="message">
                        <span>'.$message.'</span>
                        <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                        </div>
                        ';
                    }
                }
                ?>

<div class="box-container">
    <?php
    print_r($fetch_products,'fetch product');
    $grand_total = 0;
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart`") or die('Query failed');
    if (mysqli_num_rows($select_cart) > 0) {
        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
            ?>
            <form method="post">
                <div class="box">
                    <div class="icon">
                        <a href="view_page.php?pid=<?php echo $fetch_cart['pid']; ?>" class="bi bi-eye-fill"></a>
                        <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="bi bi-x"
                           onclick="return confirm('do you want to delete this product from your cart')"> </a>
                        <button type="submit" name="add_to_cart" class="bi bi-cart"></button>
                    </div>

                    <img src="image/<?php echo $fetch_cart['image']; ?>">
                    <div class="price">₹<?php echo $fetch_cart['price']; ?>/-</div>
                    <div class="name"><?php echo $fetch_cart['name']; ?></div>

                    <input type="hidden" name="update_qty_id" value="<?php echo $fetch_cart['id']; ?>">
                    <div class="qty">
                        <input type="number" min="1" name="update_qty" value="<?php echo $fetch_cart['quantity']; ?>">
                        <input type="submit" name="update_qty_btn" value="update">
                    </div>
                </div>
                <div class="total_amt">
                    Total Amount: <span><?php echo $total_amt = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></span>
                </div>
            </form>
            <?php
            $grand_total += $total_amt;
        }
    } else {
        echo '<p class="empty">No products added yet!</p>';
    }
    ?>
</div>
    <div class="dlt">
    	<a href="cart.php?delete_all" class="btn2" onclick="return confirm('do you want to delete all items in your cart')">delete all</a>
    </div>
        <div class="wishlist_total">
            <p>total amount payable : <span>$<?php echo $grand_total; ?>/-</span></p>
            <a href="shop.php" class="btn">continue shoping</a>
            <a href="checkout.php" class="btn">proceed to checkout</a>
            
        </div>
        </section>
        <div class="line2"></div>
        <div class="line4"></div>

    <?php include 'footer.php';  ?>

   <script type="text/javascript" src="script.js"></script>
</html>
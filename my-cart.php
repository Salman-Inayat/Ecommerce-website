<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submit'])){
		if(!empty($_SESSION['cart'])){
		foreach($_POST['quantity'] as $key => $val){
			if($val==0){
				unset($_SESSION['cart'][$key]);
			}else{
				$_SESSION['cart'][$key]['quantity']=$val;
			}
		}
		}
	}

    if(isset($_POST['remove_code']))
	{
if(!empty($_SESSION['cart'])){
		foreach($_POST['remove_code'] as $key){
				unset($_SESSION['cart'][$key]);
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">

    <title>My Cart</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css">

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>

    <script src="https://kit.fontawesome.com/d34e22b7c9.js" crossorigin="anonymous"></script>
</head>

<body class="cnt-home">
    <header class="header-style-1">
        <?php include('includes/header.php');?>
    </header>
    <div class="body-content outer-top-xs">
        <div class="container">
            <div class="row inner-bottom-sm">
                <div class="shopping-cart">
                    <div class="col-md-12 col-sm-12 shopping-cart-table ">
                        <div class="table-responsive">
                            <form name="cart" method="post">
                                <?php
if(!empty($_SESSION['cart'])){
	?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="cart-romove item">Remove</th>
                                            <th class="cart-description item">Image</th>
                                            <th class="cart-product-name item">Product Name</th>
                                            <th class="cart-sub-total item">Price Per unit</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <td colspan="7">
                                                <div class="shopping-cart-btn">
                                                    <span class="">
                                                        <a href="index.php"
                                                            class="btn btn-upper btn-primary outer-left-xs">Continue
                                                            Shopping</a>
                                                        <input type="submit" name="submit" value="Update shopping cart"
                                                            class="btn btn-upper btn-primary pull-right outer-right-xs">
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
 $pdtid=array();
    $sql = "SELECT * FROM products WHERE id IN(";
			foreach($_SESSION['cart'] as $id => $value){
			$sql .=$id. ",";
			}
			$sql=substr($sql,0,-1) . ") ORDER BY id ASC";
			$query = mysqli_query($con,$sql);
			$totalprice=0;
			// $totalqunty=0;
			if(!empty($query)){
			while($row = mysqli_fetch_array($query)){
				$subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge'];
				array_push($pdtid,$row['id']);?>
                                        <tr>
                                            <td class="remove-item"><input type="checkbox" name="remove_code[]"
                                                    value="<?php echo ($row['id']);?>" /></td>
                                            <td class="cart-image">
                                                <a class="entry-thumbnail" href="detail.html">
                                                    <img src="<?php echo $row['productImage1'];?>" alt="" width="114"
                                                        height="146">
                                                </a>
                                            </td>
                                            <td class="cart-product-name-info">
                                                <h4 class='cart-product-description'>
                                                    <a href="product-details.php?pid=<?php echo ($pd=$row['id']);?>"><?php echo $row['productName']; $_SESSION['sid']=$pd;  ?></a>
                                                </h4>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <?php include('includes/rating.php');?>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <?php $rt=mysqli_query($con,"select * from productreviews where productId='$pd'");
$num=mysqli_num_rows($rt);{?>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart-product-sub-total"><span
                                                    class="cart-sub-total-price"><?php echo "Rs"." ".$row['productPrice']; ?>.00</span>
                                            </td>
                                        </tr>
                                        <?php } }
$_SESSION['pid']=$pdtid;?>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    <?php } else {
echo "Your shopping Cart is empty";}?>
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    <?php include('includes/footer.php');?>

    <script src="assets/js/jquery-1.11.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>
</html>
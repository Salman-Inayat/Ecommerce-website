<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_GET['action']) && $_GET['action']=="add"){
	$id=intval($_GET['id']);
	if(isset($_SESSION['cart'][$id])){
		$_SESSION['cart'][$id]['quantity']++;
	}else{
		$sql_p="SELECT * FROM products WHERE id={$id}";
		$query_p=mysqli_query($con,$sql_p);
		if(mysqli_num_rows($query_p)!=0){
			$row_p=mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']);
		}else{
			$message="Product ID is invalid";
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">

    <title>Shopping Portal Home Page</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- <link rel="stylesheet" href="assets/css/green.css"> -->
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css">
    <link rel="stylesheet" href="assets/css/owl.theme.css">
    <link href="assets/css/lightbox.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

    <!-- <link href="assets/css/green.css" rel="alternate stylesheet" title="Green color"> -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

</head>

<body class="cnt-home">
    <header class="header-style-1">
        <?php include('includes/top-header.php');?>
        <?php include('includes/main-header.php');?>
    </header>
    <div class="body-content outer-top-xs" id="top-banner-and-menu">
        <div class="container">
            <div class="furniture-container homepage-container">
                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-3 sidebar">
                        <?php include('includes/side-menu.php');?>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
                        <div id="product-tabs-slider" class="scroll-tabs inner-bottom-vs  wow fadeInUp">
                            <div class="more-info-tab clearfix">
                                <h3 class="new-product-title pull-left">Featured Products</h3>
                            </div>

                            <div class="tab-content outer-top-xs">
                                <div class="tab-pane in active" id="all">
                                    <div class="product-slider">
                                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme"
                                            data-item="3">
                                            <?php
$ret=mysqli_query($con,"select * from products");
while ($row=mysqli_fetch_array($ret)) 
{?>
                                            <div class="item item-carousel">
                                                <div class="products">
                                                    <div class="product">
                                                        <div class="product-image">
                                                            <div class="image">
                                                                <a
                                                                    href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
                                                                    <img src="<?php echo htmlentities($row['productImage1']);?>"
                                                                        width="180" height="300" alt=""></a>
                                                            </div>
                                                        </div>
                                                        <div class="product-info text-left">
                                                            <h3 class="name"><a
                                                                    href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a>
                                                            </h3>
                                                            <?php include('includes/rating.php');?>
                                                            <div class="description"></div>

                                                            <div class="product-price">
                                                                <span class="price">
                                                                    Rs.<?php echo htmlentities($row['productPrice']);?>
                                                                </span>
                                                                <span
                                                                    class="price-before-discount">Rs.<?php echo htmlentities($row['productPriceBeforeDiscount']);?>
                                                                </span>

                                                            </div><!-- /.product-price -->

                                                        </div><!-- /.product-info -->
                                                        <?php if($row['productAvailability']=='In Stock'){?>
                                                        <div class="action"><a
                                                                href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                                                class="lnk btn btn-primary"><span><i
                                                                        class="glyphicon glyphicon-shopping-cart"></i></span></a>
                                                            <a class="btn btn-primary" data-toggle="tooltip"
                                                                data-placement="right" title="Wishlist"
                                                                href="product-details.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist">
                                                                <i class="fa fa-heart"></i>
                                                            </a>
                                                        </div>
                                                        <?php } else {?>
                                                        <div class="action" style="color:red">Out of Stock</div>
                                                        <?php } ?>
                                                    </div><!-- /.product -->
                                                </div><!-- /.products -->
                                            </div><!-- /.item -->
                                            <?php } ?>

                                        </div><!-- /.home-owl-carousel -->
                                    </div><!-- /.product-slider -->
                                </div>

                                <div class="tab-pane" id="books">
                                    <div class="product-slider">
                                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                                            <?php
$ret=mysqli_query($con,"select * from products where category=3");
while ($row=mysqli_fetch_array($ret)) 
{?>
                                            <div class="item item-carousel">
                                                <div class="products">
                                                    <div class="product">
                                                        <div class="product-image">
                                                            <div class="image">
                                                                <a
                                                                    href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
                                                                    <img src="<?php echo htmlentities($row['productImage1']);?>"
                                                                        width="180" height="300" alt=""></a>
                                                            </div>
                                                        </div>
                                                        <div class="product-info text-left">
                                                            <h3 class="name"><a
                                                                    href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a>
                                                            </h3>
                                                            <?php include('includes/rating.php');?>
                                                            <div class="description"></div>

                                                            <div class="product-price">
                                                                <span class="price">
                                                                    Rs. <?php echo htmlentities($row['productPrice']);?>
                                                                </span>
                                                                <span
                                                                    class="price-before-discount">Rs.<?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>

                                                            </div><!-- /.product-price -->

                                                        </div><!-- /.product-info -->
                                                        <?php if($row['productAvailability']=='In Stock'){?>
                                                        <div class="action"><a
                                                                href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                                                class="lnk btn btn-primary">Add to Cart</a></div>
                                                        <?php } else {?>
                                                        <div class="action" style="color:red">Out of Stock</div>
                                                        <?php } ?>
                                                    </div><!-- /.product -->

                                                </div><!-- /.products -->
                                            </div><!-- /.item -->
                                            <?php } ?>


                                        </div><!-- /.home-owl-carousel -->
                                    </div><!-- /.product-slider -->
                                </div>

                                <div class="tab-pane" id="furniture">
                                    <div class="product-slider">
                                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                                            <?php $ret=mysqli_query($con,"select * from products where category=5");
while ($row=mysqli_fetch_array($ret)) 
{
?>


                                            <div class="item item-carousel">
                                                <div class="products">

                                                    <div class="product">
                                                        <div class="product-image">
                                                            <div class="image">
                                                                <a
                                                                    href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
                                                                    <img src="<?php echo htmlentities($row['productImage1']);?>"
                                                                        width="180" height="300" alt=""></a>
                                                            </div>
                                                        </div>
                                                        <div class="product-info text-left">
                                                            <h3 class="name"><a
                                                                    href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a>
                                                            </h3>
                                                            <?php include('includes/rating.php');?>
                                                            <div class="description"></div>
                                                            <div class="product-price">
                                                                <span class="price">
                                                                    Rs.<?php echo htmlentities($row['productPrice']);?>
                                                                </span>
                                                                <span
                                                                    class="price-before-discount">Rs.<?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>
                                                            </div>
                                                        </div>
                                                        <?php if($row['productAvailability']=='In Stock'){?>
                                                        <div class="action"><a
                                                                href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                                                class="lnk btn btn-primary"><span><i
                                                                        class="glyphicon glyphicon-shopping-cart"></i></span></a>
                                                            <a class="btn btn-primary" data-toggle="tooltip"
                                                                data-placement="right" title="Wishlist"
                                                                href="product-details.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist">
                                                                <i class="fa fa-heart"></i>
                                                            </a>
                                                        </div>
                                                        <?php } else {?>
                                                        <div class="action" style="color:red">Out of Stock</div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================== TABS ============================================== -->
                        <div class="sections prod-slider-small outer-top-small">
                            <div class="row">
                                <div class="col-md-12">
                                    <section class="section">
                                        <h3 class="section-title">Smart Phones</h3>
                                        <div class="owl-carousel homepage-owl-carousel custom-carousel outer-top-xs owl-theme"
                                            data-item="3">

                                            <?php
$ret=mysqli_query($con,"select * from products where category=4 and subCategory=4");
while ($row=mysqli_fetch_array($ret)) {?>
                                            <div class="item item-carousel">
                                                <div class="products">

                                                    <div class="product">
                                                        <div class="product-image">
                                                            <div class="image">
                                                                <a
                                                                    href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><img
                                                                        src="<?php echo htmlentities($row['productImage1']);?>"
                                                                        width="180" height="300"></a>
                                                            </div><!-- /.image -->
                                                        </div><!-- /.product-image -->
                                                        <div class="product-info text-left">
                                                            <h3 class="name"><a
                                                                    href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a>
                                                            </h3>
                                                            <?php include('includes/rating.php');?>
                                                            <div class="description"></div>

                                                            <div class="product-price">
                                                                <span class="price">
                                                                    Rs. <?php echo htmlentities($row['productPrice']);?>
                                                                </span>
                                                                <span
                                                                    class="price-before-discount">Rs.<?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>
                                                            </div>
                                                        </div>
                                                        <?php if($row['productAvailability']=='In Stock'){?>
                                                        <div class="action">
                                                            <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                                                class="lnk btn btn-primary" style="margin-right: 30px">
                                                                <span><i
                                                                        class="glyphicon glyphicon-shopping-cart"></i></span>
                                                            </a>
                                                            <a class="btn btn-primary" data-toggle="tooltip"
                                                                data-placement="right" title="Wishlist"
                                                                href="product-details.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist">
                                                                <i class="fa fa-heart"></i>
                                                            </a>
                                                        </div>
                                                        <?php } else {?>
                                                        <div class="action" style="color:red">Out of Stock</div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php }?>


                                        </div>
                                    </section>
                                </div>
                                <div class="col-md-12">
                                    <section class="section">
                                        <h3 class="section-title">Laptops</h3>
                                        <div class="owl-carousel homepage-owl-carousel custom-carousel outer-top-xs owl-theme"
                                            data-item="3">
                                            <?php
$ret=mysqli_query($con,"select * from products where category=4 and subCategory=6");
while ($row=mysqli_fetch_array($ret)) 
{?>
                                            <div class="item item-carousel">
                                                <div class="products">
                                                    <div class="product">
                                                        <div class="product-image">
                                                            <div class="image">
                                                                <a
                                                                    href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><img
                                                                        src="<?php echo htmlentities($row['productImage1']);?>"
                                                                        width="250" height="250"></a>
                                                            </div><!-- /.image -->
                                                        </div><!-- /.product-image -->


                                                        <div class="product-info text-left">
                                                            <h3 class="name"><a
                                                                    href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a>
                                                            </h3>
                                                            <?php include('includes/rating.php');?>
                                                            <div class="description"></div>

                                                            <div class="product-price">
                                                                <span class="price">
                                                                    Rs .<?php echo htmlentities($row['productPrice']);?>
                                                                </span>
                                                                <span
                                                                    class="price-before-discount">Rs.<?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>

                                                            </div>

                                                        </div>
                                                        <?php if($row['productAvailability']=='In Stock'){?>
                                                        <div class="action">
                                                            <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                                                class="lnk btn btn-primary" style="margin-right: 30px">
                                                                <span><i
                                                                        class="glyphicon glyphicon-shopping-cart"></i></span>
                                                            </a>
                                                            <a class="btn btn-primary" data-toggle="tooltip"
                                                                data-placement="right" title="Wishlist"
                                                                href="product-details.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist">
                                                                <i class="fa fa-heart"></i>
                                                            </a>
                                                        </div>
                                                        <?php } else {?>
                                                        <div class="action" style="color:red">Out of Stock</div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php }?>
                                        </div>
                                    </section>

                                </div>
                            </div>
                        </div>
                        <!-- ============================================== TABS : END ============================================== -->

                        <section class="section featured-product inner-xs wow fadeInUp">
                            <h3 class="section-title">Fashion</h3>
                            <div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
                                <?php
$ret=mysqli_query($con,"select * from products where category=6");
while ($row=mysqli_fetch_array($ret)) 
{?>
                                <div class="item">
                                    <div class="products">
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-12">
                                                        <div class="product-image">
                                                            <div class="image">
                                                                <a href="<?php echo htmlentities($row['productImage1']);?>"
                                                                    data-lightbox="image-1"
                                                                    data-title="<?php echo htmlentities($row['productName']);?>"
                                                                        width="170" height="174" alt="">
                                                                    <div class="zoom-overlay"></div>
                                                                </a>
                                                            </div><!-- /.image -->
                                                        </div><!-- /.product-image -->
                                                    </div><!-- /.col -->
                                                    <div class="col col-xs-12">
                                                        <div class="product-info">
                                                            <h3 class="name"><a
                                                                    href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a>
                                                            </h3>
                                                            <?php include('includes/rating.php');?>
                                                            <div class="product-price">
                                                                <span class="price">
                                                                    Rs. <?php echo htmlentities($row['productPrice']);?>
                                                                </span>
                                                            </div><!-- /.product-price -->
                                                            <?php if($row['productAvailability']=='In Stock'){?>
                                                            <div class="action">
                                                                <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                                                    class="lnk btn btn-primary btn-lg"
                                                                    style="margin-right: 30px">
                                                                    <span><i
                                                                            class="glyphicon glyphicon-shopping-cart"></i></span>
                                                                </a>
                                                                <a class="btn btn-primary" data-toggle="tooltip"
                                                                    data-placement="right" title="Wishlist"
                                                                    href="product-details.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist">
                                                                    <i class="fa fa-heart"></i>
                                                                </a>
                                                            </div>
                                                            <?php } else {?>
                                                            <div class="action" style="color:red">Out of Stock</div>
                                                            <?php } ?>
                                                        </div>
                                                    </div><!-- /.col -->
                                                </div><!-- /.product-micro-row -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <?php include('includes/footer.php');?>

    </footer>

    <script src="assets/js/jquery-1.11.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>
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
                header('location:my-cart.php');
            }else{
                $message="Product ID is invalid";
            }
        }
    }
    $pid=intval($_GET['pid']);
    if(isset($_GET['pid']) && $_GET['action']=="wishlist" ){
        if(strlen($_SESSION['login'])==0){   
            header('location:login.php');
    }
    else
    {
    mysqli_query($con,"insert into wishlist(userId,productId) values('".$_SESSION['id']."','$pid')");
    echo "<script>alert('Product aaded in wishlist');</script>";
    header('location:my-wishlist.php');
    }
}
// if(isset($_POST['submit']))
// {
// 	$qty=$_POST['quality'];
// 	$price=$_POST['price'];
// 	$value=$_POST['value'];
// 	$name=$_POST['name'];
// 	$summary=$_POST['summary'];
// 	$review=$_POST['review'];
// 	mysqli_query($con,"insert into productreviews(productId,quality,price,value,name,summary,review) values('$pid','$qty','$price','$value','$name','$summary','$review')");
// }


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
    <title>Product Details</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/green.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css">
    <link href="assets/css/lightbox.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

    <link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="assets/images/favicon.ico">
</head>

<body class="cnt-home">

    <header class="header-style-1">
        <?php include('includes/top-header.php');?>
        <?php include('includes/main-header.php');?>
    </header>
    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row single-product outer-bottom-sm '>
                <div class='col-md-3 sidebar'>
                    <div class="sidebar-module-container">


                        <!-- ==============================================CATEGORY============================================== -->
                        <!-- <div class="sidebar-widget outer-bottom-xs wow fadeInUp">
                            <h3 class="section-title">Category</h3>
                            <div class="sidebar-widget-body m-t-10">
                                <div class="accordion">

                                    <?php $sql=mysqli_query($con,"select id,categoryName  from category");
while($row=mysqli_fetch_array($sql))
{
    ?>
                                    <div class="accordion-group">
                                        <div class="accordion-heading">
                                            <a href="category.php?cid=<?php echo $row['id'];?>"
                                                class="accordion-toggle collapsed">
                                                <?php echo $row['categoryName'];?>
                                            </a>
                                        </div>

                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div> -->
                        <?php include('includes/side-menu.php');?>
                    </div>
                </div>
                <?php 
$ret=mysqli_query($con,"select * from products where id='$pid'");
while($row=mysqli_fetch_array($ret)){?>
                <div class='col-md-9'>
                    <div class="row  wow fadeInUp">
                        <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                            <div class="product-item-holder size-big single-product-gallery small-gallery">
                                <div id="owl-single-product">
                                    <div class="single-product-gallery-item" id="slide1">
                                        <a data-title="<?php echo htmlentities($row['productName']);?>"
                                            href="<?php echo htmlentities($row['productImage1']);?>">
                                            <img class="img-responsive" alt=""
                                                src="<?php echo htmlentities($row['productImage1']);?>" width="370"
                                                height="350" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col-sm-6 col-md-7 product-info-block'>
                            <div class="product-info">
                                <h1 class="name"><?php echo htmlentities($row['productName']);?></h1>
                                <?php $rt=mysqli_query($con,"select * from productreviews where productId='$pid'");
$num=mysqli_num_rows($rt);
{?>
                                <div class="rating-reviews m-t-20">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <?php include('includes/rating.php');?>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="reviews">
                                                <a href="#" class="lnk">(<?php echo htmlentities($num);?> Reviews)</a>
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div><!-- /.rating-reviews -->
                                <?php } ?>
                                <div class="stock-container info-container m-t-10">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="stock-box">
                                                <span class="label">Availability :</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="stock-box">
                                                <span
                                                    class="value"><?php echo htmlentities($row['productAvailability']);?></span>
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div>

                                <div class="stock-container info-container m-t-10">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="stock-box">
                                                <span class="label">Product Brand :</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="stock-box">
                                                <span
                                                    class="value"><?php echo htmlentities($row['productCompany']);?></span>
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div>


                                <div class="stock-container info-container m-t-10">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="stock-box">
                                                <span class="label">Shipping Charge :</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="stock-box">
                                                <span class="value"><?php if($row['shippingCharge']==0)
											{
												echo "Free";
											}
											else
											{
												echo htmlentities($row['shippingCharge']);
											}

											?></span>
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div>

                                <div class="price-container info-container m-t-20">
                                    <div class="row">


                                        <div class="col-sm-6">
                                            <div class="price-box">
                                                <span class="price">Rs.
                                                    <?php echo htmlentities($row['productPrice']);?></span>
                                                <span
                                                    class="price-strike">Rs.<?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="favorite-button m-t-10">
                                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
                                                    title="Wishlist"
                                                    href="product-details.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist">
                                                    <i class="fa fa-heart"></i>
                                                </a>

                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="quantity-container info-container">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <?php if($row['productAvailability']=='In Stock'){?>
                                            <a href="product-details.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                                class="btn btn-primary"><i
                                                    class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</a>
                                            <?php } else {?>
                                            <div class="action" style="color:red">Out of Stock</div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                        <div class="row">
                            <div class="col-md-5 col-sm-12">  
                            </div>
                            <div class="col-md-7 col-sm-12">
                                <h3 style="border-bottom: 2px solid #666; width: 35%; margin-bottom: 30px">DESCRIPTION</h3>
                                <p><?php echo $row['productDescription'];?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $cid=$row['category'];
			$subcid=$row['subCategory']; } ?>
            <!-- ============================================== UPSELL PRODUCTS ============================================== -->
            <section class="section featured-product wow fadeInUp">
                <h3 class="section-title">Realted Products </h3>
                <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">

                    <?php 
$qry=mysqli_query($con,"select * from products where subCategory='$subcid' and category='$cid'");
while($rw=mysqli_fetch_array($qry))
{

			?>


                    <div class="item item-carousel">
                        <div class="products">
                            <div class="product">
                                <div class="product-image">
                                    <div class="image">
                                        <a href="product-details.php?pid=<?php echo htmlentities($rw['id']);?>"><img
                                                src="<?php echo htmlentities($rw['productImage1']);?>" width="150"
                                                height="240" alt=""></a>
                                    </div><!-- /.image -->
                                </div><!-- /.product-image -->
                                <div class="product-info text-left">
                                    <h3 class="name"><a
                                            href="product-details.php?pid=<?php echo htmlentities($rw['id']);?>"><?php echo htmlentities($rw['productName']);?></a>
                                    </h3>
                                    <?php include('includes/rating.php');?>
                                    <div class="description"></div>

                                    <div class="product-price">
                                        <span class="price">
                                            Rs.<?php echo htmlentities($rw['productPrice']);?> </span>
                                        <span class="price-before-discount">Rs.
                                            <?php echo htmlentities($rw['productPriceBeforeDiscount']);?></span>

                                    </div><!-- /.product-price -->

                                </div><!-- /.product-info -->
                                <div class="cart clearfix animate-effect">
                                    <div class="action">
                                        <ul class="list-unstyled">
                                            <li class="add-cart-button btn-group">
                                                <button class="btn btn-primary icon" data-toggle="dropdown"
                                                    type="button">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </button>
                                                <a href="product-details.php?page=product&action=add&id=<?php echo $rw['id']; ?>"
                                                    class="lnk btn btn-primary">Add to cart</a>
                                            </li>
                                        </ul>
                                    </div><!-- /.action -->
                                </div><!-- /.cart -->
                            </div><!-- /.product -->

                        </div><!-- /.products -->
                    </div><!-- /.item -->
                    <?php } ?>


                </div><!-- /.home-owl-carousel -->
            </section><!-- /.section -->


            <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->

        </div><!-- /.col -->
        <div class="clearfix"></div>
    </div>
    <?php include('includes/brands-slider.php');?>
    </div>
    </div>
    <?php include('includes/footer.php');?>

    <script src="assets/js/jquery-1.11.1.min.js"></script>

    <script src="assets/js/bootstrap.min.js"></script>

    <script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>

    <script src="assets/js/echo.min.js"></script>
    <script src="assets/js/jquery.easing-1.3.min.js"></script>
    <script src="assets/js/bootstrap-slider.min.js"></script>
    <script src="assets/js/jquery.rateit.min.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>
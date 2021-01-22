<?php 
 if(isset($_Get['action'])){
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
?>
<div class="main-header" style="background-color: currentColor">
    <div class="container">
        <div class="row" >
            <div class="col-xs-12 col-sm-12 col-md-3 logo-holder" style="margin-top: 0px">
                <div class="logo">
                    <a href="index.php">
                        <h2 style="margin-top: 15px">Atec Mart</h2>
                    </a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5 ">
                <div class="yamm navbar" role="navigation" style="margin-top:5px">
                    <div class="navbar-header">
                        <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse"
                            class="navbar-toggle collapsed"  type="button">
                            <span class="sr-only" >Toggle navigation</span>
                            <span class="icon-bar" style="background-color: white" ></span>
                            <span class="icon-bar" style="background-color: white" ></span>
                            <span class="icon-bar" style="background-color: white" ></span>
                        </button>
                    </div>
                    <div class="nav-bg-class">
                        <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                            <div class="nav-outer">
                                <ul class="nav navbar-nav">
                                    <li class=" dropdown  ">
                                        <a href="index.php" data-hover="dropdown" id="menu-link" class="nav-links dropdown-toggle">Home</a>
                                    </li>
                                    <li class=" dropdown ">
                                        <a href="about.php" data-hover="dropdown" class="dropdown-toggle">About Us</a>
                                    </li>                            
                                    <li class=" dropdown ">
                                        <a href="contact.php" data-hover="dropdown" class="dropdown-toggle">Contact US</a>
                                    </li>                            
                                    <li class=" dropdown ">
                                        <a href="privacy.php" data-hover="dropdown" class="dropdown-toggle">Privacy Policy</a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 top-search-holder">
                <div class="search-area" style="border-radius: 5px; border: 1px solid seagreen;">
                    <form name="search" method="post" action="search-result.php">
                        <div class="control-group" style="position: relative">
                            <input class="search-field" style="width: 100%; border-radius: 5px" placeholder="Search here..." name="product"
                                required="required"/>
                            <button class="btn btn-primary" style="height: 100%; position: absolute; right: 0px; top: 0px;" type="submit" name="search"><span><i class="fa fa-search fa-2"></i></span></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-1 animate-dropdown top-cart-row">
                <?php
if(!empty($_SESSION['cart'])){
	?>
                <div class="dropdown dropdown-cart">
                    <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                        <div class="items-cart-inner">
                            <div class="basket">
                                <i class="glyphicon glyphicon-shopping-cart"></i>
                            </div>
                            <div class="basket-item-count"><span class="count"><?php echo $_SESSION['qnty'];?></span>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu">
                        <?php
    $sql = "SELECT * FROM products WHERE id IN(";
			foreach($_SESSION['cart'] as $id => $value){
			$sql .=$id. ",";
			}
			$sql=substr($sql,0,-1) . ") ORDER BY id ASC";
			$query = mysqli_query($con,$sql);
			$totalprice=0;
			$totalqunty=0;
			if(!empty($query)){
			while($row = mysqli_fetch_array($query)){
				$quantity=$_SESSION['cart'][$row['id']]['quantity'];
				$subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge'];
				$totalprice += $subtotal;
				$_SESSION['qnty']=$totalqunty+=$quantity;?>
                        <li>
                            <div class="cart-item product-summary">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h3 class="name"><a
                                                href="product-details.php?pid=<?php echo $row['id'];?>"><?php echo $row['productName']; ?></a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <?php } }?>
                            <hr>
                        </li>
                    </ul>
                </div>
                <?php } else { ?>
                <div class="dropdown dropdown-cart">
                    <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                        <div class="items-cart-inner">
                            <div class="basket" style="border-radius: 5px">
                                <i class="glyphicon glyphicon-shopping-cart"></i>
                            </div>
                            <div class="basket-item-count"><span class="count">0</span></div>

                        </div>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="cart-item product-summary">
                                <div class="row">
                                    <div class="col-xs-12">
                                        Your Shopping Cart is Empty.
                                    </div>
                                </div>
                            </div>
                            <!-- <hr>
                            <div class="clearfix cart-total">

                                <div class="clearfix"></div>

                                <a href="index.php" class="btn btn-upper btn-primary btn-block m-t-20">Continue
                                    Shopping</a>
                            </div> -->
                        </li>
                    </ul>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>
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

<style>
.nav-link:hover{
    color: red;
}
</style>
<?php include('includes/top-bar.php');?>
<div class="main-header" style="background-color: #f44336">
    <div class="container">
        <div class="row" >
            <div class="col-xs-12 col-sm-12 col-md-4 logo-holder" style="margin-top: 0px; color: white">
                <div class="logo">
                    <a href="index.php">
                        <h2 style="margin-top: 15px; color: white">Atec Mart</h2>
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
                                <ul class="nav navbar-nav" >
                                    <li class=" dropdown  ">
                                        <a href="index.php" data-hover="dropdown" class="nav-links dropdown-toggle" style="color: white">Home</a>
                                    </li>
                                    <li class=" dropdown ">
                                        <a href="about.php" data-hover="dropdown" class="nav-links dropdown-toggle" style="color: white">About Us</a>
                                    </li>                            
                                    <li class=" dropdown ">
                                        <a href="contact.php" data-hover="dropdown" class="nav-links dropdown-toggle" style="color: white">Contact Us</a>
                                    </li>                            
                                    <li class=" dropdown ">
                                        <a href="privacy.php" data-hover="dropdown" class="nav-links dropdown-toggle" style="color: white">Privacy Policy</a>
                                    </li>
                                </ul>
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
        </div>
    </div>
</div>
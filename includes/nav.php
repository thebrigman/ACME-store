<?php
    
  
?>
<?php 
  // if(isGranted() && isset($_COOKIE['name'])){
  //   echo '<div class="bg-warning rounded m-1" style="width: 90px;" id="cookie"><p class="m-1">Hello '.ucfirst($_COOKIE['name']).'!</p></div>';
  // }
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<link rel="stylesheet" href="css/styles.css">
 
<nav class="navbar nav-tabs navbar-dark bg-info">
<div class="container-fluid">
    
    <ul class ="nav">
        <?php echo (isGranted() ? '<div class=" rounded pt-1 m-1" style="background-color: #FFFAF0; color: black;" id="cookie"><img src="includes/user.png" style="width: 25px;" title="user icons"></img> Hello '.ucfirst($_COOKIE['name']).'!</div>':"");?>
        <li class="nav-item rounded"><a class="nav-link" href=".">Home</a></li>
        <!-- <li class="nav-item"><a class="nav-link active" href="product.php">Products</a></li> -->
        <li class="nav-item rounded"><a class="nav-link" href="catalog.php">Catalog</a></li>
        <?php echo (isGranted() ? '<li class="nav-item rounded"><a class="nav-link" href="cart.php">View Cart</a></li>  <li class="nav-item rounded"><a class="nav-link" href="logout.php">Log Out</a></li>' : ' <li class="nav-item rounded"><a class="nav-link" href=".">Log In</a></li><li class="nav-item rounded"><a class="nav-link" href="create-account.php">Create Account</a></li>'); ?> 
        
    </ul>
    
    </div>
    
</nav>
<div class=" container rounded" style=" width: 250px"><h2>The ACME store</h2><img  class="" src="img/Road_Runner.png" id="road2"></img></div>
<!-- <p class="text-success">"We offer the best prices on ACME products to help you catch your roadrunner!"</p>  -->




<!-- <nav>

    
    <ul>
        
        <li><a href=".">Home</a></li>
        
       
        <li><a href="product.php">Products</a></li>
        <li><a href="catalog.php">Catalog</a></li>
        <?php //echo (isGranted() ? '<li><a href="cart.php">View Cart</a></li>  <li><a href="logout.php">Log Out</a></li>' : ' <li><a href=".">Log In</a></li><li><a href="create-account.php">Create Account</a></li>'); ?> 

    </ul>
</nav> -->
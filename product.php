<?php
    session_start();
    unset($_SESSION['dups']);
    include('includes/server.php');
    include('includes/functions.php');
    

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title>Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/styles.css" /> 
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<center>
<?php
    include("includes/nav.php");

    
    if(!isset($_GET['id'])){
        $user = isset($_COOKIE['name']) ? ', '.ucfirst($_COOKIE['name']) : '';
        echo '<h1 class="mt-5">Hello'.$user.'</h1>';
        echo '</h1><a href="catalog.php"><button class="btn btn-warning"><h4>Please add products here</h4></button></a>';


    }elseif(isset($_GET['id']) && !empty($_GET['id'])){
            
            
            
            $sql = 'SELECT * FROM PRODUCT WHERE ID = '.$_GET["id"];
            $results = mysqli_query($conn, $sql);
            
            while($row = mysqli_fetch_array($results, MYSQLI_ASSOC)){
                $id = $row['ID'];
                $name = $row['NAME'];
                $description = $row['DESCRIPTION'];
                $price = $row['PRICE'];
                $img = $row['IMAGE'];  
            }
            if(!isset($_POST['add-to-cart'])){
                echo '<div class="container rounded bg-info shadow-lg p-4 m-5" style="width: 700px;" ><div><center>';
                echo '<div class="mb-5" ><img class="shadow-sm rounded" id="product-img" src="'.$img.'" alt=""></div></center>';
                echo '<H1 class="text">'.$name.'</H1><br>';
                echo '<div class="container rounded" style=""><h4 class="text">'.$description.'</h4></div><br><br>';
                echo '<h5><mark class="rounded">Price:   $'.$price.'</mark></h5><br>';
                
                
                echo '<form  method="post">';
                echo '<div class="input-group"><input type="hidden" name="id" value="'.$_GET['id'].'">';
                echo '<input type="number" min="1" name="qty" placeholder="Quantity" style="width: 100px">';
                echo '<input class="btn btn-warning" type="submit" value="Add to cart" name="add-to-cart"></div>';
                echo '</form></div>';
            }
        }
        
  
        
        
    if(isset($_POST['add-to-cart'])){
    
        if(isset($_SESSION['GRANTED'])){

            if(!isset($_SESSION['id'])){
            
                $_SESSION['id'] = array();
                $_SESSION['qty'] = array();
                $_SESSION['price'] = array();
                $_SESSION['name'] = array();
    
            }
    
            $totalQty = 0;
            
            
            
                for($i = 0; $i < sizeof($_SESSION['id']); $i++){
    
                    if($_POST['id'] === $_SESSION['id'][$i]){
                        
    
                        $postId = intval($_POST['id']);
    
    
                        $totalQty = (int)$_POST['qty'] + (int)$_SESSION['qty'][$i];
    
                        $_SESSION['qty'][$i] = strval($totalQty);
    
                        $_SESSION['dups'] = true;
                        
                    }
                }
    
                if(!isset($_SESSION['dups'])){
                    array_push($_SESSION['name'], $name);
                    array_push($_SESSION['id'], $_POST['id']);
                    array_push($_SESSION['qty'], $_POST['qty']);
                    array_push($_SESSION['price'], $price);
                }
                

                
                
                
                echo '<div class="container shadow-lg rounded p-4 m-5" style=" color: white; background-color: #6AAB8E; width: 700px;"  width: 400px;"><h1 class="text-light">Your items have been added!</h1><br>';
                echo '<a href="cart.php"><button class="btn bg-warning" style="backgroud-color: #6AAB8E;" >Click here to view cart</button></a><br>';
                echo '<a href="catalog.php"><button class="btn btn-warning m-5">Click here to view products</button></a></div>';
        }else{
            echo '<div class="container shadow-lg rounded p-4 m-5" style=" color: white; background-color: #6AAB8E; width: 700px;""><h3 class="text-danger">You must be logged in to add to cart</h3><br>';
                echo '<a href="."><button class="btn bg-warning" style="backgroud-color: #6AAB8E;" >Click here to login</button></a></div>';
            
        }
        
        
            


           
            
    };


?>
</center>
</body>
</html>
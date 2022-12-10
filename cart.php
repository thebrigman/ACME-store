<?php
    session_start();
    include('includes/server.php');
    include('includes/functions.php');
    
    unset($_SESSION["place-order"]);
    


function getInputQuantity($x, $i){
    $returnV = '<form method="post" name="form"><input type="text" value="'.$x.'" name="qty-'.$i.'">';
    $returnV .= '<input type="submit" value="submit"></form>';

    return $returnV;
}

if(isset($_SESSION['id'])){
    for($i = 0; $i < sizeof($_SESSION['id']); $i++){
        if(isset($_POST["update-$i"])){
        
        
 
            
            $_SESSION['qty'][$i] = $_POST["qty-$i"];

            header("location: ./cart.php");
        }
    
    }
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    

</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<center>
    <?php
    include("includes/nav.php");

        if(isset($_GET['clear']) && $_GET['clear'] == true){
            unset($_SESSION['id']);
            unset($_SESSION['name']);
            unset($_SESSION['price']);
            unset($_SESSION['qty']);
      
        }
        if($_SESSION['GRANTED'] && isset($_SESSION['id']) && isset($_POST['place-order'])){
            echo '<div class="container shadow-lg rounded p-4 m-5" style=" color: white; background-color: #6AAB8E; width: 700px;"><h1>Thank you, '.ucfirst($_COOKIE['name']).'</h1></br><h3>Your order has been placed!</h3></div><br><br>';
            echo '<div class=""container shadow-lg rounded" style="width: 700px;">';
            echo '<div class="row border border bg-info">';
            echo '<div class="col"><h3>Product</h3></div>';
            echo '<div class="col"><h3>Quantity</h3></div></div>';
            
            for($i = 0; $i < sizeof($_SESSION['id']); $i++){
                echo '<div class="row border border bg-light">';
                echo '<div class="col"><h5>'.$_SESSION['name'][$i].'</h5></div>';
                echo '<div class="col"><h5>'.$_SESSION['qty'][$i].'</h5></div></div>';
            }
            echo '<a href="catalog.php"><button class="btn btn-warning m-5">Click here to view products</button></a></div></br>';

            unset($_SESSION['id']);
            unset($_SESSION['name']);
            unset($_SESSION['price']);
            unset($_SESSION['qty']);
            $_SESSION['place-order'] = true;

        }
        ;
    
        if($_SESSION['GRANTED'] && isset($_SESSION['id']) && !empty($_SESSION['id'])){


            
            
            
            
            for($i = 0; $i < sizeof($_SESSION['id']); $i++){
                if($_SESSION['qty'][$i] == "0"){



                    array_splice($_SESSION['id'], $i, 1);
                    
                    array_splice($_SESSION['qty'], $i, 1);
                    array_splice($_SESSION['price'], $i, 1);
                    array_splice($_SESSION['name'], $i, 1);

                    
                    
                
                }

            }

            
            $total = 0;
            $grandTotal = 0;

            
            $grid =  '<div class="container mt-5"><h1>Your shopping Cart</h1></div>';
            $grid .= '<div class="container mt-5" style="background-color: #FFFAF0">';
            $grid .=  '<div class="row border border  bg-info text-light rounded">';
            $grid .=  '<div class="col"><h4 class= "m-4">Name</h4></div>';
            $grid .=  '<div class="col"><h4 class= "m-4">Price</h4></div>';
            $grid .=  '<div class="col"><h4 class= "m-4">Total Price</h4></div>';
            $grid .=  '<div class="col"><h4 class= "m-4">Adjust Quantity</h4></div>';
            $grid .=  '</div>';
            
            $tableGuts = "";
            $tableClose = '</div>';
            $count = count($_SESSION['id']);
            for($i = 0; $i < $count; $i++){
                

                    
                
                $total = (int)$_SESSION['qty'][$i] * (int)$_SESSION['price'][$i];
                $tableGuts .= '<div class="row border border rounded" >';
                $tableGuts .= '<div class="col" ><h5 class= "m-4">'.$_SESSION['name'][$i].'</h5></div>';
                $tableGuts .= '<div class="col" ><h5 class= "m-4">$'.$_SESSION['price'][$i].'</h5></div>';
                $tableGuts .= '<div class="col" ><h5 class= "m-4">$'.$total.'</h5></div>';
                $tableGuts .= '<div class="col-3" ><div class="input-group"><form method="post" name="form">';
                $tableGuts .= '<input class="m-3"type="number" min="0" style="width: 30%;" value="'.$_SESSION['qty'][$i].'" name="qty-'.$i.'">';
                $tableGuts .= '<input class="btn btn-warning m-3" type="submit" name="update-'.$i.'" value="Update cart"></form></div></div></div>';
                 

                $grandTotal += (int)$_SESSION['price'][$i] * (int)$_SESSION['qty'][$i];

                
                
            }
                
            

            $tableGuts .= '<div class="row border-2 bg-info rounded">';
            $tableGuts .= '<div class="col bg-white" ></div>';
            $tableGuts .= '<div class="col-3"><h5 class="m-4"><mark class="rounded ">Grand Total:  $'.$grandTotal.'</mark></h5></div>';
            $tableGuts .= '<div class="col-3"><form method="post"><input class="btn btn-warning m-3" type="submit" name="place-order" value="place order"></form></div></div>';
             
            $table = $grid.$tableGuts.$tableClose;
            echo $table;
           

            
        }elseif(!isset($_SESSION['GRANTED'])){
            echo '<a href="."><button class="btn mt-5" style="background-color: #FF6461;"><h1>Please login here</h1></button></a>';
        }elseif((!isset($_SESSION['id']) || empty($_SESSION['id'])) && !isset($_SESSION['place-order'])){
            echo '<div class="container shadow-lg rounded mt-5" style="background-color: #6AAB8E; width: 400px;"><h2 class="pt-5"><i>'.ucfirst($_COOKIE['name']).', </i>your cart is empty</h2><br><br>';
                echo '<a href="catalog.php"><button class="btn btn-warning mb-5">Click here to view products</button></a></div></br>';
        }
        
        
    ?>
    </center>
</body>
</html>
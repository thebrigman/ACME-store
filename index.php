<?php
    session_start();
   
    include("includes/server.php");
    include("includes/functions.php");

    $conn = connectToDB();
    $sql = 'SELECT * FROM USERS;';
    $results = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC))
    {
        $id[] = $row['ID'];
        $userName[] = $row['USERNAME'];
        $psswd[] = $row['PASSWORD'];
    };

    $user = "";
    $pass = "";

   
   

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    
</head>
<body>

    <center>
    <?php
    
        if(isset($_POST["username"]) && isset($_POST["password"])){
            
            $user = trim(strtolower($_POST["username"]));
            $pass = hashPass($_POST["password"]);
            
            $sql = "SELECT * FROM USERS WHERE USERNAME = '".$user."' and PASSWORD = '".$pass."' ";
            $conn = connectToDB();
            $results = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($results);
            
    
            if( $count > 0){
                    
                
                $_COOKIE['name'] = $user;
                    
                $_SESSION['GRANTED'] = true;
                setcookie('name', $user, time() +3600);
                    
                   
                
                if(isset($_SESSION['GRANTED'])){
                    include("includes/nav.php");
                    echo '<div class="container shadow-lg rounded mt-5" style="background-color: #6AAB8E; width: 400px;"><h2 class="pt-5">Welcome <i>'.ucfirst($user).'</i>!</h2><br><br>';
                    echo '<a href="catalog.php"><button class="btn btn-warning mb-5">Click here to view products</button></a></div></br>';
                    
                }
    
                }else{
                    include("includes/nav.php");
                    $returnV = '<div class="container shadow-lg rounded mt-5 pb-3" style="background-color: #6AAB8E; width: 500px;"><h3 class="pt-3 text-danger">Invalid username and/or password</h3><br><h4>Please try again or <a href="create-account.php">create a new account</a></h4></div><br>';
                    $returnV .= getHomeForm();
                    echo $returnV;
                }
            

        }elseif(!isset($_SESSION['GRANTED'])){
            include("includes/nav.php");
            
            echo '<div class="container rounded bg-grey class="mt-5""><center><h1 class="mt-5" id="welcome">Welcome to the store</h1><br><h5 class="text-success">"We offer the best prices on ACME products to help you catch your roadrunner!"</h5></center></div><br>';
            echo getHomeForm();
            
            
        }elseif(isset($_COOKIE['name'])){
            include("includes/nav.php");
            $sql = 'SELECT * FROM PRODUCT';
            $results = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($results, MYSQLI_ASSOC)){
                $name = $row['NAME'];

            }
                echo '<div class="container shadow-lg rounded mt-5" style="background-color: #6AAB8E; width: 400px;"><h2 class="pt-5">Welcome <i>'.ucfirst($_COOKIE['name']).'</i>!</h2><br><br>';
                echo '<a href="catalog.php"><button class="btn btn-warning mb-5">Click here to view products</button></a></div></br>';

            
        }else{
            include("includes/nav.php");
            echo getHomeForm();
        }   
    ?>
    </center>
</body>
</html>
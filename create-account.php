
    <?php
    include('includes/server.php');
    include('includes/functions.php');
    
    $user = "";
    $password = "";
    $passwordCheck = "";
    
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title>Create account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/styles.css" type="text/css"> -->
    <script defer src="js/script.js"></script>
    
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <center>
<div id="navbar">
    <?php
        include('includes/nav.php');
        
        if(isset($_POST['submit'])){
            $user = isset($_POST["usr"]) ? strtolower($_POST["usr"]) : false;
            $password = isset($_POST["psswd"]) ? $_POST["psswd"] : false;
            $passwordCheck = isset($_POST["check-psswd"]) ? $_POST["check-psswd"] : false;
            

            if(($password === $passwordCheck)){
                
                if(mysqli_num_rows(checkDuplicate($user))){
                    
                    echo getCreateAccountForm($user, $password, $passwordCheck);
                    echo  '<div class="container shadow-lg rounded mt-5 p-3" style="background-color: #6AAB8E; width: 600px;"><h2 class="text-danger">The username <i class="text-light">'.$user.'</i> already exists.<br>Please enter a new username.</h2></div>';
                    
                
                }else{      
                    $password = hashPass ($password);
                    echo createAccount($user, $password);
                    
                    
                }
                
            }elseif(($password != $passwordCheck) && mysqli_num_rows(checkDuplicate($user))){
                echo getCreateAccountForm($user, $password, $passwordCheck);
                echo  '<div class="alert"><h2>This username already exists.<br>Please enter a new username.</h2></div>';
                echo '<div class="alert"><h2>Passwords do not match.<br>Please check your password.</h2></div>';
            }else{
                echo getCreateAccountForm($user, $password, $passwordCheck);
                echo '<div class="alert"><h2>Passwords do not match.<br>Please check your password.</h2></div>';
            }
        }else{
            
            echo getCreateAccountForm($user, $password, $passwordCheck);
        }
    
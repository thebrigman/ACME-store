<?php
            function dump($y, $x){
                echo '<pre>';
                echo $y.": ";
                var_dump($x);
                echo '</pre>';
            }

            function removeItem($id, $qty, $price, $name){
                for($i = 0; $i < $count; $i++){
                    if($qty[$i] == "0"){
    
                        
                        $returnV = array_splice($id, $i, 1);
                        $returnV .= array_splice($qty, $i, 1);
                        $returnV .= array_splice($price, $i, 1);
                        $returnV .= array_splice($name, $i, 1);
                        return $returnV;
                    }
                }
            }
            
            function isGranted()
            {
                if(isset($_SESSION['GRANTED'])) return true;
                
                return false;
            }
            
            function checkDuplicate($user){
                $conn = connectToDB();
                $sql = "SELECT * FROM USERS WHERE USERNAME = '".$user."'";
                $results = mysqli_query($conn, $sql);
                return $results;
            }

            function getCreateAccountForm($user, $password, $passwordCheck){
                $returnV = '<div class="mt-5"><h2 class="mt-5">Choose a username and password</h2></div><div class="container bg-info pb-3 mt-5 rounded shadow-lg pt-5" style="width: 500px"><form id="form-create" action="" method="post">';
                $returnV .= '<input class="form-control" style="width: 400px" type="text" name="usr" placeholder="Username" value="'. $user.'" required><br>';

                $returnV .= '<input class="form-control" style="width: 400px" type="password" id="create-password" name="psswd" placeholder="Password" value="'.$password.'" required><br>';
                $returnV .= '<p id="pin" style="color: red;"></p>';
                $returnV .= '<p id="number" style="color: red;"></p>';
                $returnV .= '<input class="form-control" style="width: 400px" type="password" id="check-psswd" name="check-psswd" placeholder="Verify Password" value="'.$passwordCheck.'" required><br>';
                $returnV .= '<p id="verify" style="color: red;"></p>';
                $returnV .= '<input class="form-control btn btn-warning m-1" style="width: 200px" id="create-button" type="submit" name="submit" value="Create Account" disabled>  ';
                $returnV .= '<input class="form-control btn btn-warning m-1" style="width: 200px" type="reset" value="Reset">';
                //$returnV .= '<p class="bg-danger" id="pin"></p>';
                //$returnV .= '<p id="number"></p>';
                //$returnV .= '<p id="verify"></p>';
                $returnV .= '</form></div>';
                return $returnV;
            }

            function createAccount($user, $password){
        
                $conn = connectToDB();
                $sql = 'INSERT INTO USERS (USERNAME, PASSWORD) values ("'.$user.'", "'.$password.'");';
                $results = mysqli_query($conn, $sql);
                $returnV = '<div class="container shadow-lg rounded mt-5 pt-5" style="background-color: #6AAB8E; width: 600px;"><h2 class="text-light">Thanks '.ucfirst($user).'!<br> Your account has been created.</h2><br><a href="."><button class="btn btn-warning mb-5">Click here to login</button></a></div></br>';
                return $returnV;
            }

            function connectToDB()
            {
                $conn = mysqli_connect(HOST,USER,PASS,DB);
                return $conn;
            }


            function hashPass ($word){
                $salt1 = 'tuorvn999epvoiefjwj';
                $salt2 = '8r9fnufjijdsacnn';
                $word = $salt1.$word.$salt2;
                $word = hash('sha512', $word);
                return $word;
                }

                function checkLoginDB($user, $pass){
                    
                    
                    
                    $sql = "SELECT * FROM USERS WHERE USERNAME = '".$user."' and PASSWORD = '".$pass."' ";
                    $conn = connectToDB();
                    $results = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($results);
                    
            
                    if( $count > 0){
                        
                            
                            
                            return '<div class="login"><h2>Welcome <i>'.$user.'</i>!';
                            
            
                        }else{
                            $returnV = '<h1 id="denied">ACCESS DENIED!</h1><br>';
                            $returnV .= getHomeForm();
                            return $returnV;
                        }
                    
                }

                
        function getHomeForm (){
            $returnForm ='<div class="container bg-info  rounded shadow-lg" style="width: 500px"><div class="container p-3 "><h2>Login</h2></div><form action="" method="post">';
            $returnForm .='<input class="form-control mt-3" style="width: 400px" type="text" name="username" placeholder="username"required><br><br>';
            $returnForm .='<input class="form-control" style="width: 400px" type="password" name="password" placeholder="password"required><br>';
            $returnForm .='<input class="form-control btn btn-warning" style="width: 200px" data-bs-toggle="button" autocomplete="off" type="submit" value="Submit">';
            $returnForm .='<span> <input class="form-control btn btn-warning m-1" style="width: 200px" data-bs-toggle="button" autocomplete="off" type="reset"> </span>';
            $returnForm .='</form><p class="m-2">Not a member? </p ><span class="m-1"><a class= "" href="create-account.php"><button class="btn btn-warning mb-4">Create Account</button></a></span></div>';
            return $returnForm;
        }
?>
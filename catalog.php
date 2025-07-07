<?php


    session_start();
    include('includes/server.php');
    include('includes/functions.php');
    $sql = 'SELECT * FROM PRODUCT';
    $results = mysqli_query($conn, $sql);
    $gridTop = '<div class="container p-5 m-5"><h1 class="text-success">"The best prices around!"</h1></div>';
    $gridTop .= '<div class="container rounded shadow mt-5" style="background-color: #FFFAF0;">';
    $gridTop .= '<div class="row border border p-3 bg-info rounded">';
    $gridTop .=  '<div class="col cat"><h4>Image</h4></div>';
    $gridTop .=  '<div class="col cat"><h4>Product Name</h4></div>';
    $gridTop .=  '<div class="col cat"><h4>Price</h4></div>';
    $gridTop .=  '<div class="col cat"><h4>   Product Details</h4></div>';
    $gridTop .=   '</div>';
    
    
    $tableGuts = '';
    while($row = mysqli_fetch_array($results, MYSQLI_ASSOC)){
        $id = $row['ID'];
        $tableGuts .= '<div class="row border border">';
        $tableGuts .= '<div class="col"> <img style="max-width: 70%; height: auto" src="'.$row['IMAGE'].'" alt=""> </div>';
        $tableGuts .= '<div class="col"><h5 class="m-5">'.$row['NAME'].'</h5></div>';
        $tableGuts .= '<div class="col"><h5 class="mt-5">$'.$row['PRICE'].'</h5></div>';
        $tableGuts .= '<div class="col"> <a href="product.php?id='.$id.'"><button class="btn btn-warning pt-4 pb-4 mt-4">View Product Details</button></a> </div>';
        $tableGuts .= '</div>';
    }
    
    $tableClose = '</div>';
    $table = $gridTop.$tableGuts.$tableClose;
   


?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title>Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/styles.css" /> 
</head>
<body>

<center>
<?php
    include('includes/nav.php');
    echo $table;
?>
</center>
</body>
</html>
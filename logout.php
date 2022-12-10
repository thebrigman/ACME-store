<?php
    session_start();
    session_destroy();
    setcookie('name', '', time()-3600);
    $_SESSION['PRODUCT'] = "";
    header('location: .');
    
?>
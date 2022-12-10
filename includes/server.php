<?php
    if ($_SERVER['HTTP_HOST'] == 'localhost')
    {
        define('HOST', 'localhost');
        define('USER', 'root');
        define('PASS', '1550');
        define('DB', 'FINAL');
    }
    else
    {
        define('HOST', 'sql300.byethost12.com');
        define('USER', 'b12_31766294');
        define('PASS', 'TkXsCplhJ9mBRDu8SscY');
        define('DB', 'b12_31766294_FINAL');
    }

    $conn = mysqli_connect(HOST,USER,PASS,DB);
?>
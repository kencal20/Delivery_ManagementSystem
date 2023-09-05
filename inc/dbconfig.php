<?php
    //Database Connection Details
    define('HOST','localhost');
    define('USERNAME','root');
    define('PASSWORD','');
    define('DB_NAME','ManagementSystem');

    $con = new mysqli(HOST, USERNAME, PASSWORD, DB_NAME);

    if($con->connect_error)
    {
        die('Unable to connect');
    }
    else
    {
       // echo 'Connected Successfully';
    }


?>
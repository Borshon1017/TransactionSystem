<?php

function dbConnection(){

    $conn = mysqli_connect('localhost', 'root', '', 'transaction');
    return $conn;
    
}

?>

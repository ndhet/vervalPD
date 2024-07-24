<?php

    $mysqli = new mysqli('localhost', 'root', 'Samsung@@##123', 'vervalpd');
    if (!$mysqli) {
        die('MySQL Not Connected !' . mysqli_connect_error());
    }
    
?>
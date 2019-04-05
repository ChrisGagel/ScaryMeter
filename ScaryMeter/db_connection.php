<?php

    $servername = "localhost";
    $username = "root";
    $password = "ScaryMeter123";
    $dbname = "scarymeter";
    $port = 8889;

    // Create connection
    $conn = new mysqli("$servername:$port", $username, $password, $dbname);

    // Check connectionrtrim($string, '.');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>
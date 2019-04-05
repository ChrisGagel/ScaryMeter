<?php

    $servername = "localhost";
    $username = "root";
    $password = "ScaryMeter123";
    $dbname = "scarymeter";
    $port = 8889;

    // Create connection
    $conn = new mysqli("$servername:$port", $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }







    $movieReleaseDate = $_POST["releasedateAJAX"];
    $movieIdPHP = $_POST["movieidAJAX"];



    $allmoviestableupdatesqldates = "UPDATE allmovies_ratings SET release_date = '" . $movieReleaseDate . "' WHERE movie_id = " . $movieIdPHP . ";";

    if ($conn->query($allmoviestableupdatesqldates) === TRUE) {

    } else {

    }


?>
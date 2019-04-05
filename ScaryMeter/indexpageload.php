<?php

    require 'db_connection.php';


    $movieReleaseDate = $_POST["releasedateAJAX"];
    $movieIdPHP = $_POST["movieidAJAX"];



    $allmoviestableupdatesqldates = "UPDATE allmovies_ratings SET release_date = '" . $movieReleaseDate . "' WHERE movie_id = " . $movieIdPHP . ";";

    if ($conn->query($allmoviestableupdatesqldates) === TRUE) {

    } else {

    }


?>
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






	$movieIdTablePHP = $_POST["movieidtableAJAX"];
	$IPaddress = $_POST["ipaddressAJAX"];
    $userOverallPHP = $_POST["useroverallAJAX"];
    $userCreepyPHP = $_POST["usercreepyAJAX"];
    $userGoryPHP = $_POST["usergoryAJAX"];
    $userJumpyPHP = $_POST["userjumpyAJAX"];

    $movieIdPHP = $_POST["movieidAJAX"];

    $overallVoteCount = $_POST["overallvotecountAJAX"];


    if(isset($_POST)) { // On clicking submit

        // Add user selected values to database
        $insertsql = "INSERT INTO " . $movieIdTablePHP . " (user_ipaddress, overall_rating, creepy_rating, gory_rating, jumpy_rating)
        VALUES ( '" . $IPaddress . "', " . $userOverallPHP . ", " . $userCreepyPHP . ", " . $userGoryPHP . ", " . $userJumpyPHP . ")";

        if ($conn->query($insertsql) === TRUE) {

        } else {

        }





        // Add the timestamp for the latest vote and +1 to the count of overall votes in allmovies table
        $allmoviestableupdatesqldates = "UPDATE allmovies_ratings SET latest_vote = CURRENT_TIMESTAMP(), vote_count = " . $overallVoteCount . " + 1 WHERE movie_id = " . $movieIdPHP . ";";

        if ($conn->query($allmoviestableupdatesqldates) === TRUE) {

        } else {

        }

    }


?>
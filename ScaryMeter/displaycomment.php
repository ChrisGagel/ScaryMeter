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


    $movieIdCommentTablePHP = $_GET['movieidcommenttable'];

    //Selecting the user's ip address from the movie table if it exists
    $commentselectsql = "SELECT * FROM " . $movieIdCommentTablePHP . " ORDER BY comment_id DESC";
    $commentresult = $conn->query($commentselectsql);
        
    if ($commentresult->num_rows > 0) {
        $lines = array();
        while($commentrow = $commentresult->fetch_assoc()) { //Compiles all the rows

            $commentid[] = '"' . $commentrow["comment_id"] . '"';
            $comment[] = '"' . $commentrow["comment"] . '"';
            $commentsendername[] = '"' . $commentrow["comment_sender_name"] . '"';
            $date[] = '"' . $commentrow["date"] . '"';
            $commentsenderipaddress[] = '"' . $commentrow["comment_sender_ipaddress"] . '"';
            $isspoiler[] = '"' . $commentrow["is_spoiler"] . '"';

        }

        //Creates JSON that is then sent to the index.php AJAX function
        echo '{"commentid":[';
        echo implode(',', $commentid);
        echo '],"comment":[';
        echo implode(',', $comment);
        echo '],"commentsendername":[';
        echo implode(',', $commentsendername);
        echo '],"date":[';
        echo implode(',', $date);
        echo '],"commentsenderipaddress":[';
        echo implode(',', $commentsenderipaddress);
        echo '],"isspoiler":[';
        echo implode(',', $isspoiler);
        echo "]}";

    } else {
    	echo "<div class='comment-row'><div class='comment-text'>No comments to display yet</div></div>";;
    }




?>
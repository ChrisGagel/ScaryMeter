<?php

    require 'db_connection.php';


    $comment = mysqli_real_escape_string($conn, $_POST['comment']); //The mysqli_real_escape_string allows for comments to begin and end with ' and "
    $commentSenderName = mysqli_real_escape_string($conn, $_POST['name']);

    $movieIdCommentTablePHP = $_POST['movieidcommenttable'];
    $IPaddress = $_POST['ipaddressAJAX'];
    $isSpoilerPHP = $_POST['isspoilerAJAX'];



    if(isset($_POST)) { // On clicking submit

        // Add user selected values to database
        $insertcommentsql = "INSERT INTO " . $movieIdCommentTablePHP . " (comment, comment_sender_name, date, comment_sender_ipaddress, is_spoiler)
        VALUES ( '" . $comment . "', '" . $commentSenderName . "', CURRENT_TIMESTAMP(), '" . $IPaddress . "', " . $isSpoilerPHP . ")";

        if ($conn->query($insertcommentsql) === TRUE) {

        } else {

        }


    }


?>
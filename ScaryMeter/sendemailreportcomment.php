<?php

    $movietitle = $_POST['movietitle'];
    $movieyear = $_POST['movieyear'];
    $movieid = $_POST['movieid'];
    $ipaddress = $_POST['ipaddress'];
    $reportCommentValue = $_POST['reportcommentvalueAJAX'];
    $movieIdCommentTablePHP = $_POST['movieidcommenttableAJAX'];

    if(isset($_POST)){
        mail("scarymeter@gmail.com","A comment has been reported as " . $reportCommentValue . " for " . $movietitle . " (" . $movieyear . "; id=" . $movieid . "; commentid=" . $movieIdCommentTablePHP . ")","A comment has been reported as " . $reportCommentValue . " by user " . $ipaddress . " for " . $movietitle . " (" . $movieyear . "; id=" . $movieid . "; commentid=" . $movieIdCommentTablePHP . ")");
    }

?>
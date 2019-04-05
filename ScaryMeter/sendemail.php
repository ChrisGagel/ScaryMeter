<?php

	$movietitle = $_POST['movietitle'];
	$movieyear = $_POST['movieyear'];
	$movieid = $_POST['movieid'];
	$ipaddress = $_POST['ipaddress'];

    if(isset($_POST)){
        mail("scarymeter@gmail.com",$movietitle . " (" . $movieyear . "; id=" . $movieid . ") has been reported as not a horror movie",$movietitle . " (" . $movieyear . "; id=" . $movieid . ") has been reported as not a horror movie by user " . $ipaddress);
    }

?>
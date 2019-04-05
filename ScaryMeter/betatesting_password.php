<?php
session_start();
$_SESSION["accesspassword"] = "blurryPanda5029";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Scary Meter</title>

    <!--Bootstrap shit-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script> <!--This is for jQuery Ajax-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/corejs-typeahead/1.2.1/typeahead.bundle.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js-bootstrap-css/1.2.1/typeaheadjs.min.css" />

    <!--Google fonts shit-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    
    <!--Style sheet, named indexStyle.css-->
    <link rel="stylesheet" href="error404Style.css">

    <!--Favicon-->
    <link href="images\SMfavicon.png" rel="icon" type="image/x-icon">



</head>
<body>

	<img id="imageCoverPhotoBackground" src="images\scarymeter_backgroundgradient.png" /> <!--Previously https://digitaldesigns1.net/wp-content/uploads/2017/01/web-background.jpg-->

	<div class="container-fluid" style="position:absolute; top:0; width:100%;">

		<div class="row">
		    <p class="oopsStyle">Welcome to Scary Meter!</p>
		    <p class="errorStyle">Beta Testing</p>
		    <p class="messageStyle">
		        Please enter the password to access the site.
		    </p>
		</div>

		<form method="POST" style="text-align: center;">
			<input type="text" placeholder="Enter password..." style="width: 40%; height: 40px; font-size: 20px;">
			<button type="button" class="btn btn-primary" value="Submit">Submit</button>
		</form>


	</div>


</body>
</html>
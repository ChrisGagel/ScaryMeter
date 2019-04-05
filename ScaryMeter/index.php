<?php
    session_start();
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
    <link rel="stylesheet" href="indexStyle.css">

    <!--Favicon-->
    <link href="images\SMfavicon.png" rel="icon" type="image/x-icon">



</head>


<body>

    <!-- SET COVER PHOTO IMAGE AS PAGE BACKGROUND (AND GENERIC GRADIENT IN CASE ONE DOESN'T EXIST) -->
    <img id="imageCoverPhotoBackground"></img><!--This used to have a div tag-->
    <img id="genericCoverPhotoBackground" src="images\scarymeter_backgroundgradient.png" style="display: none;" />

    <div class="container-fluid" style="position:absolute; top:0; width:100%;">

        <!--NAVIGATION BAR-->
        <div class="row">
            <nav class="navbar fixed-top navbar-expand-md navbar-inverse" style="margin: 0; width: 100%; -webkit-border-radius: 0; -moz-border-radius: 0; border-radius: 0; background-color: #2D2D2D; border: 0; position: fixed; z-index: 1;">
                <div class="container">
                    <div class="navbar-nav" style="font-family: 'Oswald', sans-serif;">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#scaryMeterNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="frontPage.html">Scary Meter</a>
                    </div>
                    <div class="nav navbar-nav navbar-right">
                        <form class="navbar-form" role="search" method="get" action="index.php">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">
                                    <!-- <span class="glyphicon glyphicon-film" aria-hidden="true"></span> - this adds the film icon to the left of the search bar-->
                                </span>
                                <div id="customDivTypeahead">
                                    <!--In here are two input fields, one hidden. The movietypeahead is for user inputted text and the movieid is for the program to redirect to a specific movie-->
                                    <input type="text" class="form-control typeahead" autocomplete="off" spellcheck="false" placeholder="Search movies..." name="movietypeahead">
                                    <input type="hidden" id="movieid" name="movieid">
                                </div>
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit" id="searchBtn" style="opacity: 1;"><img id="searchIcon" src="images\searchicon.png" /><!--ORIGINAL GLYPHICON <i class="glyphicon glyphicon-search"></i>--></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="collapse navbar-collapse" id="scaryMeterNavbar">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Top Lists<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Top 10 Scariest</a></li>
                                    <li><a href="#">Top 10 Least Scary</a></li>
                                    <li><a href="#">Most Rated</a></li>
                                    <li><a href="#">Least Rated</a></li>
                                </ul>
                            </li>
                            <li><a href="aboutUs.html">About Us</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div> <!-- navigation bar row -->





        <!-- MOVIE BOX -->
        <div class="row">
            <div class="movieSummarySection">
                <div class="movieDetails">

                    <img id="moviePoster" alt="Movie Poster" />
                    <div class="movieDescription">

                        <div class="movieDescTop">
                            <table style="width: 100%; margin-bottom: -15px;">
                                <tr>
                                    <th>
                                        <p id="movieYearLabel">Year</p>
                                    </th>
                                    <th>
                                        <!--See modal HTML code down below -- just above footer-->
                                        <a href="#"><p id="rateThisMovieText" data-toggle="modal" data-target="#rateThisMovieModal">Click Here to Rate</p></a>
                                        <p id="alreadyRatedForMovieText" style="display: none;">You've Already Rated this Movie</p>
                                    </th>
                                </tr>
                            </table>
                            <p id="movieTitleLabel" style="margin-bottom: -3px;">Title</p>
                            <p id="tagline">Tagline</p>
                            <p id="descriptionOfMovieLabelPlot">Plot</p>
                        </div> <!-- movieDescTop -->

                        <div class="movieDescBottom">
                            <p class="descriptionOfLabel"> Directed by <span id="descriptionOfMovieLabelDirector">Directors</span></p>
                            <p class="descriptionOfLabel"> Cast <span id="descriptionOfMovieLabelActors">Actors</span></p>
                            <div class="row">
                                <div class="col-xs-6">
                                    <p class="descriptionOfLabel"> Rating <span id="mpaaRating">Rating</span></p>
                                </div>
                                <div class="col-xs-6">
                                    <p class="descriptionOfLabel"> Runtime <span id="runtime">Runtime</span></p>
                                </div>
                            </div>
                            <div id="ifMovieNoHorror">
                                <form method="POST">
                                    <p style="margin-bottom: 0px;">
                                        If this movie has been incorrectly labelled a horror, <button type="submit" name="submitemail" id="submitemail">please click here</button> to report it. <span id="emailSent" style="display: none;">Thanks!</span>
                                    </p>
                                </form>
                            </div>
                        </div> <!-- movieDescBottom -->
                    </div> <!-- movieDescription -->
                </div> <!-- movieDetails -->
            </div> <!-- movieSummarySection -->
        </div> <!-- moviebox row -->


        <div id="allScaryRatingBars">


            <!-- SCARY METER RATING -->
            <div class="row">
                <div class="scaryMeterRating">
                    <div class="row" style="margin:0;">
                        <div class="col-xs-11">
                            <div class="row">
                                <div class="progress" style="background-color: #545454; opacity: 0.95;">
                                    <div class="progress-bar overallProgressBar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="background-color: #CC3333;">
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-1">
                            <div class="overallScaryMeterRatingNumberStyle">
                                <span id="overallScaryMeterRatingNumber"></span>
                            </div>
                        </div>
                    </div>
                </div> <!-- scaryMeterRating -->
            </div>




            <!--SUB SCARY METER RATING BARS-->
            <div class="row">
                <div class="pageBottom">
                    <div class="subMeterSection">

                        <!--CREEPY METER BAR-->
                        <div class="row" style="margin: 0;">
                            <div class="col-xs-2">
                                <div class="subScaryMeterRatingBarLabel">
                                    CREEPY
                                </div>
                            </div>
                            <div class="col-xs-10" style="padding: 0;">
                                <div class="progress" style="padding-right: 15px;">
                                    <div class="progress-bar creepyProgressBar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="background-color: #3366CC; text-align: right; padding-right: 7px;">
                                        <span id="creepyMeterRatingNumber"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--GORY METER BAR-->
                        <div class="row" style="margin: 0;">
                            <div class="col-xs-2">
                                <div class="subScaryMeterRatingBarLabel">
                                    GORY
                                </div>
                            </div>
                            <div class="col-xs-10" style="padding: 0;">
                                <div class="progress" style="padding-right: 15px;">
                                    <div class="progress-bar goryProgressBar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="background-color: #009966; text-align: right; padding-right: 7px;">
                                        <span id="goryMeterRatingNumber"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--JUMPY METER BAR-->
                        <div class="row" style="margin: 0;">
                            <div class="col-xs-2">
                                <div class="subScaryMeterRatingBarLabel">
                                    JUMPY
                                </div>
                            </div>
                            <div class="col-xs-10" style="padding: 0;">
                                <div class="progress" style="padding-right: 15px;">
                                    <div class="progress-bar jumpyProgressBar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="background-color: #FFCC66; text-align: right; padding-right: 7px;">
                                        <span id="jumpyMeterRatingNumber"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--SIMILARLY RATED MOVIES-->
                    <div class="row" style="margin: 0;">
                        <div class="similarlyRatedMoviesSection">
                            <div class="similarlyRatedMoviesLabel">Similarly Rated Movies</div>

                            <div class="row" style="margin: 15px;">
                                <div class="col-xs-4">
                                    <div class="similarlyRatedBox">
                                        <a href="#" onclick="loadSimilarMovies1()">
                                            <div class="row" style="margin: 0;">
                                                <img id="similarlyRatedMoviesCoverPhoto1" alt="Cover Photo" />
                                                <img id="notEnoughRatingsImage1" src="images\notenoughratings.png" style="display: none;" />
                                            </div>
                                            <div class="row" style="margin: 0;">
                                                <div id="similarlyRatedTitle1" class="similarlyRatedTitles">
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="similarlyRatedBox">
                                        <a href="#" onclick="loadSimilarMovies2()">
                                            <div class="row" style="margin: 0;">
                                                <img id="similarlyRatedMoviesCoverPhoto2" alt="Cover Photo" />
                                                <img id="notEnoughRatingsImage2" src="images\notenoughratings.png" style="display: none;" />
                                            </div>
                                            <div class="row" style="margin: 0;">
                                                <div id="similarlyRatedTitle2" class="similarlyRatedTitles">
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="similarlyRatedBox">
                                        <a href="#" onclick="loadSimilarMovies3()">
                                            <div class="row" style="margin: 0;">
                                                <img id="similarlyRatedMoviesCoverPhoto3" alt="Cover Photo" />
                                                <img id="notEnoughRatingsImage3" src="images\notenoughratings.png" style="display: none;" />
                                            </div>
                                            <div class="row" style="margin: 0;">
                                                <div id="similarlyRatedTitle3" class="similarlyRatedTitles">
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin: 15px; margin-bottom: 0;">
                                <div class="col-xs-4">
                                    <div class="similarlyRatedBox">
                                        <a href="#" onclick="loadSimilarMovies4()">
                                            <div class="row" style="margin: 0;">
                                                <img id="similarlyRatedMoviesCoverPhoto4" alt="Cover Photo" />
                                                <img id="notEnoughRatingsImage4" src="images\notenoughratings.png" style="display: none;" />
                                            </div>
                                            <div class="row" style="margin: 0;">
                                                <div id="similarlyRatedTitle4" class="similarlyRatedTitles">
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="similarlyRatedBox">
                                        <a href="#" onclick="loadSimilarMovies5()">
                                            <div class="row" style="margin: 0;">
                                                <img id="similarlyRatedMoviesCoverPhoto5" alt="Cover Photo" />
                                                <img id="notEnoughRatingsImage5" src="images\notenoughratings.png" style="display: none;" />
                                            </div>
                                            <div class="row" style="margin: 0;">
                                                <div id="similarlyRatedTitle5" class="similarlyRatedTitles">
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="similarlyRatedBox">
                                        <a href="#" onclick="loadSimilarMovies6()">
                                            <div class="row" style="margin: 0;">
                                                <img id="similarlyRatedMoviesCoverPhoto6" alt="Cover Photo" />
                                                <img id="notEnoughRatingsImage6" src="images\notenoughratings.png" style="display: none;" />
                                            </div>
                                            <div class="row" style="margin: 0;">
                                                <div id="similarlyRatedTitle6" class="similarlyRatedTitles">
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- pageBottom -->
            </div>
        </div>


        <!--THE SECTION THAT APPEARS WHEN A NON-HORROR OR THRILLER MOVIE PAGE LOADS-->
        <div id="notScaryMovieSection" style="display: none;">
            <div class="row">
                <div class="notScaryMovieSubsection">
                    <p id="notScaryMovieSubsectionHeading">THIS IS NOT A HORROR MOVIE</p>
                    <p id="notScaryMovieSubsectionBody" style="margin-top: 15px; padding: 15px;">“<span id="notHorrorMovieTitle">This movie</span>” is not classified as a horror movie, therefore it does not adhere to this website's rating system. Instead, it is listed under the following genres:</p>
                    <p id="genresList" style="text-align: center; padding: 5px;">Genres missing</p>
                </div>
            </div>
        </div>




        <!--COMMENTS SECTION - Style thanks to Vincy at https://phppot.com/php/comments-system-using-php-and-ajax/-->
        <div class="row">
            <div class="commentSection">
                <div class="comment-form-container">
                    <form id="frm-comment" method="POST">
                        <div class="row" style="margin: 0">
                            <input class="input-field" type="text" name="name" id="name" placeholder="Name" maxlength="40" onkeypress="postCommentWithEnter(event)" style="width: 50%;" /> <input type="button" class="btn-submit" id="submitCommentButton" value="Post" /> <input type="checkbox" id="isSpoilerCheckbox"> Comment contains spoilers <button type="button" id="showSpoilersButton" onclick="showHideSpoilers()">Show Spoilers</button>
                        </div>
                        <div class="row" style="margin: 0">
                            <textarea class="input-field" type="text" name="comment" id="comment" placeholder="Comment on this movie..." maxlength="200" onkeypress="postCommentWithEnter(event)" style="resize: none; width: 100%; height: 100px;"></textarea>
                        </div>
                    </form>
                </div>
                <div id="responsecontainer"></div>
            </div>
        </div>



        <!--RATING MOVIES MODAL - https://getbootstrap.com/docs/4.0/components/modal/-->
        <form class="modal fade" method="POST" id="rateThisMovieModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="modal-title" id="exampleModalLabel">How scary is “<span id="movieTitleLabelModal">this movie</span>”?</div>
                    </div>

                    <div class="modal-body">
                        <div class="scaryMeterRatingModal">
                            <div class="row" style="margin:0;">
                                <div class="col-xs-11">
                                    <div class="row">
                                        <div class="progress" style="background-color: #545454; opacity: 1;">
                                            <div class="progress-bar overallProgressBarModal" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="background-color: #CC3333;">
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="overallScaryMeterRatingNumberStyleModal">
                                        <span id="overallScaryMeterRatingNumbeModal" name="overallScaryMeterRatingNumbeModal"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px; margin-left:0; margin-right:0;">
                                <!--SLIDER - https://www.w3schools.com/howto/howto_js_rangeslider.asp-->
                                <div class="slidecontainer">
                                    <div class="col-xs-11" style="padding: 0;">
                                        <input type="range" min="0" max="100" value="50" class="slider" name="overallSliderRange" id="overallSliderRange" onmouseup="overallMouseUp()">
                                    </div>
                                    <div class="col-xs-1" style="font-size: 10px; padding: 0; text-align: center;">
                                        <div id="overallSliderRangeNumber">
                                            Slide to rate
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="subMetersModal">
                        <div class="modal-header">
                            <div class="subMeterTitleLabelModal">Is this movie...?</div>
                        </div>

                        <div class="modal-body" style="margin-top: -15px;">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="row">
                                        <p class="subMeterCateogryLabelModal" style="margin-bottom: -3px;">Creepy</p>
                                    </div>
                                    <div class="row" style="text-align: center; margin-top: 5px;">
                                        <fieldset id="creepyGroup">
                                            <label for="thumbsUpCreepy">
                                                <input type="radio" id="thumbsUpCreepy" name="creepyGroup" value="100" />
                                                <img src="images\thumbsup.png" id="thumbsUpImageCreepy" onclick="changeThumbsUpColorCreepy()" onmouseup="overallMouseUp()" alt="Thumbs Up" />
                                            </label>
                                            <label for="thumbsDownCreepy">
                                                <input type="radio" id="thumbsDownCreepy" name="creepyGroup" value="0" />
                                                <img src="images\thumbsdown.png" id="thumbsDownImageCreepy" onclick="changeThumbsDownColorCreepy()" onmouseup="overallMouseUp()" alt="Thumbs Down" />
                                            </label>
                                            <!--<img id="thumbsUpImageCreepy" src="images\thumbsup.png" onclick="changeThumbsUpColorCreepy()"></img>
                                            <img id="thumbsDownImageCreepy" src="images\thumbsdown.png" onclick="changeThumbsDownColorCreepy()"></img>-->
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="row">
                                        <p class="subMeterCateogryLabelModal" style="margin-bottom: -3px;">Gory</p>
                                    </div>
                                    <div class="row" style="text-align: center; margin-top: 5px;">
                                        <fieldset id="goryGroup">
                                            <label for="thumbsUpGory">
                                                <input type="radio" id="thumbsUpGory" name="goryGroup" value="100" />
                                                <img src="images\thumbsup.png" id="thumbsUpImageGory" onclick="changeThumbsUpColorGory()" onmouseup="overallMouseUp()" alt="Thumbs Up" />
                                            </label>
                                            <label for="thumbsDownGory">
                                                <input type="radio" id="thumbsDownGory" name="goryGroup" value="0" />
                                                <img src="images\thumbsdown.png" id="thumbsDownImageGory" onclick="changeThumbsDownColorGory()" onmouseup="overallMouseUp()" alt="Thumbs Down" />
                                            </label>
                                            <!--<img id="thumbsUpImageGory" src="images\thumbsup.png" onclick="changeThumbsUpColorGory()"></img>
                                            <img id="thumbsDownImageGory" src="images\thumbsdown.png" onclick="changeThumbsDownColorGory()"></img>-->
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="row">
                                        <p class="subMeterCateogryLabelModal" style="margin-bottom: -3px;">Jumpy</p>
                                    </div>
                                    <div class="row" style="text-align: center; margin-top: 5px;">
                                        <fieldset id="jumpyGroup">
                                            <label for="thumbsUpJumpy">
                                                <input type="radio" id="thumbsUpJumpy" name="jumpyGroup" value="100" />
                                                <img src="images\thumbsup.png" id="thumbsUpImageJumpy" onclick="changeThumbsUpColorJumpy()" onmouseup="overallMouseUp()" alt="Thumbs Up" />
                                            </label>
                                            <label for="thumbsDownJumpy">
                                                <input type="radio" id="thumbsDownJumpy" name="jumpyGroup" value="0" />
                                                <img src="images\thumbsdown.png" id="thumbsDownImageJumpy" onclick="changeThumbsDownColorJumpy()" onmouseup="overallMouseUp()" alt="Thumbs Down" />
                                            </label>
                                            <!--<img id="thumbsUpImageJumpy" src="images\thumbsup.png" onclick="changeThumbsUpColorJumpy()"></img>
                                            <img id="thumbsDownImageJumpy" src="images\thumbsdown.png" onclick="changeThumbsDownColorJumpy()"></img>-->
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submitratings" id="submitratings" onclick="overallMouseUp()">Submit</button>
                    </div>
                </div>
            </div>
        </form>


        <form class="modal fade" method="POST" id="reportCommentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="modal-title" id="exampleModalLabel">I am reporting this comment because...</div>
                    </div>
                    <div class="modal-body">
                        <fieldset id="reportcommentradio" style="text-align: center;">
                            <label for="reportcommentspoiler">
                                <input type="radio" id="reportcommentspoiler" name="reportcommentradio" value="spoiler" />
                                <img src="images\report_spoilers_empty.png" id="reportCommentImageSpoiler" onclick="reportCommentImageSpoilerFunction()" onmouseup="checkReportCommentValue()" alt="Spoiler" />
                            </label>
                            <label for="reportcommentspam">
                                <input type="radio" id="reportcommentspam" name="reportcommentradio" value="spam" />
                                <img src="images\report_spam_empty.png" id="reportCommentImageSpam" onclick="reportCommentImageSpamFunction()" onmouseup="checkReportCommentValue()" alt="Spam" />
                            </label>
                            <label for="reportcommentharassment">
                                <input type="radio" id="reportcommentharassment" name="reportcommentradio" value="harassment" />
                                <img src="images\report_harassment_empty.png" id="reportCommentImageHarassment" onclick="reportCommentImageHarassmentFunction()" onmouseup="checkReportCommentValue()" alt="Harassment" />
                            </label>
                            <label for="reportcommenthatespeech">
                                <input type="radio" id="reportcommenthatespeech" name="reportcommentradio" value="hatespeech" />
                                <img src="images\report_hatespeech_empty.png" id="reportCommentImageHatespeech" onclick="reportCommentImageHatespeechFunction()" onmouseup="checkReportCommentValue()" alt="Hate Speech" />
                            </label>
                        </fieldset>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submitreportedcomment" id="submitreportedcomment" onclick="checkReportCommentValue()">Report</button>
                    </div>
                </div>
            </div>
        </form>


        <!--FOOTER-->
        <div class="row">
            <div class="footer">
                <p style="width: 70%; margin: auto;">© Scary Meter 2019 | Created by Christopher Gagel and Nicolas Lelièvre | Contact: <a href="mailto:scarymeter@gmail.com" style="color: #9C9C9C;">scarymeter@gmail.com</a></p>
            </div>
        </div>

    </div> <!-- container-fluid -->
    </body>
</html>























<!--Scripts-->




<?php

    // Include and instantiate the class.
    require_once 'Mobile_Detect.php';
    $detect = new Mobile_Detect;
     
    // Any mobile device (phones or tablets).
    if ( $detect->isMobile() ) {
        $usingMobile = "true";
    }
    else {
        $usingMobile = "false";
    }

?>















<script>
    

// PHP mobile redirect
if ("<?php echo $usingMobile ?>" == "true") {
    document.location.href = "/index_mobile.html";
}


// SHOW SEARCH RESULTS IN INPUT FIELD
// https://stackoverflow.com/questions/21530063/how-do-we-set-remote-in-typeahead-js
// Instantiate the Bloodhound suggestion engine
var movies = new Bloodhound({
    datumTokenizer: function (datum) {
        return Bloodhound.tokenizers.whitespace(datum.value);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: 'http://api.themoviedb.org/3/search/movie?query=%QUERY&api_key=062a89fc4c3fcc6e928a7ba7ca87074e', //Not sure if this even works but whatevs
    remote: {
        wildcard: '%QUERY',
        url: 'http://api.themoviedb.org/3/search/movie?query=%QUERY&api_key=062a89fc4c3fcc6e928a7ba7ca87074e',
        transform: function (response) {
            // Map the remote source JSON array to a JavaScript object array
            return $.map(response.results, function (movie) {
                return {
                    //value: movie.id + " - " + movie.title,
                    valueID: movie.id,
                    valueTitle: movie.title,
                    valueYear: parseInt(movie.release_date),
                    valueStatus: movie.status
                };
            });
        }
    }
});


// HTML submit button sends same-value displayed to URL

// Instantiate the Typeahead UI aka CHRIS' ABSOLUTE GODLIKE MASTERPIECE thanks to this https://stackoverflow.com/questions/31284593/twitter-typeahead-different-value-to-display and StackOverflow contributor "vinhboy"
$('.typeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 1,
        autoselect: true
    },
    {
        name: 'movieDataset',
        display: "valueTitle",
        source: movies,
        templates: {
            suggestion: function (movie) {
                return '<p>' + movie.valueTitle + ' - ' + movie.valueYear + '</p>';
            },
            empty: function (movie) {
                $(".tt-dataset").text('No Results Found');
            }
    }
    }).bind('typeahead:select', function(ev, suggestion) {
            $('#movieid').val(suggestion.valueID);
}).on('typeahead:selected', enableSubmit);


var searchSubmitButton = document.getElementById("searchBtn"); //Disable submit button until there is an input in the search field
searchSubmitButton.disabled = true;
function enableSubmit(){
    searchSubmitButton.disabled = false;
    searchSubmitButton.click(); //When input is in search field, automatically clicks search button
}



</script>


















<?php

    // TMDB 49026 694

    $movieIdPHP = $_GET['movieid'];
    $movieIdTablePHP = "id" . $_GET['movieid']; //Retrieve the movieid from the user form plus the word id in front of it to create table name
    $movieIdCommentTablePHP = "id" . $_GET['movieid'] . "comment";

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
    
    
    // sql to create table
    $tablesql = "CREATE TABLE IF NOT EXISTS " . $movieIdTablePHP . " (
        user_ipaddress VARCHAR(11) PRIMARY KEY NOT NULL,
        overall_rating INT(11), 
        creepy_rating INT(11),
        gory_rating INT(11),
        jumpy_rating INT(11)
    )";

    if ($conn->query($tablesql) === TRUE) { // NEED TO KEEP THIS OTHERWISE IT WON'T CREATE THE TABLE
        
    } else {
        
    }



    //Declare variable for user's IP Address
    $IPaddress = $_SERVER['REMOTE_ADDR'];



    //Selecting averages of ratings per column from movie table
    $selectsql = "SELECT AVG(overall_rating) AS average_overall_rating, AVG(creepy_rating) AS average_creepy_rating, AVG(gory_rating) AS average_gory_rating, AVG(jumpy_rating) AS average_jumpy_rating FROM " . $movieIdTablePHP;
    $result = $conn->query($selectsql);
    $row = $result->fetch_assoc();

    //Count the amount of ratings per column from movie table
    $countselectsql = "SELECT COUNT(overall_rating) AS count_overall_rating, COUNT(creepy_rating) AS count_creepy_rating, COUNT(gory_rating) AS count_gory_rating, COUNT(jumpy_rating) AS count_jumpy_rating FROM " . $movieIdTablePHP;
    $countresult = $conn->query($countselectsql);
    $countrow = $countresult->fetch_assoc();

    //Selecting the user's ip address from the movie table if it exists
    $IPselectsql = "SELECT user_ipaddress FROM " . $movieIdTablePHP . " WHERE user_ipaddress = '" . $IPaddress . "' LIMIT 1";
    $IPresult = $conn->query($IPselectsql);
    $IProw = $IPresult->fetch_assoc();

    //Boolean condition for if the user's IP address appears in the table
    $IPaddressDatabase = $IProw["user_ipaddress"];
    if ($IPaddressDatabase == null) {
        $AlreadyRated = false;
    }
    else if ($IPaddressDatabase == $IPaddress) {
        $AlreadyRated = true; 
    }
    else {
        $AlreadyRated = false;
    }




    // Declaring variables for the different ratings
    $overallRatingPHP = $row["average_overall_rating"];
    $creepyRatingPHP = $row["average_creepy_rating"];
    $goryRatingPHP = $row["average_gory_rating"];
    $jumpyRatingPHP = $row["average_jumpy_rating"];
    $overallRatingPercentPHP = $row["average_overall_rating"] . "%";
    $creepyRatingPercentPHP = $row["average_creepy_rating"] . "%";
    $goryRatingPercentPHP = $row["average_gory_rating"] . "%";
    $jumpyRatingPercentPHP = $row["average_jumpy_rating"] . "%";

    $overallRatingPHPCount = $countrow["count_overall_rating"];
    $creepyRatingPHPCount = $countrow["count_creepy_rating"];
    $goryRatingPHPCount = $countrow["count_gory_rating"];
    $jumpyRatingPHPCount = $countrow["count_jumpy_rating"];


    // The following decides to which of the 16 similarly rated titles group does this movie belong to
    $overallRatingPHPNumber = (float)$overallRatingPHP;
    $creepyRatingPHPNumber = (float)$creepyRatingPHP;
    $goryRatingPHPNumber = (float)$goryRatingPHP;
    $jumpyRatingPHPNumber = (float)$jumpyRatingPHP;
    
    if ($overallRatingPHPNumber < 50 && $creepyRatingPHPNumber < 50 && $goryRatingPHPNumber < 50 && $jumpyRatingPHPNumber < 50){
        $similarGroup = 1; // NONE
    }
    else if ($overallRatingPHPNumber > 50 && $creepyRatingPHPNumber < 50 && $goryRatingPHPNumber < 50 && $jumpyRatingPHPNumber < 50){
        $similarGroup = 2; // O
    }
    else if ($overallRatingPHPNumber < 50 && $creepyRatingPHPNumber > 50 && $goryRatingPHPNumber < 50 && $jumpyRatingPHPNumber < 50){
        $similarGroup = 3; // C
    }
    else if ($overallRatingPHPNumber < 50 && $creepyRatingPHPNumber < 50 && $goryRatingPHPNumber > 50 && $jumpyRatingPHPNumber < 50){
        $similarGroup = 4; // G
    }
    else if ($overallRatingPHPNumber < 50 && $creepyRatingPHPNumber < 50 && $goryRatingPHPNumber < 50 && $jumpyRatingPHPNumber > 50){
        $similarGroup = 5; // J
    }
    else if ($overallRatingPHPNumber > 50 && $creepyRatingPHPNumber > 50 && $goryRatingPHPNumber < 50 && $jumpyRatingPHPNumber < 50){
        $similarGroup = 6; // OC
    }
    else if ($overallRatingPHPNumber > 50 && $creepyRatingPHPNumber < 50 && $goryRatingPHPNumber > 50 && $jumpyRatingPHPNumber < 50){
        $similarGroup = 7; // OG
    }
    else if ($overallRatingPHPNumber > 50 && $creepyRatingPHPNumber < 50 && $goryRatingPHPNumber < 50 && $jumpyRatingPHPNumber > 50){
        $similarGroup = 8; // OJ
    }
    else if ($overallRatingPHPNumber < 50 && $creepyRatingPHPNumber > 50 && $goryRatingPHPNumber > 50 && $jumpyRatingPHPNumber < 50){
        $similarGroup = 9; // CG
    }
    else if ($overallRatingPHPNumber < 50 && $creepyRatingPHPNumber > 50 && $goryRatingPHPNumber < 50 && $jumpyRatingPHPNumber > 50){
        $similarGroup = 10; // CJ
    }
    else if ($overallRatingPHPNumber < 50 && $creepyRatingPHPNumber < 50 && $goryRatingPHPNumber > 50 && $jumpyRatingPHPNumber > 50){
        $similarGroup = 11; // GJ
    }
    else if ($overallRatingPHPNumber > 50 && $creepyRatingPHPNumber > 50 && $goryRatingPHPNumber > 50 && $jumpyRatingPHPNumber < 50){
        $similarGroup = 12; // OCG
    }
    else if ($overallRatingPHPNumber > 50 && $creepyRatingPHPNumber < 50 && $goryRatingPHPNumber > 50 && $jumpyRatingPHPNumber > 50){
        $similarGroup = 13; // OGJ
    }
    else if ($overallRatingPHPNumber > 50 && $creepyRatingPHPNumber > 50 && $goryRatingPHPNumber < 50 && $jumpyRatingPHPNumber > 50){
        $similarGroup = 14; // OCJ
    }
    else if ($overallRatingPHPNumber < 50 && $creepyRatingPHPNumber > 50 && $goryRatingPHPNumber > 50 && $jumpyRatingPHPNumber > 50){
        $similarGroup = 15; // CGJ
    }
    else if ($overallRatingPHPNumber > 50 && $creepyRatingPHPNumber > 50 && $goryRatingPHPNumber > 50 && $jumpyRatingPHPNumber > 50){
        $similarGroup = 16; // ALL
    }






    // Create row in allmovies table with null values that will be updated and vote_count as 0

    $allmoviestableinsertsql = "INSERT INTO allmovies_ratings (movie_id, vote_count) VALUES (" . $movieIdPHP . ", 0)";

    if ($conn->query($allmoviestableinsertsql) === TRUE) {

    } else {

    }


    $allmoviestableupdatesql = "UPDATE allmovies_ratings SET overall_rating = " . $overallRatingPHP . ", creepy_rating = " . $creepyRatingPHP . ", gory_rating = " . $goryRatingPHP . ", jumpy_rating = " . $jumpyRatingPHP . ", similar_group = " . $similarGroup . " WHERE movie_id = " . $movieIdPHP . ";";

    if ($conn->query($allmoviestableupdatesql) === TRUE) {

    } else {

    }

    


    // This here selects random 6 movies from the same group as the one which page is on (except the one in which the page is on) and stores them in values $similarmovie...
    $selectsqlsimilargroup = "SELECT movie_id FROM allmovies_ratings WHERE similar_group = " . $similarGroup . " AND NOT movie_id = " . $movieIdPHP . " ORDER BY rand() LIMIT 6;";
    $resultsimilargroup = $conn->query($selectsqlsimilargroup);

    if ($resultsimilargroup->num_rows > 0) {
            
        while($rowsimilargroup = $resultsimilargroup->fetch_assoc()) {
            $similarlyratedmoviesidPHP[] = $rowsimilargroup["movie_id"];
        }
    } else {

    }

    $similarmovieid1 = $similarlyratedmoviesidPHP[0];
    $similarmovieid2 = $similarlyratedmoviesidPHP[1]; 
    $similarmovieid3 = $similarlyratedmoviesidPHP[2];
    $similarmovieid4 = $similarlyratedmoviesidPHP[3];
    $similarmovieid5 = $similarlyratedmoviesidPHP[4];
    $similarmovieid6 = $similarlyratedmoviesidPHP[5];





    // create comment table
    $createcommenttablesql = "CREATE TABLE IF NOT EXISTS " . $movieIdCommentTablePHP . " (
          comment_id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT, 
          comment varchar(200) NOT NULL, 
          comment_sender_name varchar(40) NOT NULL, 
          date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          comment_sender_ipaddress VARCHAR(11) NOT NULL,
          is_spoiler INT(11) NOT NULL
        );";

    if ($conn->query($createcommenttablesql) === TRUE) { // NEED TO KEEP THIS OTHERWISE IT WON'T CREATE THE TABLE
        
    } else {
        
    };



?>














<script>

var ipAddressJS = "<?php echo $IPaddress ?>";


function getParameterByName(name, url) {
    if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
}


//Build query URL
var baseURL_tmdb = "https://api.themoviedb.org/3/movie/";
var movieID_tmdb = getParameterByName('movieid'); //Change ID to change movie details;
var apiKey_tmdb = "062a89fc4c3fcc6e928a7ba7ca87074e";
var append_tmdb = "&append_to_response=releases,credits";
var movieQueryURL_tmdb = baseURL_tmdb + movieID_tmdb + "?api_key=" + apiKey_tmdb + append_tmdb;


// Get response from TMDB
var xhr_tmdb = new XMLHttpRequest();
xhr_tmdb.open("GET", movieQueryURL_tmdb, false);
xhr_tmdb.send();


// Parse TMDB response
var obj_tmdb = JSON.parse(xhr_tmdb.responseText);


// Build TMDB backdrop path string
var backdropBaseURL_tmdb = "https://image.tmdb.org/t/p/";
var backdropPathImgSize_tmdb = "w1280"; //Use CONFIG command to find appropriate size (or visit https://www.themoviedb.org/talk/53c11d4ec3a3684cf4006400?language=en-US)
var backdropPath_tmdb = obj_tmdb.backdrop_path;
var backdrop_tmdb = backdropBaseURL_tmdb + backdropPathImgSize_tmdb + "/" + backdropPath_tmdb; //Add &append_to_response=credits


// Set background as movie's cover photo unless one doesn't exist, in which case set as generic gradient 
if (backdropPath_tmdb == "" || backdropPath_tmdb == null) {
    document.getElementById("genericCoverPhotoBackground").style.display = "block";
    document.getElementById("imageCoverPhotoBackground").style.display = "none";
}
else {
    //Was previously this when cover photo was background image div and not img: document.getElementById("imageCoverPhotoBackground").style.backgroundImage = "url("+backdrop_tmdb+")";
    document.getElementById("imageCoverPhotoBackground").src = backdrop_tmdb;
}




// Build query for similarly rated titles cover photo 1
var similar1movieQueryURL_tmdb = baseURL_tmdb + "<?php echo $similarmovieid1 ?>" + "?api_key=" + apiKey_tmdb + append_tmdb;
var similar1xhr_tmdb = new XMLHttpRequest();
similar1xhr_tmdb.open("GET", similar1movieQueryURL_tmdb, false);
similar1xhr_tmdb.send();
var similar1obj_tmdb = JSON.parse(similar1xhr_tmdb.responseText);
var similar1backdropPath_tmdb = similar1obj_tmdb.backdrop_path;
var similarlyRatedBackdrop1 = backdropBaseURL_tmdb + "w300/" + similar1backdropPath_tmdb;

// Build query for similarly rated titles cover photo 2
var similar2movieQueryURL_tmdb = baseURL_tmdb + "<?php echo $similarmovieid2 ?>" + "?api_key=" + apiKey_tmdb + append_tmdb;
var similar2xhr_tmdb = new XMLHttpRequest();
similar2xhr_tmdb.open("GET", similar2movieQueryURL_tmdb, false);
similar2xhr_tmdb.send();
var similar2obj_tmdb = JSON.parse(similar2xhr_tmdb.responseText);
var similar2backdropPath_tmdb = similar2obj_tmdb.backdrop_path;
var similarlyRatedBackdrop2 = backdropBaseURL_tmdb + "w300/" + similar2backdropPath_tmdb;

// Build query for similarly rated titles cover photo 3
var similar3movieQueryURL_tmdb = baseURL_tmdb + "<?php echo $similarmovieid3 ?>" + "?api_key=" + apiKey_tmdb + append_tmdb;
var similar3xhr_tmdb = new XMLHttpRequest();
similar3xhr_tmdb.open("GET", similar3movieQueryURL_tmdb, false);
similar3xhr_tmdb.send();
var similar3obj_tmdb = JSON.parse(similar3xhr_tmdb.responseText);
var similar3backdropPath_tmdb = similar3obj_tmdb.backdrop_path;
var similarlyRatedBackdrop3 = backdropBaseURL_tmdb + "w300/" + similar3backdropPath_tmdb;

// Build query for similarly rated titles cover photo 4
var similar4movieQueryURL_tmdb = baseURL_tmdb + "<?php echo $similarmovieid4 ?>" + "?api_key=" + apiKey_tmdb + append_tmdb;
var similar4xhr_tmdb = new XMLHttpRequest();
similar4xhr_tmdb.open("GET", similar4movieQueryURL_tmdb, false);
similar4xhr_tmdb.send();
var similar4obj_tmdb = JSON.parse(similar4xhr_tmdb.responseText);
var similar4backdropPath_tmdb = similar4obj_tmdb.backdrop_path;
var similarlyRatedBackdrop4 = backdropBaseURL_tmdb + "w300/" + similar4backdropPath_tmdb;

// Build query for similarly rated titles cover photo 5
var similar5movieQueryURL_tmdb = baseURL_tmdb + "<?php echo $similarmovieid5 ?>" + "?api_key=" + apiKey_tmdb + append_tmdb;
var similar5xhr_tmdb = new XMLHttpRequest();
similar5xhr_tmdb.open("GET", similar5movieQueryURL_tmdb, false);
similar5xhr_tmdb.send();
var similar5obj_tmdb = JSON.parse(similar5xhr_tmdb.responseText);
var similar5backdropPath_tmdb = similar5obj_tmdb.backdrop_path;
var similarlyRatedBackdrop5 = backdropBaseURL_tmdb + "w300/" + similar5backdropPath_tmdb;

// Build query for similarly rated titles cover photo 6
var similar6movieQueryURL_tmdb = baseURL_tmdb + "<?php echo $similarmovieid6 ?>" + "?api_key=" + apiKey_tmdb + append_tmdb;
var similar6xhr_tmdb = new XMLHttpRequest();
similar6xhr_tmdb.open("GET", similar6movieQueryURL_tmdb, false);
similar6xhr_tmdb.send();
var similar6obj_tmdb = JSON.parse(similar6xhr_tmdb.responseText);
var similar6backdropPath_tmdb = similar6obj_tmdb.backdrop_path;
var similarlyRatedBackdrop6 = backdropBaseURL_tmdb + "w300/" + similar6backdropPath_tmdb;

// Path for similarly rated movies cover photos
if (similar1backdropPath_tmdb == "" || similar1backdropPath_tmdb == null) {
    document.getElementById("notEnoughRatingsImage1").style.display = "block";
    document.getElementById("similarlyRatedMoviesCoverPhoto1").style.display = "none";
}
else {
    document.getElementById("similarlyRatedMoviesCoverPhoto1").src = similarlyRatedBackdrop1;
}
if (similar2backdropPath_tmdb == "" || similar2backdropPath_tmdb == null) {
    document.getElementById("notEnoughRatingsImage2").style.display = "block";
    document.getElementById("similarlyRatedMoviesCoverPhoto2").style.display = "none";
}
else {
    document.getElementById("similarlyRatedMoviesCoverPhoto2").src = similarlyRatedBackdrop2;
}
if (similar3backdropPath_tmdb == "" || similar3backdropPath_tmdb == null) {
    document.getElementById("notEnoughRatingsImage3").style.display = "block";
    document.getElementById("similarlyRatedMoviesCoverPhoto3").style.display = "none";
}
else {
    document.getElementById("similarlyRatedMoviesCoverPhoto3").src = similarlyRatedBackdrop3;
}
if (similar4backdropPath_tmdb == "" || similar4backdropPath_tmdb == null) {
    document.getElementById("notEnoughRatingsImage4").style.display = "block";
    document.getElementById("similarlyRatedMoviesCoverPhoto4").style.display = "none";
}
else {
    document.getElementById("similarlyRatedMoviesCoverPhoto4").src = similarlyRatedBackdrop4;
}
if (similar5backdropPath_tmdb == "" || similar5backdropPath_tmdb == null) {
    document.getElementById("notEnoughRatingsImage5").style.display = "block";
    document.getElementById("similarlyRatedMoviesCoverPhoto5").style.display = "none";
}
else {
    document.getElementById("similarlyRatedMoviesCoverPhoto5").src = similarlyRatedBackdrop5;
}
if (similar6backdropPath_tmdb == "" || similar6backdropPath_tmdb == null) {
    document.getElementById("notEnoughRatingsImage6").style.display = "block";
    document.getElementById("similarlyRatedMoviesCoverPhoto6").style.display = "none";
}
else {
    document.getElementById("similarlyRatedMoviesCoverPhoto6").src = similarlyRatedBackdrop6;
}

//Path for similarly rated titles
if (similar1obj_tmdb.title == "" || similar1obj_tmdb.title == null) {
    document.getElementById("similarlyRatedTitle1").innerHTML = "";
}
else {
    document.getElementById("similarlyRatedTitle1").innerHTML = similar1obj_tmdb.title;
    function loadSimilarMovies1 () {
        document.location.href = "/index.php?movieid=" + "<?php echo $similarmovieid1 ?>";
    }
}
if (similar2obj_tmdb.title == "" || similar2obj_tmdb.title == null) {
    document.getElementById("similarlyRatedTitle2").innerHTML = "";
}
else {
    document.getElementById("similarlyRatedTitle2").innerHTML = similar2obj_tmdb.title;
    function loadSimilarMovies2 () {
        document.location.href = "/index.php?movieid=" + "<?php echo $similarmovieid2 ?>";
    }
}
if (similar3obj_tmdb.title == "" || similar3obj_tmdb.title == null) {
    document.getElementById("similarlyRatedTitle3").innerHTML = "";
}
else {
    document.getElementById("similarlyRatedTitle3").innerHTML = similar3obj_tmdb.title;
    function loadSimilarMovies3 () {
        document.location.href = "/index.php?movieid=" + "<?php echo $similarmovieid3 ?>";
    }
}
if (similar4obj_tmdb.title == "" || similar4obj_tmdb.title == null) {
    document.getElementById("similarlyRatedTitle4").innerHTML = "";
}
else {
    document.getElementById("similarlyRatedTitle4").innerHTML = similar4obj_tmdb.title;
    function loadSimilarMovies4 () {
        document.location.href = "/index.php?movieid=" + "<?php echo $similarmovieid4 ?>";
    }
}
if (similar5obj_tmdb.title == "" || similar5obj_tmdb.title == null) {
    document.getElementById("similarlyRatedTitle5").innerHTML = "";
}
else {
    document.getElementById("similarlyRatedTitle5").innerHTML = similar5obj_tmdb.title;
    function loadSimilarMovies5 () {
        document.location.href = "/index.php?movieid=" + "<?php echo $similarmovieid5 ?>";
    }
}
if (similar6obj_tmdb.title == "" || similar6obj_tmdb.title == null) {
    document.getElementById("similarlyRatedTitle6").innerHTML = "";
}
else {
    document.getElementById("similarlyRatedTitle6").innerHTML = similar6obj_tmdb.title;
    function loadSimilarMovies6 () {
        document.location.href = "/index.php?movieid=" + "<?php echo $similarmovieid6 ?>";
    }
}




// Build and write poster path
var poster_tmdb = backdropBaseURL_tmdb + backdropPathImgSize_tmdb + "/" + obj_tmdb.poster_path;
document.getElementById("moviePoster").src = poster_tmdb;


// Date
if (obj_tmdb.release_date !== '') {
    document.getElementById("movieYearLabel").innerHTML = parseInt(obj_tmdb.release_date);
}
else {
    document.getElementById("movieYearLabel").innerHTML = "Unknown release date";
}


// Title
document.getElementById("movieTitleLabel").innerHTML = obj_tmdb.title;
document.getElementById("movieTitleLabelModal").innerHTML = obj_tmdb.title;
document.getElementById("notHorrorMovieTitle").innerHTML = obj_tmdb.title;


// Directors
var directors = [];
if (obj_tmdb.credits.crew == "" || obj_tmdb.credits.crew.department == "" || obj_tmdb.credits.crew.job == "") {
    document.getElementById("descriptionOfMovieLabelDirector").innerHTML = "Unknown director(s)";
}
else {
    for (i in obj_tmdb.credits.crew) {
        if (obj_tmdb.credits.crew[i].department === "Directing" && obj_tmdb.credits.crew[i].job === "Director") {
            directors.push(obj_tmdb.credits.crew[i].name)
        }
    document.getElementById("descriptionOfMovieLabelDirector").innerHTML = directors.join(', ');
    }
}


// Actors
var actors = [];
if (obj_tmdb.credits.cast == "") {
    document.getElementById("descriptionOfMovieLabelActors").innerHTML = "Unknown actor(s)";
}
else {
    for (i = 0; i < 3; i++) {
        actors.push(obj_tmdb.credits.cast[i].name);
    }
    document.getElementById("descriptionOfMovieLabelActors").innerHTML = actors.join(', ');
}


// MPAA Rating
for(i in obj_tmdb.releases.countries)
{
    if (obj_tmdb.releases.countries[i].iso_3166_1 === "US" && obj_tmdb.releases.countries[i].certification != '') {
        document.getElementById("mpaaRating").innerHTML = obj_tmdb.releases.countries[i].certification;
        break; 
    } else {
        document.getElementById("mpaaRating").innerHTML = "Unrated";
    }
}


// Runtime
if (obj_tmdb.runtime !== '' && obj_tmdb.runtime !== null) {
    document.getElementById("runtime").innerHTML = obj_tmdb.runtime + " min";
}
else {
    document.getElementById("runtime").innerHTML = "Unknown";
}


// Tagline
if (obj_tmdb.tagline !== '') {
    document.getElementById("tagline").innerHTML = obj_tmdb.tagline;
}
else {
    document.getElementById("tagline").innerHTML = " ";
}


// Plot
if (obj_tmdb.overview !== '') {
    document.getElementById("descriptionOfMovieLabelPlot").innerHTML = obj_tmdb.overview;
}
else {
    document.getElementById("descriptionOfMovieLabelPlot").innerHTML = "Unknown plot";
}


//Genres
//List of genres: https://api.themoviedb.org/3/genre/movie/list?api_key=062a89fc4c3fcc6e928a7ba7ca87074e&language=en-US
var i = "";
var genres = [];
for (i in obj_tmdb.genres){ //Enables loop of all the genres and stores them in 'genres'
    genres.push(obj_tmdb.genres[i].name);
}







//Compiles a list of all non scary movies that show up as thrillers (i.e. James Bond and Mission Impossible)
var nonScaryThriller;
if (movieID_tmdb == 646 /* Dr No */ || movieID_tmdb == 657 /* From Russia With Love */ || movieID_tmdb == 658 /* Goldfinger */ || movieID_tmdb == 660 /* Thunderball */ || movieID_tmdb == 667 /* You Only Live Twice */ || movieID_tmdb == 668 /* On Her Majesty's Secret Service */ || movieID_tmdb == 681 /* Diamonds Are Forever */ || movieID_tmdb == 253 /* Live and Let Die */ || movieID_tmdb == 682 /* The Man With the Golden Gun */ ||movieID_tmdb == 691 /* The Spy Who Loved Me */ || movieID_tmdb == 698 /* Moonraker */ || movieID_tmdb == 699 /* For Your Eyes Only */ || movieID_tmdb == 700 /* Octopussy */ || movieID_tmdb == 36670 /* Never Say Never Again */ || movieID_tmdb == 707 /* A View to a Kill */ || movieID_tmdb == 708 /* The Living Daylights */ || movieID_tmdb == 709 /* License to Kill */ || movieID_tmdb == 710 /* GoldenEye */ || movieID_tmdb == 714 /* Tomorrow Never Dies */ || movieID_tmdb == 36643 /* The World is Not Enough */ || movieID_tmdb == 36669 /* Die Another Day */ || movieID_tmdb == 36557 /* Casino Royale */ || movieID_tmdb == 10764 /* Quantum of Solace */ || movieID_tmdb == 37724 /* Skyfall */ || movieID_tmdb == 954 /* Mission: Impossible */ || movieID_tmdb == 955 /* Mission: Impossible II */ || movieID_tmdb == 956 /* Mission: Impossible III */ || movieID_tmdb == 56292 /* Mission: Impossible - Ghost Protocol */ || movieID_tmdb == 177677 /* Mission: Impossible - Rogue Nation */ || movieID_tmdb == 353081 /* Mission: Impossible - Fallout */){
    nonScaryThriller = true;
}
else {
    nonScaryThriller = false;
}







var allScaryRatingBarsJS = document.getElementById("allScaryRatingBars");
var rateThisMovieTextJS = document.getElementById("rateThisMovieText");
var alreadyRatedForMovieTextJS = document.getElementById("alreadyRatedForMovieText");
var notScaryMovieSectionJS = document.getElementById("notScaryMovieSection");
var genresListJS = document.getElementById("genresList");
var notScaryMovieSubsectionHeadingJS = document.getElementById("notScaryMovieSubsectionHeading");
var notScaryMovieSubsectionBodyJS = document.getElementById("notScaryMovieSubsectionBody");

var alreadyRatedJS = "<?php echo json_encode($AlreadyRated); ?>"; //Transform PHP boolean to JS string of 'true' and 'false'
var alreadyRatedJSBoolean = (alreadyRatedJS === 'true'); //Convert JS variable to boolean

var overallRatingJSCount = "<?php echo $overallRatingPHPCount ?>";
var creepyRatingJSCount = "<?php echo $creepyRatingPHPCount ?>";
var goryRatingJSCount = "<?php echo $goryRatingPHPCount ?>";
var jumpyRatingJSCount = "<?php echo $jumpyRatingPHPCount ?>";

if (obj_tmdb.status == "Released" && (genres.includes("Horror") || genres.includes("Thriller")) && nonScaryThriller == false && overallRatingJSCount !== "0" && creepyRatingJSCount !== "0" && goryRatingJSCount !== "0" && jumpyRatingJSCount !== "0"){
    if (alreadyRatedJSBoolean == true){
        alreadyRatedForMovieTextJS.style.display = "block";
        rateThisMovieTextJS.style.display = "none";
        rateThisMovieTextJS.innerHTML = "";
    }

}
else if (obj_tmdb.status == "Released" && (genres.includes("Horror") || genres.includes("Thriller")) && nonScaryThriller == false && overallRatingJSCount == "0" && creepyRatingJSCount == "0" && goryRatingJSCount == "0" && jumpyRatingJSCount == "0"){
    allScaryRatingBarsJS.style.display = "none";
    notScaryMovieSectionJS.style.display = "inline";
    genresListJS.style.display = "none";
    notScaryMovieSubsectionHeadingJS.innerHTML = "THIS MOVIE HAS NOT YET BEEN RATED";
    notScaryMovieSubsectionBodyJS.innerHTML = "This movie hasn't yet been rated by users. Please click the “Click Here to Rate” button in the top right corner of your screen to rate.";    
}
else if (obj_tmdb.status !== "Released" && (genres.includes("Horror") || genres.includes("Thriller")) && nonScaryThriller == false){
    allScaryRatingBarsJS.style.display = "none";
    rateThisMovieTextJS.style.display = "none";
    rateThisMovieTextJS.innerHTML = "";
    notScaryMovieSectionJS.style.display = "inline";
    genresListJS.style.display = "none";
    notScaryMovieSubsectionHeadingJS.innerHTML = "THIS MOVIE IS UNRELEASED";
    notScaryMovieSubsectionBodyJS.innerHTML = "This movie hasn't yet been released, therefore user votes have not been recorded for it. Please visit this page again once it's been released.";
    ifMovieNoHorror.style.display = "none";
}
else {
    allScaryRatingBarsJS.style.display = "none";
    rateThisMovieTextJS.style.display = "none";
    rateThisMovieTextJS.innerHTML = "";
    notScaryMovieSectionJS.style.display = "inline";
    genresListJS.innerHTML = genres.join('<br>');
    ifMovieNoHorror.style.display = "none";
}




















//SCARY METER DISPLAYS NUMBERS (aka Chris' SUPER Da Vinci Masterpiece WITH PHP) (!!!)


var overallRatingLabelJS = ("<?php echo $overallRatingPHP; ?>"/10).toFixed(1); //Grabs PHP overall rating
document.getElementById("overallScaryMeterRatingNumber").innerHTML = overallRatingLabelJS; //...then display it...
document.getElementById("overallScaryMeterRatingNumbeModal").innerHTML = overallRatingLabelJS; //...then display it...


var creepyRatingLabelJS = ("<?php echo $creepyRatingPHP; ?>"/10).toFixed(1); //Grabs PHP overall rating
if (creepyRatingLabelJS == "10.0") { //If creepy rating is at 100...
    document.getElementById("creepyMeterRatingNumber").innerHTML = "9.0"; //...then display 9.0    
}
else if (creepyRatingLabelJS == "0.0") { //If creepy rating is at 0...
    document.getElementById("creepyMeterRatingNumber").innerHTML = "1.0"; //...then display 1.0
}
else { //Otherwise, do the following
    document.getElementById("creepyMeterRatingNumber").innerHTML = creepyRatingLabelJS;
}


var goryRatingLabelJS = ("<?php echo $goryRatingPHP; ?>"/10).toFixed(1); //Grabs PHP overall rating
if (goryRatingLabelJS == "10.0") { //If creepy rating is at 100...
    document.getElementById("goryMeterRatingNumber").innerHTML = "9.0"; //...then display 9.0    
}
else if (goryRatingLabelJS == "0.0") { //If creepy rating is at 0...
    document.getElementById("goryMeterRatingNumber").innerHTML = "1.0"; //...then display 1.0
}
else {
    document.getElementById("goryMeterRatingNumber").innerHTML = goryRatingLabelJS;
}



var jumpyRatingLabelJS = ("<?php echo $jumpyRatingPHP; ?>"/10).toFixed(1); //Grabs PHP overall rating
if (jumpyRatingLabelJS == "10.0") { //If creepy rating is at 100...
    document.getElementById("jumpyMeterRatingNumber").innerHTML = "9.0"; //...then display 9.0    
}
else if (jumpyRatingLabelJS == "0.0") { //If creepy rating is at 0...
    document.getElementById("jumpyMeterRatingNumber").innerHTML = "1.0"; //...then display 1.0
}
else {
    document.getElementById("jumpyMeterRatingNumber").innerHTML = jumpyRatingLabelJS;
}




var fillOverallScaryMeterBar = document.querySelector(".overallProgressBar");
fillOverallScaryMeterBar.style.width = "<?php echo $overallRatingPercentPHP; ?>";

    //Same code for modal version
    var fillOverallScaryMeterBarModal = document.querySelector(".overallProgressBarModal");
    fillOverallScaryMeterBarModal.style.width = "<?php echo $overallRatingPercentPHP; ?>"; 

var fillCreepyMeterBar = document.querySelector(".creepyProgressBar");
var fillCreepyMeterBarPHP = "<?php echo $creepyRatingPercentPHP; ?>";
if (fillCreepyMeterBarPHP == "100.0000%") {
    fillCreepyMeterBar.style.width = "90%";    
}
else if (fillCreepyMeterBarPHP == "0.0000%") {
    fillCreepyMeterBar.style.width = "10%";
}
else {
    fillCreepyMeterBar.style.width = fillCreepyMeterBarPHP;
}

var fillGoryMeterBar = document.querySelector(".goryProgressBar");
var fillGoryMeterBarPHP = "<?php echo $goryRatingPercentPHP; ?>";
if (fillGoryMeterBarPHP == "100.0000%") {
    fillGoryMeterBar.style.width = "90%";    
}
else if (fillGoryMeterBarPHP == "0.0000%") {
    fillGoryMeterBar.style.width = "10%";
}
else {
    fillGoryMeterBar.style.width = fillGoryMeterBarPHP;
}

var fillJumpyMeterBar = document.querySelector(".jumpyProgressBar");
var fillJumpyMeterBarPHP = "<?php echo $jumpyRatingPercentPHP; ?>";
if (fillJumpyMeterBarPHP == "100.0000%") {
    fillJumpyMeterBar.style.width = "90%";    
}
else if (fillJumpyMeterBarPHP == "0.0000%") {
    fillJumpyMeterBar.style.width = "10%";
}
else {
    fillJumpyMeterBar.style.width = fillJumpyMeterBarPHP;
}







//SLIDER FOR RATING MOVIES - https://www.w3schools.com/howto/howto_js_rangeslider.asp

var overallScaryMeterBarSlider = document.getElementById ("overallSliderRange"); //Create variable to display slider handle at same position as progress bar is full
overallScaryMeterBarSlider.value = "<?php echo $overallRatingPHP; ?>"; //Set slider value to the random number converted to 0-100 scale

var overallSliderRangeNumberOutput = document.getElementById ("overallSliderRangeNumber"); //Create variable to display number (from 0-100) that slider handle is at

overallScaryMeterBarSlider.oninput = function() {
    overallSliderRangeNumberOutput.innerHTML = this.value / 10; //Change slider handle number to display numerically wherever the handle is at and have it change
}



function overallMouseUp() {
    fillOverallScaryMeterBarModal.style.width = overallSliderRangeNumberOutput.innerHTML * 10 + "%";

    var overallSliderRangeNumberOutputLabel = overallSliderRangeNumberOutput.innerHTML;
    if (isNaN(overallSliderRangeNumberOutputLabel)){

    }
    else {
        if (overallSliderRangeNumberOutputLabel.includes(".")) {
            document.getElementById("overallScaryMeterRatingNumbeModal").innerHTML = overallSliderRangeNumberOutputLabel;
        }
        else {
            document.getElementById("overallScaryMeterRatingNumbeModal").innerHTML = overallSliderRangeNumberOutputLabel + ".0";
        }

        overallSliderRangeNumberOutput.innerHTML = "Thanks!"; //When user lifts click, rating is submitted
        
        setTimeout(function(){ //After 300ms, make the subMetersModal appear
            document.getElementById("subMetersModal").style.display = "block";
        }, 300);   
        
    }





    // Check to see whether thumbs up or down is voted

    if (document.getElementById('thumbsUpCreepy').checked) {
        valueCreepy = document.getElementById('thumbsUpCreepy').value;
    }
    else if (document.getElementById('thumbsDownCreepy').checked) {
        valueCreepy = document.getElementById('thumbsDownCreepy').value;
    }
    if (document.getElementById('thumbsUpGory').checked) {
        valueGory = document.getElementById('thumbsUpGory').value;
    }
    else if (document.getElementById('thumbsDownGory').checked) {
        valueGory = document.getElementById('thumbsDownGory').value;
    }
    if (document.getElementById('thumbsUpJumpy').checked) {
        valueJumpy = document.getElementById('thumbsUpJumpy').value;
    }
    else if (document.getElementById('thumbsDownJumpy').checked) {
        valueJumpy = document.getElementById('thumbsDownJumpy').value;
    }



    $(document).ready(function(){ //Begin jQuery

        $("#submitratings").click(function(){ //When the submitratings button is clicked inside the form in the HTML

            var ratingsdata = { //Define what we'll be sending to the ratemovie.php file
                movieidtableAJAX: "<?php echo $movieIdTablePHP ?>",
                ipaddressAJAX: ipAddressJS,
                useroverallAJAX: overallSliderRangeNumberOutputLabel * 10,
                usercreepyAJAX: valueCreepy,
                usergoryAJAX: valueGory,
                userjumpyAJAX: valueJumpy,
                movieidAJAX: "<?php echo $movieIdPHP ?>",
                overallvotecountAJAX: "<?php echo $overallRatingPHPCount ?>"
            };

            $.ajax({ //Begin AJAX asynchronous
                type: "POST", //POST to ratemovie.php
                url: "ratemovie.php", //Tells the ratingsdata data where to go
                data: ratingsdata, //Defines what the data will be
                success: function(){ //If successful, remove the Click Here to Rate text and replace it with the Thanks For Rating text
                    alreadyRatedForMovieTextJS.style.display = "block";
                    alreadyRatedForMovieTextJS.innerHTML = "Thanks For Rating!";
                    rateThisMovieTextJS.style.display = "none";
                    rateThisMovieTextJS.innerHTML = "";
                    $('#rateThisMovieModal').modal('hide'); //Close the modal
                }
            });

            

            return false; //This is necessary for the page not to refresh after the button is pressed. It's the whole reason I'm going through this AJAX mess


        });
    });



};







//THUMBS UP/DOWN SYSTEM

//Grow on hover
$("#thumbsUpImageCreepy").hover(function(){
  $("#thumbsUpImageCreepy").css("transform", "scale(1.2)");
  }, function(){
  $("#thumbsUpImageCreepy").css("transform", "scale(1.0)");
});

$("#thumbsDownImageCreepy").hover(function(){
  $("#thumbsDownImageCreepy").css("transform", "scale(1.2)");
  }, function(){
  $("#thumbsDownImageCreepy").css("transform", "scale(1.0)");
});

$("#thumbsUpImageGory").hover(function(){
  $("#thumbsUpImageGory").css("transform", "scale(1.2)");
  }, function(){
  $("#thumbsUpImageGory").css("transform", "scale(1.0)");
});

$("#thumbsDownImageGory").hover(function(){
  $("#thumbsDownImageGory").css("transform", "scale(1.2)");
  }, function(){
  $("#thumbsDownImageGory").css("transform", "scale(1.0)");
});

$("#thumbsUpImageJumpy").hover(function(){
  $("#thumbsUpImageJumpy").css("transform", "scale(1.2)");
  }, function(){
  $("#thumbsUpImageJumpy").css("transform", "scale(1.0)");
});

$("#thumbsDownImageJumpy").hover(function(){
  $("#thumbsDownImageJumpy").css("transform", "scale(1.2)");
  }, function(){
  $("#thumbsDownImageJumpy").css("transform", "scale(1.0)");
});

//Thumbs aren't highlighted by default (false)
var thumbsUpCreepy = false;
var thumbsDownCreepy = false;

function changeThumbsUpColorCreepy() {
    if (thumbsUpCreepy == false) {
        thumbsUpCreepy = true;
        thumbsDownCreepy = false;
        document.getElementById("thumbsUpImageCreepy").src = "/Images/thumbsup_creepy.png";
        document.getElementById("thumbsUpImageCreepy").style.transform = "scale(1.4)";
        setTimeout(function(){
            document.getElementById("thumbsUpImageCreepy").style.transform = "scale(1)";
        }, 200);
        document.getElementById("thumbsDownImageCreepy").src = "/Images/thumbsdown.png";
    }    
}

function changeThumbsDownColorCreepy() {
    if (thumbsDownCreepy == false) {
        thumbsDownCreepy = true;
        thumbsUpCreepy = false;
        document.getElementById("thumbsDownImageCreepy").src = "/Images/thumbsdown_creepy.png";
        document.getElementById("thumbsDownImageCreepy").style.transform = "scale(1.4)";
        setTimeout(function(){
            document.getElementById("thumbsDownImageCreepy").style.transform = "scale(1)";
        }, 200);
        document.getElementById("thumbsUpImageCreepy").src = "/Images/thumbsup.png";
    }
}

var thumbsUpGory = false;
var thumbsDownGory = false;

function changeThumbsUpColorGory() {
    if (thumbsUpGory == false) {
        thumbsUpGory = true;
        thumbsDownGory = false;
        document.getElementById("thumbsUpImageGory").src = "/Images/thumbsup_gory.png";
        document.getElementById("thumbsUpImageGory").style.transform = "scale(1.4)";
        setTimeout(function(){
            document.getElementById("thumbsUpImageGory").style.transform = "scale(1)";
        }, 200);
        document.getElementById("thumbsDownImageGory").src = "/Images/thumbsdown.png";
    }
}

function changeThumbsDownColorGory() {
    if (thumbsDownGory == false) {
        thumbsDownGory = true;
        thumbsUpGory = false;
        document.getElementById("thumbsDownImageGory").src = "/Images/thumbsdown_gory.png";
        document.getElementById("thumbsDownImageGory").style.transform = "scale(1.4)";
        setTimeout(function(){
            document.getElementById("thumbsDownImageGory").style.transform = "scale(1)";
        }, 200);
        document.getElementById("thumbsUpImageGory").src = "/Images/thumbsup.png";
    }
}

var thumbsUpJumpy = false;
var thumbsDownJumpy = false;

function changeThumbsUpColorJumpy() {
    if (thumbsUpJumpy == false) {
        thumbsUpJumpy = true;
        thumbsDownJumpy = false;
        document.getElementById("thumbsUpImageJumpy").src = "/Images/thumbsup_jumpy.png";
        document.getElementById("thumbsUpImageJumpy").style.transform = "scale(1.4)";
        setTimeout(function(){
            document.getElementById("thumbsUpImageJumpy").style.transform = "scale(1)";
        }, 200);
        document.getElementById("thumbsDownImageJumpy").src = "/Images/thumbsdown.png";
    }
}

function changeThumbsDownColorJumpy() {
    if (thumbsDownJumpy == false) {
        thumbsDownJumpy = true;
        thumbsUpJumpy = false;
        document.getElementById("thumbsDownImageJumpy").src = "/Images/thumbsdown_jumpy.png";
        document.getElementById("thumbsDownImageJumpy").style.transform = "scale(1.4)";
        setTimeout(function(){
            document.getElementById("thumbsDownImageJumpy").style.transform = "scale(1)";
        }, 200);
        document.getElementById("thumbsUpImageJumpy").src = "/Images/thumbsup.png";
    }
}





//Code that changes image for report comment radios

var spoilerButton = false;
var spamButton = false;
var harassmentButton = false;
var hatespeechButton = false;

function reportCommentImageSpoilerFunction() {
    if (spoilerButton == false) {
        spoilerButton = true;
        spamButton = false;
        harassmentButton = false;
        hatespeechButton = false;
        document.getElementById("reportCommentImageSpoiler").src = "/Images/report_spoilers_full.png";
        document.getElementById("reportCommentImageSpam").src = "/Images/report_spam_empty.png";
        document.getElementById("reportCommentImageHarassment").src = "/Images/report_harassment_empty.png";
        document.getElementById("reportCommentImageHatespeech").src = "/Images/report_hatespeech_empty.png";
    }
};
function reportCommentImageSpamFunction() {
    if (spamButton == false) {
        spoilerButton = false;
        spamButton = true;
        harassmentButton = false;
        hatespeechButton = false;
        document.getElementById("reportCommentImageSpoiler").src = "/Images/report_spoilers_empty.png";
        document.getElementById("reportCommentImageSpam").src = "/Images/report_spam_full.png";
        document.getElementById("reportCommentImageHarassment").src = "/Images/report_harassment_empty.png";
        document.getElementById("reportCommentImageHatespeech").src = "/Images/report_hatespeech_empty.png";
    }
};
function reportCommentImageHarassmentFunction() {
    if (harassmentButton == false) {
        spoilerButton = false;
        spamButton = false;
        harassmentButton = true;
        hatespeechButton = false;
        document.getElementById("reportCommentImageSpoiler").src = "/Images/report_spoilers_empty.png";
        document.getElementById("reportCommentImageSpam").src = "/Images/report_spam_empty.png";
        document.getElementById("reportCommentImageHarassment").src = "/Images/report_harassment_full.png";
        document.getElementById("reportCommentImageHatespeech").src = "/Images/report_hatespeech_empty.png";
    }
};
function reportCommentImageHatespeechFunction() {
    if (hatespeechButton == false) {
        spoilerButton = false;
        spamButton = false;
        harassmentButton = false;
        hatespeechButton = true;
        document.getElementById("reportCommentImageSpoiler").src = "/Images/report_spoilers_empty.png";
        document.getElementById("reportCommentImageSpam").src = "/Images/report_spam_empty.png";
        document.getElementById("reportCommentImageHarassment").src = "/Images/report_harassment_empty.png";
        document.getElementById("reportCommentImageHatespeech").src = "/Images/report_hatespeech_full.png";
    }
};









//This is to send email if movie isn't horror

$(document).ready(function(){ //Begin jQuery

    $("#submitemail").click(function(){ //When the submitemail button is clicked inside the form in the HTML
        var emaildata = { //Define what we'll be sending to the sendemail.php file
            movietitle: obj_tmdb.title,
            movieyear: obj_tmdb.release_date,
            movieid: movieID_tmdb,
            ipaddress: ipAddressJS
        };

        $.ajax({ //Begin AJAX asynchronous
            type: "POST", //POST to sendemail.php
            url: "sendemail.php", //Tells the emaildata data where to go
            data: emaildata, //Defines what the data will be
            success: function(){
                $("#emailSent").fadeIn("fast"); //When the button is clicked, fade in quickly the HTML text for emailSent

                setTimeout(function(){ //After 3000ms, fade out the message slowly
                    $("#emailSent").fadeOut("slow");
                }, 3000);
            }
        });

        return false; //This is necessary for the page not to refresh after the button is pressed. It's the whole reason I'm going through this AJAX mess
    });
});




//On page load, send release date of movie to allmovies table
$(document).ready(function(){
    var onpageload = {
        releasedateAJAX: obj_tmdb.release_date,
        movieidAJAX: "<?php echo $movieIdPHP ?>"
    };

    $.ajax({
        type: "POST",
        url: "indexpageload.php",
        data: onpageload
    });
});








//The following code allows a comment to be posted just by clicking the enter button

var submitCommentButtonJS = document.getElementById("submitCommentButton");

function postCommentWithEnter(e){
    if(e.keyCode == 13) {
        submitCommentButtonJS.click();
        return false; // returning false will prevent the event from bubbling up.
    }
    else {
        return true;
    }
};


// THis code prevents hitting enter from submitting the PHP form

$('#frm-comment').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});






var movieIdCommentTableJS = "<?php echo $movieIdCommentTablePHP ?>";

$(document).ready(function(){

    $("#submitCommentButton").click(function(){ //Clicking submit will insert a comment
        
        // Check to see if the spoiler checkbox is checked
        var isSpoiler;
        if (document.getElementById('isSpoilerCheckbox').checked) {
            isSpoiler = 1;
        }
        else {
            isSpoiler = 0;
        }

        var commentformdata = $('#frm-comment').serialize() + "&movieidcommenttable=" + movieIdCommentTableJS + "&ipaddressAJAX=" + ipAddressJS + "&isspoilerAJAX=" + isSpoiler;
        $.ajax({
            type: "POST",
            url: "addcomment.php",
            data: commentformdata,
            success: function(){
                $("#comment").val("");
                $("#comment").focus();
                listComments();
            }
        });

        return false; //This is necessary for the page not to refresh after the button is pressed. It's the whole reason I'm going through this AJAX mess
    });
});






//Creates boolean that informs whether the user wants to hide or show spoilers, as well as changing the button's label

var showSpoilers = false;

function showHideSpoilers() {
    if (showSpoilers == false){
        showSpoilers = true;
        document.getElementById("showSpoilersButton").innerHTML = "Hide Spoilers";
    }
    else {
        showSpoilers = false;
        document.getElementById("showSpoilersButton").innerHTML = "Show Spoilers";
    }
};



function listComments() { //Create function that can list all the comments
    $(document).ready(function(){

        $.ajax({
            type: "GET",
            data: {
                movieidcommenttable: movieIdCommentTableJS
            },
            url: "displaycomment.php",
            success: function(response){
                var commentObj = JSON.parse(response);
                var displayComments = "";
                for (i in commentObj.isspoiler) { //Creates for loop of the parsed JSON sent from displaycomment.php

                    //Conditions to see if a comment contains a spoiler and if so, also checks whether user wants to see spoiler, and displays accordingly
                    if (commentObj.isspoiler[i] == 0) {
                        displayComments += 
                            "<div class='comment-row'>" + 
                                "<div class='comment-info'>" + 
                                    "<span class='commet-row-label'>from</span> " + 
                                    "<span class='posted-by'>" + commentObj.commentsendername[i] + " </span>" + 
                                    "<span class='commet-row-label'>at</span> " + 
                                    "<span class='posted-at'>" + commentObj.date[i] + "</span>&nbsp;&nbsp;&nbsp;" + 
                                    "<span data-toggle='modal' data-target='#reportCommentModal' id='reportCommentText'>Report comment</span>" + 
                                    "<span id='commentIdDisplay' style='visibility: hidden;'>" + commentObj.commentid[i] + "</span>" + 
                                    "<span id='isSpoilerDisplay' style='visibility: hidden;'>" + commentObj.isspoiler[i] + "</span>" + 
                                "</div>" + 
                                "<div id='comment-text'>" + commentObj.comment[i] + "</div>" + 
                            "</div>";
                    }
                    else if (commentObj.isspoiler[i] == 1 && showSpoilers == false) {
                        displayComments += 
                            "<div class='comment-row'>" + 
                                "<div class='comment-info'>" + 
                                    "<span class='commet-row-label'>from</span> " + 
                                    "<span class='posted-by'>" + commentObj.commentsendername[i] + " </span>" + 
                                    "<span class='commet-row-label'>at</span> " + 
                                    "<span class='posted-at'>" + commentObj.date[i] + "</span>&nbsp;&nbsp;&nbsp;" + 
                                    "<span data-toggle='modal' data-target='#reportCommentModal' id='reportCommentText'>Report comment</span>" + 
                                    "<span id='commentIdDisplay' style='visibility: hidden;'>" + commentObj.commentid[i] + "</span>" + 
                                    "<span id='isSpoilerDisplay' style='visibility: hidden;'>" + commentObj.isspoiler[i] + "</span>" + 
                                "</div>" + 
                                '<div id="comment-text">This comment contains spoilers! Click the "Show Spoilers" button to reveal it</div>' + 
                            "</div>";
                    }
                    else if (commentObj.isspoiler[i] == 1 && showSpoilers == true) {
                        displayComments += 
                            "<div class='comment-row'>" + 
                                "<div class='comment-info'>" + 
                                    "<span class='commet-row-label'>from</span> " + 
                                    "<span class='posted-by'>" + commentObj.commentsendername[i] + " </span>" + 
                                    "<span class='commet-row-label'>at</span> " + 
                                    "<span class='posted-at'>" + commentObj.date[i] + "</span>&nbsp;&nbsp;&nbsp;" + 
                                    "<span data-toggle='modal' data-target='#reportCommentModal' id='reportCommentText'>Report comment</span>" + 
                                    "<span id='commentIdDisplay' style='visibility: hidden;'>" + commentObj.commentid[i] + "</span>" + 
                                    "<span id='isSpoilerDisplay' style='visibility: hidden;'>" + commentObj.isspoiler[i] + "</span>" + 
                                "</div>" + 
                                "<div id='comment-text'>" + commentObj.comment[i] + "</div>" + 
                            "</div>";
                    }
                }
                $("#responsecontainer").html(displayComments);
            }
        });
    });
};











listComments(); //List comments onto the page

window.setInterval(function(){ //Every quarter second, refresh the comment list in the page to enable live chatting
  listComments();
}, 250);











function checkReportCommentValue() {


    // Check to see for what reason comment is being reported

    var reportCommentValue;

    if (document.getElementById('reportcommentspoiler').checked) {
        reportCommentValue = document.getElementById('reportcommentspoiler').value;
    }
    else if (document.getElementById('reportcommentspam').checked) {
        reportCommentValue = document.getElementById('reportcommentspam').value;
    }
    else if (document.getElementById('reportcommentharassment').checked) {
        reportCommentValue = document.getElementById('reportcommentharassment').value;
    }
    else if (document.getElementById('reportcommenthatespeech').checked) {
        reportCommentValue = document.getElementById('reportcommenthatespeech').value;
    }





    //This is to send email if comment is reported

    $(document).ready(function(){

        $("#submitreportedcomment").click(function(){
            var reportedcommentdata = {
                movietitle: obj_tmdb.title,
                movieyear: obj_tmdb.release_date,
                movieid: movieID_tmdb,
                ipaddress: ipAddressJS,
                reportcommentvalueAJAX: reportCommentValue,
                movieidcommenttableAJAX: movieIdCommentTableJS
            };

            $.ajax({
                type: "POST",
                url: "sendemailreportcomment.php",
                data: reportedcommentdata,
                success: function(){
                    $('#reportCommentModal').modal('hide'); //Close the modal
                }
            });

            return false;
        });
    });

};









</script>

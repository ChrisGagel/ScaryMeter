// SHOW SEARCH RESULTS IN INPUT FIELD
// https://stackoverflow.com/questions/21530063/how-do-we-set-remote-in-typeahead-js
// Instantiate the Bloodhound suggestion engine
var movies = new Bloodhound({
    datumTokenizer: function (datum) {
        return Bloodhound.tokenizers.whitespace(datum.value);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        wildcard: '%QUERY',
        url: 'http://api.themoviedb.org/3/search/movie?query=%QUERY&api_key=062a89fc4c3fcc6e928a7ba7ca87074e',
        transform: function (response) {
            // Map the remote source JSON array to a JavaScript object array
            return $.map(response.results, function (movie) {
                return {
                    //value: movie.id + " - " + movie.title,
                    value1: movie.id,
                    value2: movie.title,
                    value3: parseInt(movie.release_date)
                };
            });
        }
    }
});


// HTML submit button sends same-value displayed to URL

// Instantiate the Typeahead UI
//TRY THESE:
//https://stackoverflow.com/questions/21895025/use-different-value-from-json-data-instead-of-displaykey-using-typeahead
//https://github.com/running-coder/jquery-typeahead/issues/168
//https://stackoverflow.com/questions/14136973/bootstrap-typeahead-return-name-and-id/14166308
//https://stackoverflow.com/questions/28229348/bootstrap-typeahead-bloodhound-return-name-and-id
//https://stackoverflow.com/questions/14136973/bootstrap-typeahead-return-name-and-id/14166308
//https://github.com/twitter/typeahead.js/issues/1453
//https://github.com/twitter/typeahead.js/issues/193
//https://twitter.github.io/typeahead.js/examples/#custom-templates GO TO CUSTOM TEMPLATES
//https://stackoverflow.com/questions/32552948/update-a-hidden-input-field-with-typeahead-js-and-json-key-values
//https://stackoverflow.com/questions/29223516/typeahead-custom-template-without-handlebars THIS SORTA KINDA WORKED!!!
//We need to look into a hidden field using typeahead
//Here might be the best tutorial: https://stackoverflow.com/questions/12389948/twitter-bootstrap-typeahead-id-label
//http://kylefinley.net/twitter-typeahead-using-id-of-selected-item-label
//https://stackoverflow.com/questions/35402487/bootstrap-3-typeahead-afterselect-get-id
//http://embed.plnkr.co/EXP0JTP11aiw8JpcdFFh
//https://stackoverflow.com/questions/36340499/bootstrap-typeahead-show-different-text-in-box-once-selected




$('.typeahead').typeahead(null, {
    display: "value1",
    source: movies,
    templates: {
        suggestion: function (movie) {
            return '<p>' + movie.value2 + ' - ' + movie.value3 + '</p>';
        }
    }
})

/*
$('.typeahead').typeahead(null, {
    display: "value",
    source: movies,
    }
})
*/








// TMDB 49026 694

//https://stackoverflow.com/questions/901115/how-can-i-get-query-string-values-in-javascript
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
var backdropPathImgSize_tmdb = "original"; //Use CONFIG command to find appropriate size
var backdropPath_tmdb = obj_tmdb.backdrop_path;
var backdrop_tmdb = backdropBaseURL_tmdb + backdropPathImgSize_tmdb + "/" + backdropPath_tmdb; //Add &append_to_response=credits

// Write backdrop path
document.getElementById("imageCoverPhotoBackground").style.backgroundImage = "url("+backdrop_tmdb+")";

// Path for similarly rated movies cover photos
document.getElementById("similarlyRatedMoviesCoverPhoto1").src = backdrop_tmdb;
document.getElementById("similarlyRatedMoviesCoverPhoto2").src = backdrop_tmdb;
document.getElementById("similarlyRatedMoviesCoverPhoto3").src = backdrop_tmdb;
document.getElementById("similarlyRatedMoviesCoverPhoto4").src = backdrop_tmdb;
document.getElementById("similarlyRatedMoviesCoverPhoto5").src = backdrop_tmdb;
document.getElementById("similarlyRatedMoviesCoverPhoto6").src = backdrop_tmdb;

// Build and write poster path
var poster_tmdb = backdropBaseURL_tmdb + backdropPathImgSize_tmdb + "/" + obj_tmdb.poster_path;
document.getElementById("moviePoster").src = poster_tmdb;

// Date
document.getElementById("movieYearLabel").innerHTML = parseInt(obj_tmdb.release_date);

// Title
document.getElementById("movieTitleLabel").innerHTML = obj_tmdb.title;
document.getElementById("movieTitleLabelModal").innerHTML = obj_tmdb.title;

// Directors
var directors = [];
for (i in obj_tmdb.credits.crew) {
    if (obj_tmdb.credits.crew[i].department === "Directing" &&
        obj_tmdb.credits.crew[i].job === "Director") {
        directors.push(obj_tmdb.credits.crew[i].name)
    }
}
document.getElementById("descriptionOfMovieLabelDirector").innerHTML = directors.join(', ');


// Actors
var actors = [];
//for(i in obj_tmdb.credits.cast)
for (i = 0; i < 3; i++) 
{
    actors.push(obj_tmdb.credits.cast[i].name);
}
document.getElementById("descriptionOfMovieLabelActors").innerHTML = actors.join(', ');


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
document.getElementById("runtime").innerHTML = obj_tmdb.runtime + " min";

// Tagline
document.getElementById("tagline").innerHTML = obj_tmdb.tagline;

// Plot
document.getElementById("descriptionOfMovieLabelPlot").innerHTML = obj_tmdb.overview;














//SCARY METER NUMBER RANDOMIZER AND DISPLAYS NUMBERS (aka Chris' Da Vinci Masterpiece) (!!!)

var overallRandomNumber = Math.round(Math.random() * 100) / 10; //Creates random number between 0.0 and 10.0, inclusive
var overallRandomNumberString = overallRandomNumber.toString(); //Converts random number to string
if (overallRandomNumberString.includes(".")) { //If random number has a decimal in it...
document.getElementById("overallScaryMeterRatingNumber").innerHTML = overallRandomNumber; //...then display it...
}
else {
document.getElementById("overallScaryMeterRatingNumber").innerHTML = overallRandomNumber + ".0"; //...otherwise add a .0 at end
}

    //Same code for modal version
    if (overallRandomNumberString.includes(".")) {
    document.getElementById("overallScaryMeterRatingNumbeModal").innerHTML = overallRandomNumber;
    }
    else {
    document.getElementById("overallScaryMeterRatingNumbeModal").innerHTML = overallRandomNumber + ".0";
    }

var creepyRandomNumber = Math.round(Math.random() * 100) / 10;
var creepyRandomNumberString = creepyRandomNumber.toString();
if (creepyRandomNumberString.includes(".")) {
document.getElementById("creepyMeterRatingNumber").innerHTML = creepyRandomNumber;
}
else {
document.getElementById("creepyMeterRatingNumber").innerHTML = creepyRandomNumber + ".0";
}

var goryRandomNumber = Math.round(Math.random() * 100) / 10;
var goryRandomNumberString = goryRandomNumber.toString();
if (goryRandomNumberString.includes(".")) {
document.getElementById("goryMeterRatingNumber").innerHTML = goryRandomNumber;
}
else {
document.getElementById("goryMeterRatingNumber").innerHTML = goryRandomNumber + ".0";
}

var jumpyRandomNumber = Math.round(Math.random() * 100) / 10;
var jumpyRandomNumberString = jumpyRandomNumber.toString();
if (jumpyRandomNumberString.includes(".")) {
document.getElementById("jumpyMeterRatingNumber").innerHTML = jumpyRandomNumber;
}
else {
document.getElementById("jumpyMeterRatingNumber").innerHTML = jumpyRandomNumber + ".0";
}



var fillOverallScaryMeterBar = document.querySelector(".overallProgressBar"); //Create variable to show how full the progress bar is based on progress bar class style
fillOverallScaryMeterBar.style.width = overallRandomNumber * 10 + "%"; //Set width of variable (how full bar is) to the random number converted to a 0-100% scale

    //Same code for modal version
    var fillOverallScaryMeterBarModal = document.querySelector(".overallProgressBarModal");
    fillOverallScaryMeterBarModal.style.width = overallRandomNumber * 10 + "%"; 

var fillCreepyMeterBar = document.querySelector(".creepyProgressBar");
fillCreepyMeterBar.style.width = creepyRandomNumber * 10 + "%";

var fillGoryMeterBar = document.querySelector(".goryProgressBar");
fillGoryMeterBar.style.width = goryRandomNumber * 10 + "%";

var fillJumpyMeterBar = document.querySelector(".jumpyProgressBar");
fillJumpyMeterBar.style.width = jumpyRandomNumber * 10 + "%";








//SLIDER FOR RATING MOVIES - https://www.w3schools.com/howto/howto_js_rangeslider.asp

//This jQuery script makes it so the user ratings appear upon hover
/*
$(".scaryMeterRatingModal").hover(function(){
  $(".slidecontainer").css("opacity", "1");
  }, function(){
  $(".slidecontainer").css("opacity", "0");
});
*/

var overallScaryMeterBarSlider = document.getElementById ("overallSliderRange"); //Create variable to display slider handle at same position as progress bar is full
overallScaryMeterBarSlider.value = overallRandomNumber * 10; //Set slider value to the random number converted to 0-100 scale

var overallSliderRangeNumberOutput = document.getElementById ("overallSliderRangeNumber"); //Create variable to display number (from 0-100) that slider handle is at

overallScaryMeterBarSlider.oninput = function() {
    overallSliderRangeNumberOutput.innerHTML = this.value / 10; //Change slider handle number to display numerically wherever the handle is at and have it change
}

function overallMouseUp() {
    fillOverallScaryMeterBarModal.style.width = overallSliderRangeNumberOutput.innerHTML * 10 + "%";

    var overallSliderRangeNumberOutputLabel = overallSliderRangeNumberOutput.innerHTML;
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
    else {
        thumbsUpCreepy = false;
        document.getElementById("thumbsUpImageCreepy").src = "/Images/thumbsup.png";
        document.getElementById("thumbsUpImageCreepy").style.transform = "scale(1.4)";
        setTimeout(function(){
            document.getElementById("thumbsUpImageCreepy").style.transform = "scale(1)";
        }, 200);
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
    else {
        thumbsDownCreepy = false;
        document.getElementById("thumbsDownImageCreepy").src = "/Images/thumbsdown.png";
        document.getElementById("thumbsDownImageCreepy").style.transform = "scale(1.4)";
        setTimeout(function(){
            document.getElementById("thumbsDownImageCreepy").style.transform = "scale(1)";
        }, 200);
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
    else {
        thumbsUpGory = false;
        document.getElementById("thumbsUpImageGory").src = "/Images/thumbsup.png";
        document.getElementById("thumbsUpImageGory").style.transform = "scale(1.4)";
        setTimeout(function(){
            document.getElementById("thumbsUpImageGory").style.transform = "scale(1)";
        }, 200);
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
    else {
        thumbsDownGory = false;
        document.getElementById("thumbsDownImageGory").src = "/Images/thumbsdown.png";
        document.getElementById("thumbsDownImageGory").style.transform = "scale(1.4)";
        setTimeout(function(){
            document.getElementById("thumbsDownImageGory").style.transform = "scale(1)";
        }, 200);
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
    else {
        thumbsUpJumpy = false;
        document.getElementById("thumbsUpImageJumpy").src = "/Images/thumbsup.png";
        document.getElementById("thumbsUpImageJumpy").style.transform = "scale(1.4)";
        setTimeout(function(){
            document.getElementById("thumbsUpImageJumpy").style.transform = "scale(1)";
        }, 200);
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
    else {
        thumbsDownJumpy = false;
        document.getElementById("thumbsDownImageJumpy").src = "/Images/thumbsdown.png";
        document.getElementById("thumbsDownImageJumpy").style.transform = "scale(1.4)";
        setTimeout(function(){
            document.getElementById("thumbsDownImageJumpy").style.transform = "scale(1)";
        }, 200);
    }
}
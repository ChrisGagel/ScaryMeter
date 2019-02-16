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
                    value: movie.id + "-" + movie.title
                };
            });
        }
    }
});

// HTML submit button sends same-value displayed to URL

// Instantiate the Typeahead UI
$('.typeahead').typeahead(null, {
    display: "value",
    source: movies
})







// TMDB 49026 694

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
//document.getElementById("imageCoverPhotoBackground").src = backdrop_tmdb;
document.getElementById("imageCoverPhotoBackground").style.backgroundImage = "url("+backdrop_tmdb+")";

// Build and write poster path
var poster_tmdb = backdropBaseURL_tmdb + backdropPathImgSize_tmdb + "/" + obj_tmdb.poster_path;
document.getElementById("moviePoster").src = poster_tmdb;

// Date
document.getElementById("movieYearLabel").innerHTML = parseInt(obj_tmdb.release_date);

// Title
document.getElementById("movieTitleLabel").innerHTML = obj_tmdb.title;

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
//var plot_tmdb = obj_tmdb.overview;
//var plotLength_tmdb = plot_tmdb.length;













//SCARY METER NUMBER RANDOMIZER AND DISPLAYS NUMBERS (aka Chris' Da Vinci Masterpiece) (!!!)

var overallRandomNumber = Math.round(Math.random() * 100) / 10; //Creates random number between 0.0 and 10.0, inclusive
var overallRandomNumberString = overallRandomNumber.toString(); //Converts random number to string
if (overallRandomNumberString.includes(".")) { //If random number has a decimal in it...
document.getElementById("overallScaryMeterRatingNumber").innerHTML = overallRandomNumber; //...then display it...
}
else {
document.getElementById("overallScaryMeterRatingNumber").innerHTML = overallRandomNumber + ".0"; //...otherwise add a .0 at end
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

var fillCreepyMeterBar = document.querySelector(".creepyProgressBar");
fillCreepyMeterBar.style.width = creepyRandomNumber * 10 + "%";

var fillGoryMeterBar = document.querySelector(".goryProgressBar");
fillGoryMeterBar.style.width = goryRandomNumber * 10 + "%";

var fillJumpyMeterBar = document.querySelector(".jumpyProgressBar");
fillJumpyMeterBar.style.width = jumpyRandomNumber * 10 + "%";




//SLIDER FOR RATING MOVIES - https://www.w3schools.com/howto/howto_js_rangeslider.asp

var overallScaryMeterBarSlider = document.getElementById ("overallSliderRange"); //Create variable to display slider handle at same position as progress bar is full
overallScaryMeterBarSlider.value = overallRandomNumber * 10; //Set slider value to the random number converted to 0-100 scale

var overallSliderRangeNumberOutput = document.getElementById ("overallSliderRangeNumber"); //Create variable to display number (from 0-100) that slider handle is at
//overallSliderRangeNumberOutput.innerHTML = overallScaryMeterBarSlider.value; //Display slider handle number upon load - NOT NECESSARY

overallScaryMeterBarSlider.oninput = function() {
    overallSliderRangeNumberOutput.innerHTML = this.value; //Change slider handle number to display numerically wherever the handle is at and have it change
}

function overallMouseUp() {
    overallSliderRangeNumberOutput.innerHTML = "Submitted"; //When user lifts click, rating is submitted
}
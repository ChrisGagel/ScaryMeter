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
                    value: movie.id
                };
            });
        }
    }
});


// Instantiate the Typeahead UI
$('.typeahead').typeahead(null, {
    display: 'value',
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
document.getElementById("imageCoverPhotoBackground").src = backdrop_tmdb;

// Build and write poster path
var poster_tmdb = backdropBaseURL_tmdb + backdropPathImgSize_tmdb + "/" + obj_tmdb.poster_path;
document.getElementById("moviePosterPhotoChild").src = poster_tmdb;

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
        document.getElementById("mpaaRating").innerHTML = "Rated " + obj_tmdb.releases.countries[i].certification;
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




// Search for PRIDE & PREJUDICE and you'll see why we need to use only TMDB...
/*
// OMDB
var baseURL_omdb = "http://www.omdbapi.com/?t=";
var searchStr = obj_tmdb.title.replace(/\s+/g, '+').toLowerCase();
var apiKey_omdb = "&plot=full&apikey=2ce77814";
var query_omdb = baseURL_omdb + searchStr + apiKey_omdb;

var xhr_omdb = new XMLHttpRequest();
//xhr_omdb.open("GET", "http://www.omdbapi.com/?t=spider+man+homecoming&plot=full&apikey=2ce77814", false);
xhr_omdb.open("GET", query_omdb, false);
xhr_omdb.send();

var obj_omdb = JSON.parse(xhr_omdb.responseText);

// SWITCH OVER ENTIRELY TO TMDB!!!
//document.getElementById("descriptionOfMovieLabelDirector").innerHTML = obj_omdb.Director;
//document.getElementById("descriptionOfMovieLabelActors").innerHTML = obj_omdb.Actors;
//document.getElementById("descriptionOfMovieLabelPlot").innerHTML = obj_omdb.Plot;
var plot_omdb = obj_omdb.Plot;
var plotLength_omdb = plot_omdb.length;

DO NOT TOUCH!!! (CHRIS' PICASSO MASTERPIECE)
// Plot selector based on character count
if (plotLength_omdb >= plotLength_tmdb) {
    document.getElementById("descriptionOfMovieLabelPlot").innerHTML = obj_omdb.Plot;
}
else {
    document.getElementById("descriptionOfMovieLabelPlot").innerHTML = obj_tmdb.overview;
}
document.getElementById("descriptionOfMovieLabelPlot").innerHTML = obj_tmdb.overview;
*/








// Animate meters
$(function() {
    $(".overallScaryMeterRatingBar > span").each(function() {
        var w = this.style.width; 
        $(this)
            .data("origWidth", w)
            .width(0)
            .animate({
                width: $(this).data("origWidth")
            }, 1200);
    });
});
$(function() {
    $(".subScaryMeterRatingBar > span").each(function() {
        var w = this.style.width; 
        $(this)
            .data("origWidth", w)
            .width(0)
            .animate({
                width: $(this).data("origWidth")
            }, 1200);
    });
});




//SCARY METER NUMBER RANDOMIZER

var x = Math.floor((Math.random() * 100) + 1);
document.getElementById("overallRandomNumber").innerHTML = x;





var myElement = document.querySelector(".progress-bar");
myElement.style.backgroundColor = "#D93600";
myElement.style.width = x + "%";







//THIS NEXT CODE IS BROKEN ********** PLACE ALL NEW CODE BEFORE IT
// TEST SLIDER FOR RATING MOVIES - https://www.w3schools.com/howto/howto_js_rangeslider.asp

var slider = document.getElementById("myRange");
var output = document.getElementById("demo");
output.innerHTML = slider.value; // Display the default slider value

// Update the current slider value (each time you drag the slider handle)
slider.oninput = function() {
  output.innerHTML = this.value;
}








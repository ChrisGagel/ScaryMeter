// TMDB
var baseURL_tmdb = "https://api.themoviedb.org/3/movie/"
var movieID_tmdb = 11036; //Change ID to change movie details
var apiKey_tmdb = "062a89fc4c3fcc6e928a7ba7ca87074e"

// Build TMDB query string 
var movieQueryURL_tmdb = baseURL_tmdb + movieID_tmdb + "?api_key=" + apiKey_tmdb;

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

// Build poster path
var poster_tmdb = backdropBaseURL_tmdb + backdropPathImgSize_tmdb + "/" + obj_tmdb.poster_path;
document.getElementById("moviePosterPhotoChild").src = poster_tmdb;

// Date
var year = parseInt(obj_tmdb.release_date);
document.getElementById("movieYearLabel").innerHTML = year;

// Title
document.getElementById("movieTitleLabel").innerHTML = obj_tmdb.title;

// Plot
//document.getElementById("descriptionOfMovieLabelPlot").innerHTML = obj_tmdb.overview;
var plot_tmdb = obj_tmdb.overview;
var plotLength_tmdb = plot_tmdb.length;



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

document.getElementById("descriptionOfMovieLabelDirector").innerHTML = obj_omdb.Director;
document.getElementById("descriptionOfMovieLabelActors").innerHTML = obj_omdb.Actors;
//document.getElementById("descriptionOfMovieLabelPlot").innerHTML = obj_omdb.Plot;
var plot_omdb = obj_omdb.Plot;
var plotLength_omdb = plot_omdb.length;



// Plot selector based on character count
if (plotLength_omdb >= plotLength_tmdb) {
    document.getElementById("descriptionOfMovieLabelPlot").innerHTML = obj_omdb.Plot;
}
else {
    document.getElementById("descriptionOfMovieLabelPlot").innerHTML = obj_tmdb.overview;
}





// window.alert(xhr.status);
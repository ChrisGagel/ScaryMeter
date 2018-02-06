//TMDB
var baseURL_tmdb = "https://api.themoviedb.org/3/movie/"
var movieID_tmdb = 315635; // change ID to change movie details
var apiKey_tmdb = "062a89fc4c3fcc6e928a7ba7ca87074e"
// build tmdb query string 
var movieQueryURL_tmdb = baseURL_tmdb + movieID_tmdb + "?api_key=" + apiKey_tmdb;
// get response from TMDB
var xhr_TMDB = new XMLHttpRequest();
xhr_TMDB.open("GET", movieQueryURL_tmdb, false);
xhr_TMDB.send();
// parse TMDB response
var obj_tmdb = JSON.parse(xhr_TMDB.responseText);

// Build tmdb backdrop path string
var backdropBaseURL_tmdb = "https://image.tmdb.org/t/p/";
var backdropPathImgSize_tmdb = "original"; //use CONFIG command to find appropriate size
var backdropPath_tmdb = obj_tmdb.backdrop_path;
var backdrop_tmdb = backdropBaseURL_tmdb + backdropPathImgSize_tmdb + "/" + backdropPath_tmdb; // add &append_to_response=credits
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
document.getElementById("descriptionOfMovieLabelPlot").innerHTML = obj_tmdb.overview;



//OMDB
var baseURL_omdb = "http://www.omdbapi.com/?t=";
var searchStr = obj_tmdb.title.replace(/\s+/g, '+').toLowerCase();
var apiKey_omdb = "&plot=full&apikey=2ce77814";
var query_omdb = baseURL_omdb + searchStr + apiKey_omdb;

var xhr_test = new XMLHttpRequest();
//xhr_test.open("GET", "http://www.omdbapi.com/?t=spider+man+homecoming&plot=full&apikey=2ce77814", false);
xhr_test.open("GET", query_omdb, false);
xhr_test.send();

var obj = JSON.parse(xhr_test.responseText);

document.getElementById("descriptionOfMovieLabelDirector").innerHTML = obj.Director;
document.getElementById("descriptionOfMovieLabelActors").innerHTML = obj.Actors;
//document.getElementById("descriptionOfMovieLabelPlot").innerHTML = obj.Plot;




// window.alert(xhr.status);
var xhr = new XMLHttpRequest();
xhr.open("GET", "http://www.omdbapi.com/?apikey=2ce77814&", false);
xhr.send();

window.alert(xhr.status);
window.alert(xhr.statusText); 

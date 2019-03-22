//This function works on my MacBook and iPhone and iPad and Saumsung Android Tablet - https://stackoverflow.com/questions/11381673/detecting-a-mobile-browser
function detectmob() { 
 if( navigator.userAgent.match(/Android/i)
 || navigator.userAgent.match(/webOS/i)
 || navigator.userAgent.match(/iPhone/i)
 || navigator.userAgent.match(/iPad/i)
 || navigator.userAgent.match(/iPod/i)
 || navigator.userAgent.match(/BlackBerry/i)
 || navigator.userAgent.match(/Windows Phone/i)
 ){
    return true;
  }
 else {
    return false;
  }
}

if (detectmob() == true){
    document.location = "index_mobile.html";
}
else if(detectmob() == false){

}
else {
    document.location = "index_mobile.html";
}
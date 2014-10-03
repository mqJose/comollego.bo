function initialize() {
    var mapOptions = {
        zoom: 14,
        center: puntos[0]
    };
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    marcamos_paradas(puntos,id);
}

function marcamos_paradas(a,b) {
    for(var i=0;i<a.length;i++) {
        placeMarker(a[i],map,b[i]);
    }
}
function placeMarker(pos,map,x) {
    var marker = new google.maps.Marker({position: pos,map: map,title:x});
    google.maps.event.addListener(marker, 'click', function()
    {
        alert(x);
    });
}
google.maps.event.addDomListener(window, 'load', initialize);
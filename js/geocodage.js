if(document.getElementById("address")){
let lat = 0;
let lon = 0;
var send = $_id("send"),

	    address = $_id("address"),
	    output = $_id("output");
        console.log($('#adress').val());
	
		output.innerHTML = "";
		var conf = {
			singleFieldSearch : address.value
		};
		var displayError = function () {
			output.innerHTML = "<div>Une erreur s'est produite.</div>";
		};
        
		var callbacks = {
			onSuccess : function (results) {
				var coords = results[0].coords,	html = "";
				html += "<div>Longitude : " + coords.lon + "</div>";
				html += "<div>Latitude : " + coords.lat + "</div>";
				output.innerHTML = html;
                lat = coords.lat;
                lon = coords.lon;
                
                mapboxgl.accessToken = 'pk.eyJ1IjoiY2ljZXJvbiIsImEiOiJja3E1Yzc1MHEwOXQyMm9xb2gycjc1Ym1wIn0.fJ96rmd0A6bixomAUx5ZTQ';
                var map = new mapboxgl.Map({
                container: 'mapid',
                width: 750,
                height: 500,
                style: 'mapbox://styles/mapbox/streets-v11',
                center: [lon,lat],
                zoom: 13
                });
                VMLaunch("ViaMichelin.Api.Geocoding", map);
			},
			onError : displayError,
			onInitError : displayError
		};
		VMLaunch("ViaMichelin.Api.Geocoding", conf, callbacks);
        
	};

    // staticClient.getStaticImage({
    //     ownerId: 'mapbox',
    //     styleId: 'streets-v11',
    //     width: 200,
    //     height: 300,
    //     position: {
    //       coordinates: [2.35111, 48.85682],
    //       zoom: 14
    //     }
    //   })
    //     .send()
    //     .then(response => {
    //       const image = response.html;
    //     });

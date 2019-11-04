function initMap() {
	
	let lat = document.getElementById("lat");
	let lng = document.getElementById("lng");
	if(lat){
		lat = Number(lat.value);
		lng = Number(lng.value);

		var uluru = {lat: lat, lng: lng};

		// The map, centered at Uluru

		var map = new google.maps.Map(

				document.getElementById('map-canvas'), {zoom: 15, center: uluru});

		// The marker, positioned at Uluru

		var marker = new google.maps.Marker({position: uluru, map: map});
		}
	
	var input = document.getElementById('place');
  var autocomplete = new google.maps.places.Autocomplete(input);
	
	
}

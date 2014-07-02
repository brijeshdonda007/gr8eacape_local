<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

<script type="text/javascript">

	var geocoder = new google.maps.Geocoder();



function geocodePosition(pos) {

  geocoder.geocode({

    latLng: pos

  }, function(responses) {

    if (responses && responses.length > 0) {

      //updateMarkerStatus('Click and drag the marker.');

    } else {

      //updateMarkerStatus('Cannot determine address at this location.');

    }

  });

}



function updateMarkerStatus(str) {

  document.getElementById('status').innerHTML = str;

}



function updateMarkerPosition(latLng) {

  		$('#longitude').val(latLng.lng());

		$('#latitude').val(latLng.lat());

}



var map;

var marker;

function initialize() {

  var latLng = new google.maps.LatLng(<?php echo (trim(@$general_info_ID->latitude) != '')?@$general_info_ID->lattitude:'-36.84815';?>,<?php echo (trim(@$general_info_ID->longitude) != '')?@$general_info_ID->longitude:'174.74365';?>);

  map = new google.maps.Map(document.getElementById('map'), {

    zoom: 15,

    center: latLng,

    disableDefaultUI: true,

    mapTypeId: google.maps.MapTypeId.ROADMAP,

    disableDefaultUI: true,

    panControl: false,

    zoomControl: true,

    scaleControl: false



  });

  marker = new google.maps.Marker({

    position: latLng,

    title: 'Point A',

    map: map,

    draggable: true

  });



  // Update current position info.

  updateMarkerPosition(latLng);

  geocodePosition(latLng);



  // Add dragging event listeners.

  google.maps.event.addListener(marker, 'dragstart', function() {

    //updateMarkerStatus('Dragging...');

  });



  google.maps.event.addListener(marker, 'dragend', function() {

    //updateMarkerStatus('Drag ended');

    updateMarkerPosition(marker.getPosition());

  });

}

// Onload handler to fire off the app.

google.maps.event.addDomListener(window, 'load', initialize);

</script>

<style type="text/css">

#map{width: 800px; height: 300px; float: left; border: none;}

</style>

<div id="map"></div>

<div class="wrapper clearfix">

<div id="corporate_form_fields">

    

<form class="profileform" action="<?php echo site_url('user/addEditLocation');?>" method="post" name="amenities_form" id="amenities_form">

                <div class="row-fluid profileform span5">

                          Locationn Map:  <fieldset>

            

                                <label class="control-label">Longitude:</label>

                                

<input type="text" class="txt" value="" id="longitude" name="longitude">

                            </fieldset>

                          <fieldset>

            

                                <label class="control-label">Latitude:</label>

                                

<input type="text" class="txt" value="" id="latitude" name="latitude">

                            </fieldset>



                    <fieldset>

                <input type="hidden" name="prop_id" value="<?php echo $general_info_ID->id;?>" />

                <input type="hidden" name="private_code" value="<?php echo $general_info_ID->private_code;?>"/>

              <input type="submit" class="btn buttonBlue" id="mybutton" value="Next">

              </fieldset>

            </div>

         

    

                     </form>

</div>

    </div>



<script type="text/javascript">



           

$(document).ready(function() {

     

	$('#amenities_form').validate({

		rules: {

			

                        amenities_detail: "required"

                        

                        

		},

		messages: {

 

                        amenities_detail: "Please enter amenities"

                        

							

		}

	});

        

        

});



</script>
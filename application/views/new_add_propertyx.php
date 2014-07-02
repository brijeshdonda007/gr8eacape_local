<?php 
$this->load->view('public/header');
?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
function getLocationValues(){
	if($('#form-3-t-2').parent().hasClass('current')){
		var country	 = $( "#country_id option:selected" ).text();
		var region	 = '';
		var city	 = '';
		var Suburb	 = '';
		if($("#is_region").val()==1) { // no region in the selected country //
		
			region	= $("#country_region").val();
			city	= $("#region_city").val();
			Suburb  = ($("#city_suburb").length > 0 ? $("#city_suburb").val() : '');
			
		} else {
		
			region = $("#region_id option:selected").text();
			
			if($("#is_city").val()==1) { // no city in the selected region //
				city	= $("#region_city").val();
				Suburb	= ($("#city_suburb").length > 0 ? $("#city_suburb").val() : '');
			} else {
				city	= $("#city_id option:selected").text();
			}
			
			if($("#is_suburb").val()==1) { // no suburb in the selected city //	
				Suburb = ($("#city_suburb").length > 0 ? $("#city_suburb").val() : '');
			} else {	
				Suburb = $("#suburb_id option:selected").text();
			}
			
		}
		
		region 	= ((region.toUpperCase() != 'SELECT YOUR REGION' && region.toUpperCase() != '' && region.toUpperCase() != 'All REGIONS') ? region : '' );
		city 	= ((city.toUpperCase() != 'SELECT YOUR CITY' && city.toUpperCase() != '' && city.toUpperCase() != 'All DISTRICTS') ? city : '' );
		Suburb	= ((Suburb.toUpperCase() != 'SELECT' && Suburb.toUpperCase() != '' && Suburb.toUpperCase() != 'SELECT YOUR SUBURB') ? Suburb : '' );
	//	alert(country+'/'+region+'/'+city+'/'+Suburb+'/');
		if(country.toUpperCase() == 'SELECT YOUR COUNTRY'){
			country = "New Zealand";
			region	= "Auckland";
			city    = '';
			Suburb  = '';
		}
		
		$.ajax({
			url: base_url + "ajax/getLocationValues",
			type: "post",
			datatype: "json",
			data: {country_name: country,state:region ,city:city,Suburb:Suburb},
			success: function(data) {
				var obj = jQuery.parseJSON(data);
				initializeNewMaps(obj.results[0].geometry.location.lat,obj.results[0].geometry.location.lng);
			}
		});
	}
}

var geocoder = new google.maps.Geocoder();
var map;
var marker;
function initializeNewMaps(lat,lng) {
	var latLng = new google.maps.LatLng(lat,lng);
	map = new google.maps.Map(document.getElementById('map'), {
		zoom: 8,
		center: latLng,
		disableDefaultUI: true,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		disableDefaultUI: true,
		panControl: true,
		zoomControl: true,
		scaleControl: true
	});
	marker = new google.maps.Marker({
		position: latLng,
		title: "You are here!",
		map: map,
		draggable: false
	});
}

google.maps.event.addDomListener(window, 'load', initializeNewMaps);
</script>
<style type="text/css">
    #map{ 
		height: 100%;
        margin: 0px;
        padding: 0px
	}
</style>
<body>
	<div class="inner-container">
	<?php $this->load->view('user/user-header');?>
		<section class="mainContent">
			<div class="wrapper clearfix">
				<div class="row-fluid clearfix">
					<div class="span12">
					<?php if($this->session->userdata('msg_upgraded')){ ?>
						<div class="message" >
						<?php echo $this->session->userdata('msg_upgraded');$this->session->unset_userdata(array('msg_upgraded'=>''));?><br />
						</div>
					<?php } ?>
					<?php $this->load->view($add_property); ?>
					</div>
				</div>
			</div>
		</section>
	</div>
	<?php $this->load->view('public/footer'); ?>
</body>
</html>
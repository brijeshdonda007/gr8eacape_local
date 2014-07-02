<?php $this->load->view('public/header');?>
<?php
//print_r($property_detail);
/* $country_name = 'Niue';
$region_name  = 'Lakepa';
$city_name 	  = 'Lakepa';
$suburb_name  = 'Lakepa'; */
 $country_name = $property_detail->country_name;
$region_name  = '';
$city_name 	  = '';
$suburb_name  = '';

if($property_detail->region_id == 0){
	$region_name = $property_detail->region_name;
}else{
	$region_name = $property_detail->get_region_name;
}
if($property_detail->city_id == 0){
	$city_name = $property_detail->city_name;
}else{
	$city_name = $property_detail->get_city_name;
}
if($property_detail->suburb_id == 0){
	$suburb_name = $property_detail->city_suburb;
}else{
	$suburb_name = $property_detail->suburb_name;
}


//$region_name = $property_detail->region_name;
//$city_name = $property_detail->city_name;
//$suburb_name = $property_detail->suburb_name;



	//$sQuery = '201 S. Division St., Ann Arbor, MI 48104';
	$sQuery = $country_name.' '.$region_name.' '.$city_name. ' ' .$suburb_name;
	$sURL = 'http://maps.googleapis.com/maps/api/geocode/json?address=' .urlencode($sQuery). '&sensor=false&region=en&language=en';
	$sData = json_decode(file_get_contents($sURL));
?>
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
        var latLng = new google.maps.LatLng(<?php echo (trim(@$sData->results[0]->geometry->location->lat) != '') ? @$sData->results[0]->geometry->location->lat : '-36.84815'; ?>,<?php echo (trim(@$sData->results[0]->geometry->location->lng) != '') ? @$sData->results[0]->geometry->location->lng : '174.74365'; ?>);
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
    #map{width: 100%; height: 450px; float: left; border: none;}
    #map label { width: auto; display:inline; }
    #map img { max-height: none; max-width: none; }
</style>
<body>
    <!--<div class="detailBanner"><img src="<?php echo base_url();?>assets/frontend/images/detailbanner.jpg" alt="" /></div>-->
    <section id="content">
		<div class="wrapper clearfix">
			<ul class="breadcrumbOption">

                <li><a href="<?php echo site_url();?>"><img src="<?php echo base_url();?>assets/frontend/images/home-breadcrumb1.png" /></a></li>
				<li><a href="/region/index/<?php echo $property_detail->country_id; ?>"><?php echo $property_detail->country_name; ?></a> <span class="divider"><img src="<?php echo base_url();?>assets/frontend/images/breadcrumb-divider.png" alt="" /></span></li>
				<?php if (!empty($property_region->region_name)): ?>
				<li><a href="/city/index/<?php echo $property_detail->region_id; ?>"><?php echo $property_region->region_name ?></a> <span class="divider"><img src="<?php echo base_url();?>assets/frontend/images/breadcrumb-divider.png" alt="" /></span></li>
				<?php endif ?>
				<?php if (!empty($property_city->city_name)): ?>
				<li><a href="/suburb/index/<?php echo $property_detail->city_id; ?>"><?php echo $property_city->city_name; ?></a> <span class="divider"><img src="<?php echo base_url();?>assets/frontend/images/breadcrumb-divider.png" alt="" /></span></li>
				<?php endif ?>

                <?php if (!empty($property_suburb->suburb_name)): ?>
				<li><a href="/suburb/index/<?php echo $property_detail->suburb_id; ?>"><?php echo $property_suburb->suburb_name; ?></a> <span class="divider"><img src="<?php echo base_url();?>assets/frontend/images/breadcrumb-divider.png" alt="" /></span></li>
				<?php endif ?>

				<li><?php echo $property_detail->title;?></li>

				<li class="pull-right">
					<div class="addthis_toolbox addthis_default_style ">
						<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
						<a class="addthis_button_tweet"></a>
						<a class="addthis_button_pinterest_pinit"></a>
					</div>
					<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51cac6bf4ca6489a"></script>
				</li>
			</ul>
		    <?php $this->load->view($main_client_view); ?>
		</div>
		</div>
	</section>
    <?php $this->load->view('public/footer'); ?>
</body>
</html>
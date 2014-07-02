<div id="map" style="width: 400px; display: inline; position: relative; float: right;" class=""></div>
<script>
$( document ).ready(function() {
	$('#form-3 .actions').click(function() {
		getLocationValues();
	}); 
	
	$('#form-3-t-2').click(function() {
		setTimeout(function(){getLocationValues();},500);
	}); 
});
</script>
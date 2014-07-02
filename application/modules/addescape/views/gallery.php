<?php foreach($imagesArray as $key => $images){
		$thumb_src = $base_url."images/property_img/gallery/thumb/$images->image";
?>
<div class="span2">
	<div class="item">
		<a class="fancybox" rel="group" href="javascript:;">
			<div class="zoom">
				<img src="<?php echo $thumb_src; ?>" alt="Photo" class=""/> 
			<div class="zoom-icon"></div>
			</div>
		</a>
		<div class="details">
		<!--	<a href="<?php //echo $base_url."Addescape/deleteEscapeImages/$escape_id/$images->image" ?>" class="" onclick="return confirm('Are you sure to delete this image ?');">Delete</a> -->
		<a href="javascript:;" class="" onclick="deleteEscapeImages('<?php echo $escape_id ?>','<?php echo $images->image ?>');">Delete</a>
		</div>
	</div>
</div>	
<?php							
	} 	
?>
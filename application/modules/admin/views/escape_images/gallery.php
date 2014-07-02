<?php // echo '<pre>'; print_r($imagesArray); ?>
<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<div class="panel-title"> Gallery </div>				
				<a class="pull-right btn btn-primary btn-gradient" href="<?php echo $base_url.'admin/addEscapeImages/'.$escape_id; ?>" > Add Images </a>
			</div>
			<div class="panel-body">			
			<?php foreach($imagesArray as $key => $images){
					$checked = '';
					if($images->status == 1){
						$checked = 'checked';
					}

			?>
			<!--	<li style="width: 195px; float: left; display: block;" class="col-md-3">
					<div class="img"><a class="fancybox" rel="group" href="<?php echo $base_url."images/property_img/gallery/$images->image"; ?>"><img src="<?php echo $base_url."images/property_img/gallery/thumb/$images->image"; ?>"></a></div>
				</li> -->
						<div class="col-md-2">
							<div class="item">
								<a class="fancybox" rel="group" href="<?php echo $base_url."images/property_img/gallery/$images->image"; ?>">
									<div class="zoom">
									<img src="<?php echo $base_url."images/property_img/gallery/thumb/$images->image"; ?>" alt="Photo" /> 
									<div class="zoom-icon"></div>
									</div>
								</a>
								<div class="details">
								<span class="pull-left"><input type="checkbox" id="<?php echo $images->id;  ?>" onclick="publishGalleryImages('<?php echo $images->id;  ?>');" <?php echo $checked; ?> /><span style="padding-bottom:3px;">Publish</span></span>
								<a href="<?php echo $base_url."admin/deleteEscapeImages/$escape_id/$images->image" ?>" class="pull-right cross glyphicons glyphicons-delete" onclick="return confirm('Are you sure to delete this image ?');">&nbsp;</a>
								</div>
								</div>
						</div>
			<?php } ?>
			</div>
		</div>
	</div>
</div>
		<!-- <input type="button" value="ACTIVE" onclick="updateStatus(330,'status',1,'tbl_property_images','');"/>
		<input type="button" value="Deactive" onclick="updateStatus(330,'status',0,'tbl_property_images','');"/> -->
<script>
  $('.fancybox').fancybox({
		    openEffect	: 'none',
			closeEffect	: 'none'   
   });
   
 function publishGalleryImages(id){
   check = $("#"+id).prop("checked");
    if(check) {
        var value = 1;
    } else {
        var value = 0;
    }
 updateStatus(id,'status',value,'tbl_property_images','');
 }  
</script>
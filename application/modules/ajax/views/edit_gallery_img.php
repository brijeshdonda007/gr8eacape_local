<link href="<?php echo base_url();?>assets/frontend/css/style.css" rel="stylesheet">
<?php
if (@$gallery_images) {
	foreach (@$gallery_images as $gimg) {
?>
	<div class="gallery-image-style">
		<img class="thumbnail" src="<?php echo base_url(); ?>images/gallery/bigs/<?php echo $gimg->image; ?>" />
		<br/>
		<a href="<?php echo base_url();?>ajax/editSingleImgForm/<?php echo $gimg->id; ?>"><img src="<?php echo base_url(); ?>assets/frontend/images/edit.png">Edit</a>
		<a class="abc" href="<?php echo base_url();?>ajax/deleteGalleryImg/<?php echo $gimg->id; ?>" onclick="return confirm('Are you sure want to delete');" ><img src="<?php echo base_url(); ?>assets/frontend/images/cross.png">Delete</a>
	</div>
<?php
	}
} 
?>
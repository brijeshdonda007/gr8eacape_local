<div>

    <form id="imageform"  method="post" enctype="multipart/form-data" action="<?php echo base_url();?>ajax/editpropertygalleryimg">

        <span id="pimg">Upload New:<input type="file" id="photoimg" name="photoimg"  />

            <input type="hidden" name="imgid" value="<?php echo $this->uri->segment(3);?>"/>

            <input type="submit" name="submit" value="Upload"/></span>

    </form>

</div>
<div class="bodyfloatleft">

    <div class="bodytop">

        <h2><?php echo @$form_title;?></h2>

    	<form class="formholder" method="post" id ="formholder" name="formholder" action="<?php echo site_url('location/addeditRegion');?>" enctype="multipart/form-data">

                <fieldset>

                	<label>Region Name</label>

                    <input class="inputmedium" type="text" name="region_name" value="<?php echo @$region->region_name;?>" required="1"/>

                </fieldset>

                <fieldset>

                    <label>Country</label>

                    <select name="country_id" required="1">

                        <option value="">All Countries</option>

                      <?php

                      foreach ($countries as $cn):

                      ?>

                      <option value="<?php echo $cn->id;?>" <?php if(isset($region) and ($cn->id == $region->country_id)){ ?>selected<?php }?>><?php echo $cn->country_name?></option>

                      <?php

                      endforeach;

                      ?>

                    </select>

                  </fieldset>

                

                <fieldset>

                    <label class="control-label">Featured Image:<span>*</span></label>

                    <?php if(@$region->featured_image) {?>

                    Current Image:<img width="80" src="<?php echo base_url();?>images/region/thumb/<?php echo @$region->featured_image; ?>" /><br/>

                    <?php }?>

                    <input type="file" placeholder="" class="input-large" name="featured_image" value="">&nbsp;&nbsp;New Image

                    <input type="hidden" name="old_featured_image" value="<?php echo @$region->featured_image; ?>" />

                </fieldset>

                <fieldset class="border">

                	<legend>Status</legend>

                    <label><input class="inputbuttons" type="radio" name="region_status" value="1" <?php if((@$region->region_status == '1') or !isset($country)) { ?>checked<?php }?>/> Active</label>

                    <label><input class="inputbuttons" type="radio" name="region_status" value="0" <?php if(@$region->region_status == '0') { ?>checked<?php }?> /> Inactive</label>

                </fieldset>

              <fieldset>

                  <input type="hidden" name="region_id" value="<?php echo @$this->uri->segment(3);?>" />

              	<button class="buttonBlue" type="submit">Submit</button>

              </fieldset>

        </form>

</div>

</div>
<div class="bodyfloatleft">

    <div class="bodytop">

        <h2><?php echo @$form_title;?></h2>

    	<form class="formholder" method="post" id ="formholder" name="formholder" action="<?php echo base_url();?>location/addeditsuburb" enctype="multipart/form-data">

                <fieldset>

                	<label>Suburb Name</label>

                    <input class="inputmedium" type="text" name="suburb_name" value="<?php echo @$suburb->suburb_name;?>" required="1" />

                </fieldset>

                <fieldset>

                    <label>Country</label>

                    <select name="country_id" required="1" id="country_id">

                        <option value="">All Countries</option>

                      <?php

                      foreach ($countries as $cn):

                      ?>

                      <option value="<?php echo $cn->id;?>" <?php if(isset($suburb) and ($cn->id == @$suburb->country_id)) { ?>selected<?php }?>><?php echo $cn->country_name?></option>

                      <?php

                      endforeach;

                      ?>

                      

                    </select>

                  </fieldset>

                
                    <fieldset>

                        <label>Region</label>
                        <div id="region-div">
                            <select name="region_id" required="1" id="region_id">
                                <option value="" >All Regions</option>
                    <?php 

                    if(isset($regions))

                    {

                    ?>

                    

                        

                         <?php

                        foreach($regions as $rn)

                        {

                        ?>

                            <option value="<?php echo $rn->id; ?>" <?php if(@$suburb->region_id == $rn->id ){ echo 'selected';}?>><?php echo $rn->region_name; ?></option>



                        <?



                            }

                        ?>



                        

                

                    <?php

                    }

                    ?>
</select>
                </div>
                        </fieldset>
            <fieldset>
                <label>City</label>
            <div id="ajax-city">
                <select name="city_id" required="1" id="city_id">
                <option value="" >All Regions</option>
                    <?php 

                    if(isset($cities))

                    {

                    ?>

                    

                        

                        

                         <?php

                        foreach($cities as $ct)

                        {

                        ?>

                            <option value="<?php echo $ct->id; ?>" <?php if(@$suburb->city_id == $ct->id ){ echo 'selected';}?>><?php echo $ct->city_name; ?></option>



                        <?php



                            }

                        ?>



                        

                

                    <?php

                    }

                    ?>
</select>
                </div>
</fieldset>
                 <fieldset>

                    <label class="control-label">Featured Image:<span>*</span></label>

                    <?php if(@$suburb->featured_image) {?>

                    Current Image:<img width="80" src="<?php echo base_url();?>images/suburb/thumb/<?php echo @$suburb->featured_image; ?>" /><br/>

                    <?php }?>

                    <input type="file" placeholder="" class="input-large" name="featured_image" value="">&nbsp;&nbsp;New Image

                    <input type="hidden" name="old_featured_image" value="<?php echo @$suburb->featured_image; ?>" />

                </fieldset>

                <fieldset class="border">

                	<legend>Status</legend>

                    <label><input class="inputbuttons" type="radio" name="status" value="1" <?php if((@$suburb->status == '1') or !isset($suburb)) { ?>checked<?php }?> required="1" /> Active</label>

                    <label><input class="inputbuttons" type="radio" name="status" value="0" <?php if(@$suburb->status == '0') { ?>checked<?php }?> required="1" /> Inactive</label>

                </fieldset>

              <fieldset>

                  <input type="hidden" name="suburb_id" value="<?php echo @$this->uri->segment(3);?>" />

              	<button class="buttonBlue" type="submit">Submit</button>

              </fieldset>

        </form>

</div>

</div>



<script type="text/javascript">

    $(document).ready(function(){

        $('#country_id').change(function()

            {

                if($(this).val() > 0)

                    {

                $('#region-div').html('Loading...');

                $.ajax({

                  url: "<?php echo base_url();?>ajax/getRegionAjax/"+$(this).val(),

                  success: function(data){

                    $('#region-div').html(data);

                  }

                });

            }});

    });

</script>

<script type="text/javascript">

    $(document).ready(function(){

        $('#region_id').change(function()

            {

                if($(this).val() > 0)

                    {

                $('#ajax-city').html('Loading...');

                $.ajax({

                  url: "<?php echo base_url();?>ajax/getCityAjax/"+$(this).val(),

                  success: function(data){

                    $('#ajax-city').html(data);

                  }

                });

            }});

    });

</script>


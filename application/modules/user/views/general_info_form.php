<div class="wrapper clearfix">

<div id="corporate_form_fields">

            

            

                <form class="profileform" id="generalinfo_form" method="post" action="<?php echo site_url('user/editgeneralInfo');?>" enctype="multipart/form-data" >

<div class="row-fluid profileform span5">

            <fieldset>

            

            <label class="control-label">Country<span>*</span></label>

            

              <select class="input-medium" id="country_id" name="country_id">

                  <option value="0">Select a country</option>

                  <?php

                  $i=1;

                  foreach($countries as $alc)

                  {

                  ?>

                <option value="<?php echo $alc->id;?>"<?php if($alc->id == $general_info_ID->country_id) { echo 'selected'; } ?>><?php echo $alc->country_name;?></option>

                <?php

                  } $i++;

                ?>

              </select>

                </fieldset>

            

         

                <fieldset>

            <div id="ajax-city">

                <label class="control-label">City<span>*</span></label>

           <select name="city_id" required="1" id="city_id" required="1">

                        <option value="0">Select</option>

                      <?php

                      foreach ($cities as $ct):

                      ?>

                      <option value="<?php echo $ct->id;?>" <?php if(($ct->id == @$general_info_ID->city_id)) { ?>selected<?php }?>><?php echo $ct->city_name?></option>

                      <?php

                      endforeach;

                      ?>

                      

                    </select>

          </div>

                </fieldset>

            <fieldset>

            <label class="control-label">Category:<span>*</span></label>

            

              <select class="input-medium" id="category_id" name="category_id">

                  <option value="0">Select a category</option>

                  <?php

                  foreach($categories as $cat)

                  {

                  ?>

              	<option value="<?php echo $cat->id;?>" <?php if($cat->id == @$general_info_ID->category_id) { echo 'selected'; }?>><?php echo $cat->category_title;?></option>

                <?php

                  } 

                ?>

              </select>

            

            </fieldset>

        

                <fieldset>

            <label class="control-label">Property Title:<span>*</span></label>

           

              <input type="text" placeholder="" class="input-large" name="title" value="<?php echo $general_info_ID->title; ?>">

            

                </fieldset>

          <fieldset>

            <label class="control-label">Featured Image:<span>*</span></label>

                Current Featured Image:<img width="80" src="<?php echo base_url();?>images/property_img/featured/thumb/<?php echo $general_info_ID->featured_image;?>"/><br/>

              New Featured Image:<input type="file" placeholder="" class="input-large" name="featured_image" value="">

              <input type="hidden" name="old_featured_image" value="<?php echo $general_info_ID->featured_image; ?>" />

                </fieldset>

            

           <fieldset>

            <label class="control-label">Detail:</label>

            

                <textarea name="detail" class="input-large"><?php echo $general_info_ID->detail; ?></textarea>

           

         </fieldset>

    

    <fieldset>

            <label class="control-label">Street Number:<span>*</span></label>

           

              <input type="text" placeholder="" class="input-large" name="street_no" value="<?php echo $general_info_ID->street_no; ?>">

            

                </fieldset>

    <fieldset>

            <label class="control-label">Street Name:<span>*</span></label>

           

              <input type="text" placeholder="" class="input-large" name="street_name" value="<?php echo $general_info_ID->street_name; ?>">

            

                </fieldset>

    <fieldset>

            <label class="control-label">Suburb:<span>*</span></label>

           

              <input type="text" placeholder="" class="input-large" name="suburb" value="<?php echo $general_info_ID->suburb; ?>">

            

                </fieldset>

    <fieldset>

            <label class="control-label">Avenue:<span>*</span></label>

           

              <input type="text" placeholder="" class="input-large" name="avenue" value="<?php echo $general_info_ID->avenue; ?>">

            

                </fieldset>

    <fieldset>

            <label class="control-label">Postcode:<span>*</span></label>

           

              <input type="text" placeholder="" class="input-large" name="postcode" value="<?php echo $general_info_ID->postcode; ?>">

            

                </fieldset>

    <fieldset>

            <label class="control-label">Price Per Night:<span>*</span></label>

           

              <input type="text" placeholder="" class="input-large" name="price_night" value="<?php echo $general_info_ID->price_night; ?>">

            

                </fieldset>

    <fieldset>

            <label class="control-label">Price Per Week:<span>*</span></label>

           

              <input type="text" placeholder="" class="input-large" name="price_week" value="<?php echo $general_info_ID->price_week; ?>">

            

                </fieldset>

    <fieldset>

            <label class="control-label">Price Per Month:<span>*</span></label>

           

              <input type="text" placeholder="" class="input-large" name="price_month" value="<?php echo $general_info_ID->price_month; ?>">

            

                </fieldset>

        <fieldset>

    	

            <input type="hidden" name="prop_id" value="<?php echo $general_info_ID->id;?>"/>

            <input type="hidden" name="private_code" value="<?php echo $general_info_ID->private_code;?>"/>

              <input type="submit" class="btn buttonBlue" id="mybutton" value="Next">

              

           

         </fieldset>

</div>

<div class="clear"></div>

      </form>   



           



            

          </div>         

    



       

        </div>
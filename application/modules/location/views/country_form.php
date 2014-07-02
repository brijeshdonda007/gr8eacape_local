<div class="bodyfloatleft">

    <div class="bodytop">

        <h2><?php echo @$form_title;?></h2>

    	<form class="formholder" method="post" id ="formholder" name="formholder" action="<?php echo site_url('location/addeditCountry');?>">

                <fieldset>

                	<label>Country Name</label>

                    <input class="inputmedium" type="text" name="country_name" value="<?php echo @$country->country_name;?>" required="1"/>

                </fieldset>

                <fieldset class="border">

                	<legend>Status</legend>

                    <label><input class="inputbuttons" type="radio" name="status" value="1" <?php if((@$country->status == '1') or !isset($country)) { ?>checked<?php }?>/> Active</label>

                    <label><input class="inputbuttons" type="radio" name="status" value="0" <?php if(@$country->status == '0') { ?>checked<?php }?> /> Inactive</label>

                </fieldset>

              <fieldset>

                  <input type="hidden" name="countryid" value="<?php echo @$this->uri->segment(3);?>" />

                  <button class="buttonBlue" type="submit">Submit</button>

              </fieldset>

        </form>

</div>

</div>
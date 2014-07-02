

            <div class="span10">

	

            

          

                <fieldset>

            

            <label class="control-label">Country<span>*</span></label>

            <div class="controls">

              <select class="input-medium" id="country_id" name="country_id">

                  <option value="">Select a country</option>

                  <?php

                  $i=1;

                  foreach($countries as $alc)

                  {

                  ?>

              	<option value="<?php echo $alc->id;?>"><?php echo $alc->country_name;?></option>

                <?php

                  } $i++;

                ?>

              </select>

            </div>

            </div>

          

        <div class="control-group" id="ajax-city" style="display: none;">

           

          </div>

            <div class="control-group">

            <label class="control-label">Category<span>*</span></label>

            <div class="controls">

              <select class="input-medium" id="category_id" name="category_id">

                  <option value="">Select a category</option>

                  <?php

                  foreach($categories as $cat)

                  {

                  ?>

              	<option value="<?php echo $cat->id;?>"><?php echo $cat->category_title;?></option>

                <?php

                  } 

                ?>

              </select>

            </div>

          </div>

            <div class="control-group" rel="owner_fields">

            <label class="control-label">Property Title<span>*</span></label>

            <div class="controls">

              <input type="text" placeholder="" class="input-xlarge" name="title" value="<?php echo set_value('title'); ?>">

            </div>

          </div>

            

          <div class="control-group" rel="owner_fields">

            <label class="control-label">Detail</label>

            <div class="controls">

                <textarea name="detail"></textarea>

            </div>

          </div>

                        <div class="span12">

    	<div class="control-group">

            <div class="controls">

              <input type="submit" class="btn buttonBlue" id="mybutton" value="Submit">

              

            </div>

          </div>

    </div>

          


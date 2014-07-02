
<div class="bodyfloatleft">
<div class="bodytop">

	<h3>Settings</h3>

    

    <p>Please Fill in the Information Below:</p>

    <form id="formholder" class="formholder" action="<?php echo site_url('setting/addUpdateSetting'); ?>" method="post">

    	<input type="hidden" name="setting_id" value="<?php  echo @$settings[0]->id; ?>">

        <fieldset>

            <label>Government Tax</label>

            <input class="inputsmall" type="text" name="gst" value="<?php echo @$settings[0]->government_tax; ?>" /> %

        </fieldset>

        

        <fieldset>

            <label>Service Tax</label>

            <input class="inputsmall" type="text" name="service_tax" value="<?php echo @$settings[0]->site_service_tax; ?>" /> %

        </fieldset>

    	

        <fieldset>

            <label>Site Title</label>

            <input class="inputlarge" type="text" name="site_title" value="<?php echo @$settings[0]->site_title; ?>"  />

        </fieldset>

        

        <fieldset>

            <label>Site Email</label>

            <input class="inputlarge" type="text" name="email" value="<?php echo @$settings[0]->contact_email; ?>" />

        </fieldset>

                        

        <fieldset>

            <label>Facebook Link</label>

            <input class="inputlarge" type="text" name="facebook" value="<?php echo @$settings[0]->facebook_link; ?>" />

        </fieldset>

        

        <fieldset>

            <label>Twitter Link</label>

            <input class="inputlarge" type="text" name="twitter" value="<?php echo @$settings[0]->twitter_link; ?>"  />

        </fieldset>

        

        <fieldset>

            <label>Youtube Video Id<span>(Id of the video only)</span></label>

            <input class="inputlarge" type="text" name="video" value="<?php echo @$settings[0]->video_link; ?>"  />

        </fieldset>

                

        <fieldset>

            <label>Meta Title</label>

            <input class="inputlarge" type="text" name="meta_title" value="<?php echo @$settings[0]->meta_title; ?>" />

        </fieldset>

        

        <fieldset>

            <label>Meta Keywords</label>

            <textarea class="inputlarge" rows="5" name="meta_keywords" cols="40"><?php echo @$settings[0]->meta_keyword; ?></textarea>

        </fieldset>

        

        <fieldset>

        	<label>Meta Description</label>

            <textarea class="inputlarge" rows="5" name="meta_description" cols="40"><?php echo @$settings[0]->meta_description; ?></textarea>

        </fieldset>

        

        <fieldset>

			<button type="submit" class="buttonBlue">Submit</button>

		</fieldset>

        

    </form>

</div>
</div>
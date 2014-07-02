<div class="Block clearfix">
        <h4></h4>
        <form METHOD="POST" action="">
          <div class="row-fluid profileform clearfix">
            <div class="span10">
              <fieldset>
                <label>To: <a href="<?php echo base_url() . "/owner/detail/" . $user_profile_info->id ?>"><?php echo $user_profile_info->first_name . ' ' . $user_profile_info->last_name ?></a></label>
              </fieldset>
              <fieldset>
                <label>Subject: <?php echo $escape['title'] ?></label>
              </fieldset>
                <fieldset>
                     <label>Message:</label>
                     <textarea name="message" rows = "5" cols="40" style="height:100px;width:100%;"></textarea>
                </fieldset>

            <input type="hidden" value="<?php echo "Declined Reson For " . $escape['title'] ?>" name="subject" />
            <input type="hidden" value="<?php echo $escape['owner_id'] ?>" name="owner" />
			<input type="hidden" value="<?php echo $this->session->userdata('admin_user_id') ?>" name="escape_person" />
            <input type="hidden" value="<?php echo $escape['id'] ?>" name="escape_id" />
			<input type="submit" value="Send" id="mybutton" class="btn buttonBlue" />
        </form>
</div>
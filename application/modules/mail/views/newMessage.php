<div class="Block clearfix">
        <h4></h4>
        <form METHOD="POST" action="<?php echo base_url() . "mail/message/save" ?>">
          <div class="row-fluid profileform clearfix">
            <div class="span10">
              <fieldset>
                <label>From: <a href="<?php echo base_url() . "/owner/detail/" . $user_profile_info->id ?>"><?php echo $user_profile_info->first_name . ' ' . $user_profile_info->last_name ?></a></label>
              </fieldset>
              <fieldset>
                <label>Subject: <?php echo $escape['title'] ?></label>
              </fieldset>
                <fieldset>
                     <label>Message:</label>
                     <textarea name="message" rows = "40" cols="5">
                    </textarea>
                </fieldset>

            <input type="hidden" value="<?php echo "Question about " . $escape['title'] ?>" name="subject" />
            <input type="hidden" value="<?php echo $escape['owner_id'] ?>" name="owner" />
			<input type="hidden" value="<?php echo $user_profile_info->id ?>" name="escape_person" />
            <input type="hidden" value="<?php echo $escape['id'] ?>" name="escape_id" />
			<input type="submit" value="Send" id="mybutton" class="btn buttonBlue" />
        </form>
</div>
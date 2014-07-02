<div class="content">

    <h4>Message ID: <?php echo $main_message->id; ?></h4>

    <div class="left">
        <dl>
            <dt>Subject:</dt>
            <dd><?php echo $main_message->subject ?></dd>

            <?php if($type == 'from_user'): ?>
            <dt>From:</dt>
            <dd><a href="<?php echo site_url('owner/detail/' .$main_message->from_user) ?>" > <?php echo $main_message->first_name . ' ' .$main_message->last_name ?></a></dd>
            <?php else : ?>
            <dt>To:</dt>
            <dd><a href="<?php echo site_url('owner/detail/' .$main_message->to_user) ?>" > <?php echo $main_message->first_name . ' ' .$main_message->last_name ?></a></dd>
            <?php endif ?>

            <dt>Message: </dt>
            <dd><?php echo $main_message->message ?></dd>
        </dl>

        <?php if($type == 'from_user'): ?>
        <fieldset>
				<button id="reply_button"> Reply </button>
	    </fieldset>
        <?php endif ?>
    </div>
</div>

<div style="display: none" id="reply_div">
        <form METHOD="POST" action="<?php echo base_url() . "mail/message/save" ?>">
          <div class="row-fluid profileform clearfix">
            <div class="span10">
              <br/>
              <br/>
              <fieldset>
                <label>Subject: Re: <?php echo $main_message->subject ?></label>
              </fieldset>
                <fieldset>
                     <label>Reply Message:</label>
                     <textarea name="message" rows = "40" cols="5">
                    </textarea>
                </fieldset>

            <input type="hidden" value="Re: <?php echo $main_message->subject ?>" name="subject" />
            <input type="hidden" value="<?php echo $main_message->from_user ?>" name="owner" />
			<input type="hidden" value="<?php echo $main_message->to_user ?>" name="escape_person" />
            <input type="hidden" value="<?php echo (!empty($main_message->booking_id))?$main_message->booking_id:0  ?>" name="escape_id" />
			<input type="submit" value="Send" id="mybutton" class="btn buttonBlue" />
        </form>
</div>

<script type="text/javascript">
    $('#reply_button').on('click', function(){
        $('#reply_div').show();
    });
</script>
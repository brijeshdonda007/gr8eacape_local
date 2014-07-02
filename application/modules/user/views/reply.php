<div class="Block clearfix">

    <form class="reply-form" action="<?php echo site_url('user/sendMessage') ?>" method="post">

        <fieldset>

            <label for="to">To</label>

            <input type="hidden" value="<?php echo @$this->uri->segment(3); ?>" name="message_id" id="message_id" />

            <input type="text" disabled="disabled" value="<?php echo $this->session->userdata('to_username') ?>" />

            <input type="hidden" value="<?php echo @$this->session->userdata('to_id')?>" name="reply_to_id" />

        </fieldset>

        

        <fieldset>

            <label for="reply">Message</label>

            <textarea name="reply-message" id="reply-message">

                   

            </textarea>

        </fieldset>

        

        <fieldset>

            <input type="submit" value="Reply" name="reply-btn" />

        </fieldset>

    </form>

</div>
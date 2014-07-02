<div class="Block clearfix">
	<?php
	if($this->session->userdata('type') == 'inbox'){
	?>
	<a href="<?php echo site_url('user/inbox'); ?>" class="pull-right"><strong>Back to inbox</strong></a>
	<?php
	} else
	{
	?>
	<a href="<?php echo site_url('user/sent'); ?>" class="pull-right"><strong>Back to sent items</strong></a>
	<?php } ?>
	<div class="message-actions">
		<ul class="actions">
			<li><a href="<?php echo site_url('user/replyMessage/'. @$message->m_id); ?>" title="Reply">Reply </a></li>
			<li><a href="<?php echo site_url('user/trashMessage/'. @$message->m_id); ?>" title="Delete">Delete</a></li>
		</ul>
	</div>
    <h4><?php echo 'Booking request for '.'Property Name'; ?></h4>
    <?php
    $to_array = array('to_username'=>@$message->username,'to_id'=>@$message->id);
    $this->session->set_userdata($to_array);
    ?>
	<div class="message-details">
		From: <?php echo @$message->username; ?> <br />
		Subject: <?php echo 'Booking request for '.'property_name'; ?> <br />
		Message:<?php echo @$message->message; ?> 
	</div>
    <?php if($replies != ''){
        ?>
    <h4>Conversations</h4>
    <?php
    }
    ?>
    <?php foreach($replies as $reply):
        if($reply != '')
        ?>
	<div class="replies">
		Subject: <?php echo 'Re:Booking request for '.'property_name'; ?> <br/>
		Message: <?php echo @$reply -> detail; ?>
	</div>
	<?php
	endforeach;
	?>
	<div class="reply-box">
		<form action="<?php echo site_url('user/sendMessage'); ?>" method="post">
			<fieldset>
				<input type="hidden" name="message_id" value="<?php echo @$this->uri->segment(3); ?>" />
				<label for="reply">Reply</label>
				<textarea name="reply-message" id="reply-message"></textarea>
			</fieldset>
			<fieldset>
				<input type="submit" value="Reply" name="reply" />
			</fieldset>
		</form>
	</div>
</div>
<?php





if(count($main_message)==1)

{



?>

<div class="content">

<h2>Reply</h2>

<div class="center">

    <form action="<?php echo site_url('user/replymessageinstant/'.$this->uri->segment(3)); ?>" method="post">

    	<label for="message" class="center">Message</label><br />

        <textarea cols="40" rows="5" name="message" id="message"></textarea><br />

        <input type="hidden" name="user_partic" value="<?php echo $user_partic;?>" />

        <input type="hidden" name="reply_count" value="<?php echo count($dn2);?>" />

        <input type="submit" value="Send" />

    </form>

</div><br/>

<h1><?php echo $main_message->title; ?></h1>

<table class="messages_table">

	<tr>

    	<th>User</th>

        <th>Message</th>

    </tr>

<?php

foreach($dn2 as $dn)

{

?>

	<tr>

    	<td><a href="<?php echo site_url('owner/detail/'.$dn->userid); ?>"><?php echo $dn->first_name.' '.$dn->last_name; ?></a></td>

    	<td>

    	<?php echo $dn->message; ?><div class="date">Sent: <?php echo date('m/d/Y H:i:s' ,$dn->timestamp); ?></div></td>

    </tr>

<?php

}

?>

</table>

</div>

<?php



}



?>

		
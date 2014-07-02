<div class="controls">
	<select class="input-medium" id="channel_id" name="channel_id">
		<option value=""> - All Channels - </option>
	  <?php foreach($ajax_channels as $channel): ?>
			<option value="<?php echo $channel->id ?>"> <?php echo $channel->name ?></option>
		<?php endforeach ?>
	</select>
</div>
<div class="controls">
	<select class="input-medium" id="suburb_id" name="suburb_id">
		<option value="">All Suburbs</option>
		<?php
		foreach($ajax_suburb as $ajxs)
		{
		?>
		<option value="<?php echo $ajxs->id;?>"><?php echo $ajxs->suburb_name;?></option>
		<?php
		}
		?>
	</select>
</div>
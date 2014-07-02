<div class="controls">
	<select class="input-medium" id="city_id" name="city_id" onchange="getCity();">
		<option value="">All Districts</option>
	  <?php
		foreach($ajax_city as $ajxc)
		{
		?>
			<option value="<?php echo $ajxc->id;?>"><?php echo $ajxc->city_name;?></option>
		<?php
		}
		?>
	</select>
</div>
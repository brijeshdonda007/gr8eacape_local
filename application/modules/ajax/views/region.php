<div class="controls">
	<select class="input-medium" id="region_id" name="region_id" onchange="getRegions();">
		<option value="">All Regions</option>
		<?php
		foreach($ajax_region as $ajc)
		{
		?>
			<option value="<?php echo $ajc->id; ?>"><?php echo $ajc->region_name; ?></option>
		<?php
		}
		?>
	</select>
</div>
<style>
#search-select-loading { 
  background: url(<?php echo base_url();?>assets/frontend/images/search/loading.gif) no-repeat 0 0; 
  padding:4px; line-height: 21px;}
</style>
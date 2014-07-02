<div class="bodyfloatleft">
	<div class="bodytop">
		<h2><?php echo @$form_title;?></h2>
		<form class="formholder usergroup" method="post" id ="formholder" name="formholder" enctype="multipart/form-data" action="<?php echo site_url('groups/newgroup');?>">
			<fieldset>
				<label>Group Name</label>
				<input class="inputmedium" type="text" name="groupname" value="" required="1"/>
			</fieldset>
			<fieldset class="border">
				<legend>Permission</legend>
				<?php foreach($sections as $sc){ ?>
					<div class="sections"><h4><?php echo $sc->name; ?></h4>
					<?php foreach($properties as $pr){ ?>
						<?php if ($sc->id == $pr->section_id){ ?>
							<label><input type="checkbox" name="group_detail[]" value="<?php echo $sc->id;?>_<?php echo $pr->id; ?>" />
								<?php echo $pr->name;?>
							</label>
						<?php } ?>
					<?php } ?></div>
				<?php } ?>
			</fieldset>
			<fieldset class="border">
				<legend>Status</legend>
				<label><input class="inputbuttons" type="radio" name="status" value="1" /> Active</label>
				<label><input class="inputbuttons" type="radio" name="status" value="0" checked /> Inactive</label>
			</fieldset>
			<fieldset>
				<input type="hidden" name="groupid" value="" />
				<button class="buttonBlue" type="submit">Submit</button>
			</fieldset>
		</form>
	</div>
</div>

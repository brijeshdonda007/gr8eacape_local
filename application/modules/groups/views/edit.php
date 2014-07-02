<div class="bodyfloatleft">
    <div class="bodytop">
        <h2><?php echo @$form_title;?></h2>
    	<form class="formholder usergroup" method="post" id ="formholder" name="formholder" enctype="multipart/form-data" action="<?php echo site_url('groups/addeditGroup');?>">
			<fieldset>
				<label>Group Name</label>
				<input class="inputmedium" type="text" name="groupname" value="<?php echo @$group->name; ?>" required="1"/>
			</fieldset>
			<fieldset class="border">
				<legend>Permission</legend>
				<?php foreach($sections as $sc){ ?>
					<div class="sections"><h4><?php echo $sc->name; ?></h4>
					<?php foreach($properties as $pr){ ?>
						<?php if ($sc->id == $pr->section_id){ ?>
							<label>
								<?php
									$temp = $group->id.'_'.$sc->id.'_'.$pr->id;
									if (in_array($temp, $group_detail)){
								?>
									<input type="checkbox" name="group_detail[]" value="<?php echo $group->id;?>_<?php echo $sc->id;?>_<?php echo $pr->id; ?>" checked />
								<?php }else{ ?>
									<input type="checkbox" name="group_detail[]" value="<?php echo $group->id;?>_<?php echo $sc->id;?>_<?php echo $pr->id; ?>" />
								<?php } ?>
								<?php echo $pr->name;?>
							</label>
						<?php } ?>
					<?php } ?></div>
				<?php } ?>
			</fieldset>
			<fieldset class="border">
				<legend>Status</legend>
				<label><input class="inputbuttons" type="radio" name="status" value="1" <?php if (@$group->status =='1') {?>checked<?php } ?>/> Active</label>
				<label><input class="inputbuttons" type="radio" name="status" value="0" <?php if (@$group->status =='0') {?>checked<?php } ?>/> Inactive</label>
			</fieldset>
			<fieldset>
				<input type="hidden" name="groupid" value="<?php echo $group->id; ?>" />
				<button class="buttonBlue" type="submit">Submit</button>
			</fieldset>
		</form>
	</div>
</div>

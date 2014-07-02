<fieldset>
    <label class="control-label">Custom Fields:</label>
    <form method="post" name="formx" action="<?php echo base_url();?>ajax/updateSingleExtra">
    <input type="text" class="txt" value="<?php echo $single_info->type; ?>" id="type" name="type">
    <input type="text" class="txt" value="<?php echo $single_info->value; ?>" id="value" name="value">
    <input type="hidden" name="info_id" value="<?php echo $single_info->id;?>>" />
    <input type="hidden" name="property_id" value="<?php echo $single_info->property_id;?>>" />
    <input type="submit" name="submit" value="Save" />
    </form>
</fieldset>
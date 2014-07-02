<script language="javascript" src="<?php echo base_url ();?>assets/backend/js/property.js"></script>       
<div class="bodytop">
    <h1>List Property</h1>
        <form name="filter_by_category" id="filter_by_category" action="<?php echo site_url('property/escapeList'); ?>" method="post">
        <select name="category_id" onchange="this.form.submit()">
            <option value="0">-Select Category-</option>
            <?php foreach($all_category as $alc)
            {
            ?>

            <option value="<?php echo $alc->id;?>" <?php echo (@$_POST['category_id'] == $alc->id) ? 'selected' : ''?>><?php echo $alc->category_title;?></option>
            <?php
            }
            ?>
        </select>
        <select name="admin_action" onchange="this.form.submit()">
            <option value="">-Select Action-</option>
            <option value="pending" <?php echo (@$_POST['admin_action'] == 'pending') ? 'selected' : ''?>>Pending</option>
            <option value="approved" <?php echo (@$_POST['admin_action'] == 'approved') ? 'selected' : ''?>>Approved</option>
            <!--<option value="verified" <?php echo (@$_POST['admin_action'] == 'verified') ? 'selected' : ''?>>Verified</option>-->
            <option value="declined" <?php echo (@$_POST['admin_action'] == 'declined') ? 'selected' : ''?>>Declined</option>
        </select>
        <input type="hidden" name="filter_property" value="1" />
    </form>
	<div style="text-align:right;margin-bottom:5px;"><button id="remove_escapes" class="btn btn-danger">Delete Selected</button></div>
    <?php if($property_count > 0)
    {?>
    	<table class="tabulardata" cellpadding="0" cellspacing="0">
            <tr>
            	<th><input type="checkbox" name="check_all" id="check_all" />Property Title</th>
                <th>Owner</th>
                <th>PG Url</th>
                <th>Added On</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php
            $sn=1;
            foreach($all_property as $alp):
                $owner_rs = $this->property_model->get_owner_info($alp->owner_id);
            ?>
            <tr <?php if($sn%2 == 0) {  echo 'class="tablealternate"'; }?>>
            	<td><input type="checkbox" class="escape_check" id="<?php echo $alp->id; ?>"><?php echo $alp->title;?></td>
                <td><?php echo @$owner_rs->first_name.' '.@$owner_rs->last_name;?></td>
                <td>
                    <?php if(!empty($alp->custom_url)): ?>
                        
                        <a href="<?php echo site_url('/escapedetails/'.$alp->custom_url); ?>">View</a>

                    <?php else: ?> 
                         No ID
                   <?php endif; ?>        

                </td>
                <td><?php echo $alp->created_date;?></td>
                <td><?php
                if(($alp->admin_action == 'pending'))
                {
                    echo 'Pending';
                }
                if(($alp->admin_action == 'approved'))
                {
                    echo 'Approved';
                }
                if(($alp->admin_action == 'verified'))
                {
                    echo 'Verified';
                }
                if(($alp->admin_action == 'declined'))
                {
                    echo 'Declined';
                }
                ?></td>
                <td colspan="2">
                    <a href="<?php echo base_url();?>property/propertyDetail/<?php echo $alp->id;?>">View Detail</a>
                <?php
                if(($alp->admin_action == 'pending'))
                {
                ?>
                ||
                <a href="<?php echo base_url();?>property/approveProperty/<?php echo $alp->id;?>">Approve</a>
                ||
                <?php
                }
                 if(($alp->admin_action == 'approved'))
                {
                ?>
                ||
                <!--<a href="<?php echo base_url();?>property/verifyProperty/<?php echo $alp->id;?>">Verify</a>-->
                ||
                <?php
                }
                ?>
                <?php if($alp->admin_action != 'declined')
                {?>
                <a href="<?php echo base_url();?>property/declineProperty/<?php echo $alp->id;?>">Decline</a>
                <?php
                }
                ?>
                </td>
            </tr>
             <?php $sn++; endforeach; ?>
        </table>
    <div class="pagination"><?php echo $links; ?></div>
    <?php
    }
    else
    {
        ?>
    No result found.
    <?php
    }
    ?>
    </div>
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/backend/js/jquery.confirm.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#remove_escapes').confirm({
		text: "Are you sure you want to delete selected escapes?",
		confirm: function(button) {
			var ids = '';
			$('.escape_check').each(function(){
				if ($(this).is(':checked'))
					ids += $(this).attr('id') + ',';
			});
			$.ajax({
				type: 'POST',
				url: "<?php echo base_url();?>ajax/delete_escapes",
				data: {escape_ids: ids},
				success: function(data){
					window.location = 'http://gr8escapes.com/property/escapeList';
				}
			});
		},
		cancel: function(button) {
			// do something
		},
		confirmButton: "Yes",
		cancelButton: "No"
	});
	$('#check_all').change(function(){
		if ($(this).is(':checked')){
			$('.escape_check').each(function(){
				$(this).attr('checked', 'checked');
			});
		}else{
			$('.escape_check').each(function(){
				$(this).removeAttr('checked');
			});
		}
	});
});
</script>
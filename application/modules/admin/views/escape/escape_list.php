<script language="javascript" src="<?php echo base_url ();?>assets/backend/js/property.js"></script>       
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <div class="panel-title"> Escapes </div>
            </div>
            <div class="panel-body">
                <div class="col-md-5">
                    <form name="filter_by_category" id="filter_by_category" class="" action="<?php echo site_url('admin/escapeList'); ?>" method="post">
                        <div class="form-group">
                            <select name="admin_action" class="form-control" onchange="this.form.submit()">
                                <option value="">-Select Action-</option>
                                <option value="pending" <?php echo (@$_POST['admin_action'] == 'pending') ? 'selected' : ''?>>Pending</option>
                                <option value="approved" <?php echo (@$_POST['admin_action'] == 'approved') ? 'selected' : ''?>>Approved</option>
                                <!--<option value="verified" <?php echo (@$_POST['admin_action'] == 'verified') ? 'selected' : ''?>>Verified</option>-->
                                <option value="declined" <?php echo (@$_POST['admin_action'] == 'declined') ? 'selected' : ''?>>Declined</option>
                            </select>
                        </div>
                        <input type="hidden" name="filter_property" value="1" />
                    </form>
                </div>
                <div class="col-md-12 table-responsive">
                <?php if($property_count > 0)
                {?>
                    <table class="table-striped table-bordered table-hover" id="datatable" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th><input type="checkbox" name="check_all" id="check_all" style="margin-right:10px;" /></th>
                                <th>ID</th>
                                <th>Escape</th>
                                <th>Owner</th>
                                <!--<th>PG Url</th>-->
                                <th>Added On</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sn=1;
                        foreach($all_property as $alp):
                            $owner_rs = $this->admin_model->get_owner_info($alp->owner_id);
                        ?>
                        <tr <?php if($sn%2 == 0) {  echo 'class="tablealternate"'; }?>>
                            <td><input type="checkbox" class="escape_check" id="<?php echo $alp->id; ?>" style="margin-right:10px;"/></td>
                            <td>
								<?php if(!empty($alp->custom_url)): ?>
                                    
                                    <a href="<?php echo site_url('/escapedetails/'.$alp->custom_url); ?>"><?php echo $alp->custom_url ?></a>

                                <?php else: ?> 
                                     No ID
                               <?php endif; ?>
							</td>
                            <td><?php echo $alp->title;?></td>
                            <td><?php echo @$owner_rs->first_name.' '.@$owner_rs->last_name;?></td>
                          <!--  <td>
                                <?php if(!empty($alp->custom_url)): ?>                                    
                                    <a href="<?php echo site_url('/escapedetails/'.$alp->custom_url); ?>">View</a>
                                <?php else: ?> 
                                     No ID
                               <?php endif; ?>        
                            </td>-->
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
                            <td>
                            <?php
                            if(($alp->admin_action == 'pending'))
                            {
                            ?>
                            <a class="btn btn-green btn-xs" href="<?php echo base_url();?>admin/approveEscape/<?php echo $alp->id;?>">Approve</a>
                            <?php
                            }
                             if(($alp->admin_action == 'approved'))
                            {
                            ?>
                            <a class="btn btn-red btn-xs" href="<?php echo base_url();?>admin/declineEscape/<?php echo $alp->id;?>">Decline</a>
                           <!-- <a class="btn btn-blue3 btn-xs" href="<?php echo base_url();?>admin/verifyEscape/<?php echo $alp->id;?>">Verify</a>-->
                            <?php
                            }
							 if(($alp->admin_action == 'verified'))
                            {
                            ?>
                            <a class="btn btn-red btn-xs" href="<?php echo base_url();?>admin/declineEscape/<?php echo $alp->id;?>">Decline</a>
                            <?php
                            }
                            ?>
                            <?php if($alp->admin_action == 'declined')
                            {?>
                             <a class="btn btn-green btn-xs" href="<?php echo base_url();?>admin/approveEscape/<?php echo $alp->id;?>">Approve</a>
                            <?php
                            }
                            ?>
                            </td>
                        </tr>
                         <?php $sn++; endforeach; ?>
                        </tbody>
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
            </div>
        </div>
    </div>
    </div>
<script type="text/javascript">
$(document).ready(function(){
    $('#remove_escapes').click(function(){
        bootbox.confirm('Are you sure to delete selected escapes?', function(result){
            if (result == true){
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
                        window.location = 'http://gr8escapes.com/admin/escapeList';
                    }
                });
            }
        });
    });
	$('#check_all').change(function(){

		if ($('#check_all').is(':checked')) {
			$('input.escape_check').each(function(){
				$(this).prop("checked", true);
			});
		}else{
			$('input.escape_check').each(function(){
				$(this).prop("checked", false);
			});
		}
	});

  $('#datatable').dataTable( {
    "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ -1 ] }],
    "oLanguage": { "oPaginate": {"sPrevious": "", "sNext": ""} },
    "iDisplayLength": 6,
    "aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
  });   
});
</script>
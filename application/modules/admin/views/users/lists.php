	<div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title"> Users </div>
                    <a class="pull-right btn btn-primary btn-gradient" href="<?php echo base_url();?>admin/users/add">Add New User</a>
                </div>
                <div class="panel-body">
                <?php
                if(count($total_count) > 0)
                {
                ?>
                    <div class="table-responsive">
                        <table class="table-striped table-bordered table-hover" id="datatable">
                        	<thead>
                            <tr>
                            	<th>User Name</th>
								<th>User Type</th>
								<th>Status</th>
								<th>Action</th>
                            </tr>
                        	</thead>
                        	<tbody>
                            <?php
                            $i=1;
                            foreach($all_users as $au)
                            {
                            ?>
							<tr class="<?php echo ($i%2 == 0)?'tablealternate':''; ?>">
								<td><?php echo $au->first_name.' '.$au->last_name;?></td>
								<td><?php echo $au->group_name;?></td>
								<td><?php echo ($au->user_status == 1)?'Active':'Inactive';?></td>
								<td><a class="btn btn-blue btn-xs" href="<?php echo base_url();?>admin/users/edit/<?php echo $au->id?>">Edit</a>
									<a class="btn btn-orange btn-xs" onclick="return confirm('Are you sure to delete?')" href="<?php echo base_url();?>admin/deleteUser/<?php echo $au->id?>">Delete</a></td>
							</tr>
                            <?php
                            $i++;}
                            ?>
                        	</tbody>
                        </table>
                        <div class="pagination"><?php echo $links; ?></div>
                    </div>
                <?php
                }
                else
                {
                    echo 'No User';
                }
                ?>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
jQuery(document).ready(function() {    
  $('#datatable').dataTable( {
	"aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ -1 ] }],
	"oLanguage": { "oPaginate": {"sPrevious": "", "sNext": ""} },
	"iDisplayLength": 10,
	"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
  });	
});
  </script>

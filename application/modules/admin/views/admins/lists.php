	<div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title"> Administrators </div>
                    <a class="pull-right btn btn-primary btn-gradient" href="<?php echo base_url();?>admin/admins/add">Add New administrator</a>
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
                            	<th>Full Name</th>
								<th>Email</th>
								<th>Login name</th>
								<th>Status</th>
								<th>Action</th>
                            </tr>
                        	</thead>
                        	<tbody>
                            <?php
                            $i=1;
                            foreach($all_admins as $aa)
                            {
                            ?>
							<tr class="<?php echo ($i%2 == 0)?'tablealternate':''; ?>">
								<td><?php echo $aa->first_name.' '.$aa->last_name;?></td>
								<td><?php echo $aa->email;?></td>
								<td><?php echo $aa->username;?></td>
								<td><?php echo ($aa->admin_status == 1)?'Active':'Inactive';?></td>
								<td><a class="btn btn-blue btn-xs" href="<?php echo base_url();?>admin/admins/edit/<?php echo $aa->id?>">Edit</a>
									<a class="btn btn-orange btn-xs" onclick="return confirm('Are you sure to delete?')" href="<?php echo base_url();?>admin/deleteAdmin/<?php echo $aa->id?>">Delete</a></td>
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

    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title"> List Country </div>
                    <a href="<?php echo base_url();?>admin/location/country/add" class="add-new pull-right btn btn-primary btn-gradient">Add New Country</a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table-striped table-bordered table-hover" id="datatable">
                            <thead>
                            <tr>
                                <th>Country Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sn=1;
                                foreach($all_country as $alc):
                                ?>
                                <tr <?php if($sn%2 == 0) {  echo 'class="tablealternate"'; }?>>
                                <td><?php echo $alc['country_name'];?></td>
                                <td><?php if($alc['status'] == '1') { echo 'Active'; } else { echo 'Inactive';}?></td>
                                <td colspan="2"><a class="btn btn-blue btn-xs" href="<?php echo base_url();?>admin/location/country/edit/<?php echo $alc['id'];?>">Edit</a> <a class="btn btn-orange btn-xs" href="<?php echo base_url();?>admin/deleteCountry/<?php echo $alc['id'];?>" onclick="return confirm('Are you sure to delete?')">Delete</a></td>
                                </tr>
                                <?php $sn++; endforeach; ?>
                            </tbody>
                        </table>
                        <div class="pagination"><?php echo $links; ?></div>
                    </div>
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
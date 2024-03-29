    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title"> List Suburb </div>
                    <a href="<?php echo base_url();?>admin/location/suburb/add" class="add-new pull-right btn btn-primary btn-gradient">Add New Suburb</a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table-striped table-bordered table-hover" id="datatable">
                            <thead>
                            <tr>
                                <th>Suburb Name</th>
                                <th>City Name</th>
                                <th>Country Name</th>
                                <th>Region Name</th>
                                <th>Featured Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sn=1;
                                foreach($all_suburb as $als):
                                ?>
                                <tr <?php if($sn%2 == 0) {  echo 'class="tablealternate"'; }?>>
                                <td><?php echo $als->suburb_name;?></td>
                                <td><?php echo $als->city_name;?></td>
                                <td><?php echo $als->country_name;?></td>
                                <td><?php echo $als->region_name;?></td>
                                <td><img width="50" src="<?php echo base_url();?>images/suburb/thumb/<?php echo $als->featured_image;?>" /></td>
                                <td><?php if($als->status == '1') { echo 'Active'; } else { echo 'Inactive';}?></td>
                                <td colspan="2"><a class="btn btn-blue btn-xs" href="<?php echo base_url();?>admin/location/suburb/edit/<?php echo $als->id;?>">Edit</a> <a class="btn btn-orange btn-xs" href="<?php echo base_url();?>admin/deletesuburb/<?php echo $als->id;?>" onclick="return confirm('Are you sure to delete?')">Delete</a></td>
                                </tr>
                                <?php $sn++; endforeach; ?>
                            </tbody>
                        </table>
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
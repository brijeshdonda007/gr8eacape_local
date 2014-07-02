    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title"> List Testimonials </div>
                    <a class="pull-right btn btn-primary btn-gradient" href="<?php echo base_url();?>admin/testimonials/add" class="add-new btn btn-primary btn-gradient">Add New</a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table-striped table-bordered table-hover" id="datatable">
                            <thead>
                            <tr>
                                <th>Guest Name</th>
                                <th>Detail</th>
                                <th>Profile Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sn=1;
                                foreach($testimonials as $tm):
                                ?>
                                <tr <?php if($sn%2 == 0) {  echo 'class="tablealternate"'; }?>>
                                    <td><?php echo $tm->guest_name;?></td>
                                    <td><?php echo word_limiter($tm->detail, 10);?></td>
                                    <td>
                                        <?php if (!empty($tm->image)){ ?>
                                            <img width="50" src="<?php echo base_url();?>images/testimonials/<?php echo $tm->image;?>" />
                                        <?php } else if (!empty($tm->profile_picture)) { ?>
                                            <img width="50" src="<?php echo base_url();?>images/profile_img/thumb/<?php echo $tm->profile_picture;?>" />
                                        <?php } else { ?>
                                            <img width="50" src="<?php echo base_url();?>assets/frontend/images/no-image.png" />
                                        <?php } ?>
                                    </td>
                                    <td colspan="2"><a class="btn btn-blue btn-xs" href="<?php echo base_url();?>admin/testimonials/edit/<?php echo $tm->id;?>">Edit</a> <a class="btn btn-orange btn-xs" href="<?php echo base_url();?>admin/deleteTesti/<?php echo $tm->id;?>" onclick="return confirm('Are you sure to delete?')">Delete</a></td>
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
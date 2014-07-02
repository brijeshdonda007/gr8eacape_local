 <script language="javascript"  src="<?php echo base_url ();?>assets/backend/js/banner.js"></script>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title"> Banners List </div>
                    <a class="pull-right btn btn-primary btn-gradient" href="<?php echo site_url('admin/banners/add'); ?>">Add New Banner</a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table-striped table-bordered table-hover" id="datatable">
                            <thead>
                            <tr>
                                <th class="sn">S.N</th>
                                <th>Banner Title</th>
                                <th>Content</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $sn=1; ?>
                                <?php foreach($banners as $banner): ?>
                                <tr class="tablealternate">
                                    <td>&nbsp;<?php echo @$sn++; ?></td>
                                    <td>&nbsp;<?php echo @$banner->banner_title; ?></td>
                                    <td>&nbsp;<?php echo @$banner->banner_description; ?></td>
                                    <td>&nbsp;<img src="<?php echo base_url().'images/banner_img/'.@$banner->image; ?>" alt="<?php echo @$banner->banner_title; ?>" width="60" height="40" /></td>
                                    <td>&nbsp;<?php echo $banner->banner_status == 1 ? 'Displayed':'Hidden';?></td>
                                    <td><a class="btn btn-blue btn-xs" href="<?php echo site_url('admin/banners/edit');?>/<?php echo $banner->id;?>">Edit</a> <a class="btn btn-orange btn-xs" href="<?php echo site_url('admin/deletebanner');?>/<?php echo @$banner->id;?>">Delete</a></td>
                                </tr>
                                <?php endforeach; ?>
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
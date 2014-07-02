    <div class="row">
        <div class="col-md-8">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title"> Menu Sections </div>
                    <a class="pull-right btn btn-primary btn-gradient" href="<?php echo site_url('admin/menu/section/add'); ?>">Add New Section</a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table-striped table-bordered table-hover" id="datatable">
                            <thead>
                            <tr>
                                <th>Section Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $sn=1; ?>
                                <?php foreach($sections as $section): ?>
                                <tr class="tablealternate" id="row_<?php echo $section->id;?>">
                                    <td>&nbsp;<?php echo @$section->name; ?></td>
                                    <td>&nbsp;<?php echo $section->status == 1 ? 'Active':'Inactive';?></td>
                                    <td><a class="btn btn-blue btn-xs" href="<?php echo site_url('admin/menu/edit');?>/<?php echo $section->id;?>">Configuration</a></td>
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
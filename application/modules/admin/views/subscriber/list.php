    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title"> List Subscriber </div>
                    <a class="pull-right btn btn-success" href="<?php echo site_url('admin/subscriber_export');?>">Export</a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table-striped table-bordered table-hover" id="datatable">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>Subscriber Full Name</th>
                                <th>Subscriber Email</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sn=1;
                                foreach($subscribers as $sb):
                                ?>
                                <tr <?php if($sn%2 == 0) {  echo 'class="tablealternate"'; }?>>
                                    <td><?php echo $sn ;?></td>
                                    <td><?php echo $sb->full_name ;?></td>
                                    <td><?php echo $sb->email_subscriber ;?></td>
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
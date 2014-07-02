<?php
$templates_links = array(
    "reg_confirm" => "register",
    "registered" => "activated",
    "forget_password" => "forget",
    "booking_email_to_buyer" => "booking_request_to_buyer",
    "booking_direct_email_to_buyer" => "booking_to_buyer",
    "booking_email_to_owner" => "booking_request_to_owner",
    "booking_direct_email_to_owner" => "booking_to_owner",
    "pre_confirmation_email" => "pre_confirmation_email",
    "post_confirmation_email" => "post_confirmation_email"
);

?>
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <div class="panel-title"> Escapes </div>
            </div>
            <div class="panel-body">
                <div class="col-md-12 table-responsive">
                <?php if($all_templates > 0)
                {?>
                    <table class="table-striped table-bordered table-hover" id="datatable" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sn=1;
                        foreach($all_templates as $template):
                        ?>
                        <tr <?php if($sn%2 == 0) {  echo 'class="tablealternate"'; }?>>
                            
                            <td><?php echo $template->name;?></td>
                            <td><a class="btn btn-blue btn-xs" href="<?php echo base_url();?>admin/email_template/<?php echo $templates_links[$template->name];?>">Edit</a></td>
                        </tr>
                         <?php $sn++; endforeach; ?>
                        </tbody>
                    </table>
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
  $('#datatable').dataTable();
  
//  $('#datatable').dataTable( {
//    "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ -1 ] }],
//    "oLanguage": { "oPaginate": {"sPrevious": "", "sNext": ""} },
//    "iDisplayLength": 2,
//    "aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
//  });   
});
</script>
<script language="javascript" src="<?php echo base_url ();?>assets/backend/js/property.js"></script>       
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <div class="panel-title"> Escape Verification </div>
            </div>
            <div class="panel-body">
                <div class="col-md-5">
                </div>
                <div class="col-md-12 table-responsive">
                <?php if($property_count > 0)
                {?>
                    <table class="table-striped table-bordered table-hover" id="datatable" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th> Send Date</th>
                                <th> Expire Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($all_property as $property): ?>
                         <tr>
                           <td><?php echo  $property->custom_url ?></td>
                            <td><?php echo  $property->title ?></td>
                             <td><?php echo  empty($property->send_date)? "-" : date("d m Y", strtotime($property->send_date)) ?></td>
                             <td><?php echo  empty($property->expire_date)? "-" : date("d M Y", strtotime($property->expire_date)) ?></td>
                            <td colspan="2">
                                <button class="btn btn-green btn-xs send_code" value="<?php echo $property->id ?>"> <?php echo empty($property->send_date)? "Send":"Resend"?> Code </button>
                                <button class="btn btn-blue3 btn-xs view_code" value="<?php echo $property->id;?>"> View Code </button>
                            </td>
                        </tr>
                         <?php endforeach; ?>
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


<div class="modal fade bs-modal-lg" id="c_myModal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Message</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-normal" id="close_modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/jquery-ui.css" />

<script type="text/javascript"  src="<?php echo base_url();?>assets/frontend/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/frontend/js/modal.js"></script>
<script type="text/javascript">
$(document).ready(function(){

    $('.send_code').click(function() {

        var escapeId = $(this).val();
        $(this).text("Resend Code");
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url();?>admin/sendVerificationCode",
            data: {escape_id: escapeId},
            dataType: 'json',
            success: function(data){
                $(".modal-body").append("<p>Code is sent</p>");
                $('#c_myModal').modal();
            }
        });
    });

    $('.view_code').click(function() {

        var escapeId = $(this).val();
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url();?>admin/viewVerificationCode",
            data: {escape_id: escapeId},
            dataType: 'json',
            success: function(data){
                console.log(data.expire_date);

                $(".modal-body").append("<p>Expire Date: " + data.expire_date + " </p>");
                $('#c_myModal').modal();
            }
        });
    });

    $('#close_modal').click(function(){
		$('.modal-header .close').click();
	});


  $('#datatable').dataTable( {
    "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ -1 ] }],
    "oLanguage": { "oPaginate": {"sPrevious": "", "sNext": ""} },
    "iDisplayLength": 6,
    "aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
  });   
});
</script>
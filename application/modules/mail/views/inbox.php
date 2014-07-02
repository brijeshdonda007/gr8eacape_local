<div class="Block clearfix">
     <h4>Inbox</h4>

     <table class="table table-striped">
        <thead>
            <tr>
                <th><input type="checkbox" name="all_mail_selection" id="all_mail_selection" value="all"/></th>
                <th>Subject</th>
                <th>From</th>
                <th>Sent</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
          <?php foreach($messages as $rd): ?>
          <tr>
            <td><input type="checkbox" name="mail_selection" class="mail_selection" value="<?php echo $rd->id?>" /></td>
            <td><a href="<?php echo site_url('mail/message/read?mgs_id='.$rd->id.'&type=from_user');?>"><?php echo $rd->subject;?></a></td>
            <td><a href="<?php echo site_url('owner/detail/'.$rd->from_user);?>"><?php echo $rd->first_name.' '.$rd->last_name;?></a></td>
            <td><?php echo date('d-F-Y H:i:s' ,$rd->timestamp); ?></td>
            <td><?php echo empty($rd->is_read)? 'Unread':'Read' ?></td>
            <td><a href="<?php echo site_url('mail/message/delete?mgs_id='.$rd->id.'&type=inbox');?>" onclick="confirm('Are you sure?')"> Delete </a></td>
          </tr>

          <?php endforeach; if(count($messages) == 0): ?>
            <tr>
                <td colspan="6" class="center" style="text-align: center">You have no messages.</td>
            </tr>
          <?php endif; ?>
        </tbody>
     </table>
    <input type="button" value="Delete All" id="bulk_delete_button" class="btn buttonBlue">
</div>

<script type="text/javascript">

    $(function(){

        //Checking that all selection is checked or not
        $('#all_mail_selection').on('change', function() {
            if($('#all_mail_selection').is( ":checked" )) {
                statChange(true);
            } else {
                statChange(false);
            }
        });

        //Process ajaxcall when delete button got clicked
       $('#bulk_delete_button').on('click', function() {

           var checkedIds = getAllSelection();

            if (checkedIds.length < 1) {
                alert('Please select mail.');
            } else {
                processBulkDeleteAjaxCall(checkedIds);
            }
       });
    });


    //Check all mail based on all selection checkbox
    function statChange(state)
    {
        $(".mail_selection").each(function() {
            $(this).prop('checked', state);
        });
    }

    //Return the array of selection
    function getAllSelection()
    {
        var checkedIds = [];

        $(".mail_selection").each(function() {
            if($(this).is( ":checked" )) {
                checkedIds.push($(this).val());
            }
        });

        return checkedIds;
    }

    //Process an ajax call and send all checked ids for bulk delete
    function processBulkDeleteAjaxCall(checkedIds)
    {
        $.ajax({
          url      : "<?php echo base_url() . 'mail/message/bulkDelete' ?>",
          type     : "POST",
          data     : {mgs_ids : checkedIds},
          dataType : 'json',
          success  : function(result) {

            if(result.status){
                location.reload();
            }
          }
        });
    }
</script>

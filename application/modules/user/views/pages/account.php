<div class="span9">
    <h1 class="pageTitle"> Company Information</h1>

    <p class="profile_detail">

    <form class="form-horizontal edit_profile"
          id="accountInfomationForm" method="post"
          action="<?php echo base_url() . 'user/account/saveCompanyInformation' ?>"
          enctype="multipart/form-data" >

        <fieldset>
            <input type="checkbox" name="is_business" id="is_business" value='1' style="width:20px;" <?php if (@$user_profile_info->is_business == '1') echo 'checked="checked"' ?>/>Do you have a Company??
        </fieldset>

        <fieldset  class="company_name" <?php echo (empty($user_profile_info->is_business)? 'style="display:none"':'') ?>>
            <label>Company Name:</label>
            <input type="text" name="company_name" value="<?php echo (empty($user_profile_info->is_business)?'':@$user_profile_info->company_name) ?>"/>
        </fieldset>
        <br/>
         <fieldset>
            <input type="checkbox" name="gst_reg" id="gst_reg" style="width:20px;" <?php if (@$user_profile_info->gst_reg == '1') echo 'checked="checked"'; ?> value="1"/>Do you pay GST for your company?
        </fieldset>

        <?php if (@$user_profile_info->gst_reg == '1'): ?>
            <fieldset class="gst_area">
                <label>GST Number: </label><input type="text" name="gst_num" value="<?php echo @$user_profile_info->gst_num; ?>"/>
            </fieldset>
        <?php endif ?>

        <br/>

        <div class="span15 infoBtn">
            <input type="submit" class="btn buttonBlue" id="mybutton" value="Update Information">
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#is_business').change(function(){
            if($(this).is(":checked")) {
                $('.company_name').show();
            }else{
                $('.company_name').hide();
            }
        });

        $('#gst_reg').change(function(){
            if($(this).is(":checked")) {
                var html     = '<fieldset class="gst_area">';
                html += '<label>GST Number:</label>';
                html += '<input type="text" name="gst_num" value="">';
                html += '</fieldset>';
                $(this).parent().after(html);
            }else{
                $('.gst_area').remove();
            }
        });
    });
</script>

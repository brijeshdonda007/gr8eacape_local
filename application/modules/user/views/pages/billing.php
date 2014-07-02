<div class="span9">
    <h1 class="pageTitle">Billing Information</h1>
    <p class="profile_detail">

    <form class="form-horizontal edit_profile"
          id="accountInfomationForm"
          method="post"
          action="<?php echo base_url() . 'user/account/saveBillingInformation' ?>"
          enctype="multipart/form-data" >

        <?php echo validation_errors(); ?>

        <div class="details">
            <fieldset>
                <label>Account Name:</label><input type="text" name="accountName" value="<?php echo $accountName; ?>" />
            </fieldset>
        </div>

        <div class="accountRow">

            <div class="left">
                <input id="payeeBank" name="payeeBank" class="bankField" value="<?php echo $payeeBank; ?>" data-minlength="2" type="text" value="" maxlength="2" tabindex="1" />
                <label for="payeeBank" class="bottomLabel bankFieldLabel">Bank</label>
            </div>
            <span class="dash">-</span>
            <div class="left">
                <input id="payeeBranch" name="payeeBranch" class="branchField" value="<?php echo $payeeBranch; ?>" data-minlength="4" type="text" value="" maxlength="4" tabindex="2" />
                <label for="payeeBranch" class="bottomLabel branchFieldLabel">Branch</label>
            </div>
            <span class="dash">-</span>
            <div class="left">
                <input id="payeeAccount" name="payeeAccount" class="accountNumberField" value="<?php echo $payeeAccount; ?>" data-minlength="7" type="text" value="" maxlength="7" tabindex="3" />
                <label for="payeeAccount" class="bottomLabel accountFieldLabel">Account</label>
            </div>
            <span class="dash">-</span>
            <div class="left">
                <input id="payeeSuffix" name="payeeSuffix" class="suffixField" value="<?php echo $payeeSuffix; ?>" data-minlength="2" type="text" value="" maxlength="3" tabindex="4" />
                <label for="payeeSuffix" class="bottomLabel suffixFieldLabel">Suffix</label>
            </div>
        </div>

        <div class="span15 infoBtn">
            <input type="submit" class="btn buttonBlue" id="mybutton" value="Update Information">
        </div>
    </form>
</div>
<?php if($this->session->flashdata('success_msg')): ?>
    <p><?php echo $this->session->flashdata('success_msg') ?></p>
<?php endif ?>

<h4 class="marginNone">Address Verification</h4>
<div class="triangleArrow top"></div>
<div class="Block clearfix">
	<div class="row-fluid clearfix">
		<div class="span10">

			<?php if(!empty($verification_content)): ?>
                <?php echo html_entity_decode($verification_content['page_description']);?>
            <?php endif ?>

		</div>
		<div class="clear"></div>
        <div class="span10 marginNone">
            <form METHOD="post" action="<?php echo base_url()?>verification/payment/confirmation">

                 <select name="property_id" id="property_id">
                     <option> - Select Your Escape - </option>
                      <?php foreach($escapes as $escape) : ?>
                      <option value="<?php echo $escape['id'] ?>"> <?php echo $escape['title'] ?> </option>
                      <?php endforeach; ?>
                </select>
                <input type="hidden" name="total_price" value=<?php echo $address_verification_total_price ?> />
                <input type="submit" id="property_approve_status_submit" name="Submit" value="Submit" />
            </form>

            <br/>
            <table class="table table-striped latest-r" >
                <thead>
                    <tr>
                        <td>
                            Property Title
                        </td>
                        <td>
                            Status
                        </td>
                        <td>
                            Expiry Date
                        </td>
                    </tr>
                </thead>
                <tbody id="status_table_tbody" >
                    <?php foreach($accepted_escapes as $approved_escape): ?>
                    <tr>
                        <td>
                            <?php echo $approved_escape['title'] ?>
                        </td>
                        <td>
                            <?php echo empty($approved_escape["status"])? "":ucfirst($propertyapprove_status[$approved_escape['status']]) ?>
                        </td>
                        <td>
                            <?php echo $approved_escape['expire_date'] ?>
                        </td>
                    </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>

    	</div>
	</div>
</div>
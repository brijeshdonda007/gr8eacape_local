<style>
	input[type=text]{
		width:80px;
	}
</style>
<section id="content">
	<div class="wrapper clearfix">
		<ul class="breadcrumb">
			<li><a href="<?php echo site_url();?>"><img src="<?php echo base_url();?>assets/frontend/images/home-breadcrumb.png" /></a></li>
			<li><a href="<?php echo site_url();?>">Home</a> <span class="divider"><img src="<?php echo base_url();?>assets/frontend/images/breadcrumb-divider.png" alt="" /></span></li>
			<li>Book Now</li>
		</ul>
		<div class="row-fluid">
        <div class="span8" style="margin:0 16%;">
			<table class="table table-striped boot-load latest-r" >
			    <thead>
			      <tr>
                    <th>Escape</th>
                    <th style="width:20%">Location</th>
                    <th style="width:15%">Check In</th>
                    <th style="width:15%">Check Out</th>
                    <th style="width:5%">Days</th>
                    <th style="width:5%">Guests</th>
                    <th style="width:5%" class='alnright'>Subtotal</th>
			      </tr>
			    </thead>
			    <tbody>
				<tr>
				    <?php $date = new DateTime($booking_data['end_date']);
				         $date->modify('+1 day'); $end_date = $date->format('Y-m-d'); ?>

                    <td><a href="<?php echo site_url('escapedetails/index/'.$booking_data['property_id']);?>"><?php echo $booking_data['title'];?></a></td>
                    <td><?php echo $escape_detail->region_name; ?>, <br /><?php echo $escape_detail->country_name; ?></td>
                    <td><?php echo $booking_data['start_date'];?></td>
                    <td><?php echo $end_date;?></td>
                    <td style="text-align:center"><span class="days"><?php echo $booking_data['booked_days'];?></span></td>
                    <td style="text-align:center"><?php echo $booking_data['no_of_guests'];?></td>
                    <td class='alnright'>
                        <span class="total">
                         <?php echo number_format($booking_data['total_price'], 2, '.', '') ?>
                        </span>
                    </td>
			    </tr>
                	</tbody>
			</table>
            
			<table class="table table-striped boot-load pull-right" style="width:150px" >
			   
			    <tbody>
                <tr>
                    
                    
                </tr>
                <?php if(!empty($escape_detail->bond_amount)): ?>
                <tr>
                    
                      <td  style="padding-right:0 !important">Bond</td>
                      <td class='alnright'><span class="bound_amount"><?php echo number_format($escape_detail->bond_amount, 2, '.', '');?></span></td>
                </tr>
				<?php endif ?>

                <?php if(!empty($escape_detail->cleaning_amount)): ?>
                <tr>
                      
                      
                      <td style="padding-right:0 !important">Cleaning</td>
                      <td class='alnright'><span class="cleaning_amount"><?php echo number_format($escape_detail->cleaning_amount, 2, '.', '');?></span></td>
                </tr>
				<?php endif ?>
                <tr>
                     
                      <td  style="padding-right:0 !important">Subtotal</td>
                      <td class='alnright'><span class="gstp"><?php echo number_format(totalCalc($booking_data['total_price'], $escape_detail->cleaning_amount, $escape_detail->bond_amount, false), 2, '.', '');?></span></td>
                </tr>

                <tr>
                      
                      <td  style="padding-right:0 !important">GST( 15 % )</td>
                      <td class='alnright'><span class="gstp"><?php echo number_format($gstp, 2, '.', '');?></span></td>
                </tr>

				  <tr>
                     
                      <td style="padding-right:0 !important">Grand Total</td>
                      <td class='alnright'><span class="grand_total"><?php echo number_format($grand_total, 2, '.', '');?></span></td>
			      </tr>
				</tbody>
			</table>
            
             <div class="clearfix" style="margin-bottom:20px;"></div>
			<div class="swipe-hq-button">

                <input type="hidden" id="total_price" value="<?php echo $booking_data['total_price']; ?>" />
				<input type="hidden" id="escape_id" value="<?php echo $booking_data['property_id']; ?>" />
				<input type="hidden" id="booked_days" value="<?php echo $booking_data['booked_days']; ?>" />
				<input type="hidden" id="is_business" name="is_business" value="<?php echo $booking_data['is_business']; ?>">

				<div style="margin-bottom:10px;">
					<label for="accept"><input type="checkbox" name="accept" id="accept" /><a href="/terms" target="_blank">I accept terms and conditions</a></label>
				</div>

				<div class="checkout_btns">
					<a href="javascript:void(0);" class="btn buttonBlue" id="checkout">Book Now</a>
					<a href="javascript:history.back();" class="btn buttonRed">Cancel order</a>
				</div>
				<div class="span12">
				</div>
		</div>
        
		</div>
       
	</div>
</section>

<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/jquery-ui.css" />
<script src="<?php echo base_url();?>assets/frontend/js/jquery-ui.js"></script>
<script>
function NotBeforeToday(date)
{
	var now = new Date();//this gets the current date and time
	if (date.getFullYear() == now.getFullYear() && date.getMonth() == now.getMonth() && date.getDate() >= now.getDate())
		return [true];
	if (date.getFullYear() >= now.getFullYear() && date.getMonth() > now.getMonth())
		return [true];
	 if (date.getFullYear() > now.getFullYear())
		return [true];
	return [false];
}
</script>
<script>
$(document).ready(function() {
      $('#validDefaultDatepicker').datepicker();
      $.datepicker.setDefaults($.datepicker.regional['en']);
      $('#start_date').datepicker({
          dateFormat: "dd/mm/yy",
          changeMonth: true,
          changeYear: true,
          required: true,
          beforeShowDay: NotBeforeToday,
          onSelect: function(selectedDate) {
            var date = $(this).datepicker('getDate');
            $('#end_date').datepicker('option', 'minDate', date); // Reset minimum date
            date.setDate(date.getDate() + 1); // Add 1 days
            $('#end_date').datepicker('setDate', date); // Set as default
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
	    var is_business = $('#is_business').val();
            if((start_date != '' ) && (end_date != ''))
                {
                    //$('#ajax-booking').html('<img src="<?php echo base_url();?>assets/frontend/images/103.gif" />');
                    $.ajax({
                      type: 'POST',
                      url: "<?php echo base_url();?>ajax/checkAvailability",
                      data: {property_id: '<?php echo $escape_detail->id;?>', start_date: start_date, end_date: end_date},
                        success: function(data){
                        var obj = $.parseJSON(data);
                        if(obj.success == 0)
                            {
                                alert('not available');
                            }
                            else{
								var gstp = (15/100) * obj.total_price_final;
								if (is_business == '1')
									var gst_amt = obj.total_price_final + gstp;
								else
									var gst_amt = obj.total_price_final;
								var ccfp = (3/100) * gst_amt;
								//var grand_total = gst_amt + ccfp;
								var grand_total = gst_amt;
								$('.gstp').html(gstp.toFixed(2));
								//$('.ccfp').html(ccfp.toFixed(2));
								$('.grand_total').html(grand_total.toFixed(2));
								$('.total').html(obj.total_price_final);
								$('.days').html(obj.booked_days);
								$('#booked_days').val(obj.booked_days);
								$('#total_price').val(obj.total_price_final);
                            }
                      }
                });
                }
      }});
      $('#end_date').datepicker({
          dateFormat: "dd/mm/yy",
          changeMonth: true,
          changeYear: true,
          beforeShowDay: NotBeforeToday,
          onSelect: function(selectedDate) {
            $('#start_date').datepicker('option', 'maxDate', $(this).datepicker('getDate')); // Reset maximum date
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
	    var is_business = $('#is_business').val();
            if((start_date != '' ) && (end_date != ''))
                {
                    //$('#ajax-booking').html('<img src="<?php echo base_url();?>assets/frontend/images/103.gif" />');
                    $.ajax({
                      type: 'POST',
                      url: "<?php echo base_url();?>ajax/checkAvailability",
                      data: {property_id: '<?php echo $escape_detail->id;?>', start_date: start_date, end_date: end_date},
                        success: function(data){
                        var obj = $.parseJSON(data);
                        if(obj.success == 0)
                            {
                                alert('not available');
                            }
                            else{
								var gstp = (15/100) * obj.total_price_final;
								if (is_business == '1')
									var gst_amt = obj.total_price_final + gstp;
								else
									var gst_amt = obj.total_price_final;
								var ccfp = (3/100) * gst_amt;
								//var grand_total = gst_amt + ccfp;
								var grand_total = gst_amt;
								$('.gstp').html(gstp.toFixed(2));
								//$('.ccfp').html(ccfp.toFixed(2));
								$('.grand_total').html(grand_total.toFixed(2));
								$('.total').html(obj.total_price_final);
								$('.days').html(obj.booked_days);
								$('#booked_days').val(obj.booked_days);
								$('#total_price').val(obj.total_price_final);
                            }
                      }
                	});
                }
      }});
});
</script>
<script>
$(document).ready(function(){
	$('#checkout').on('click', function(){
		if($("#accept").is(':checked')){
			var total_price = $('#total_price').val();
			var escape_id = $('#escape_id').val();
			var start_date = $('#start_date').val();
			var end_date = $('#end_date').val();
			var no_of_guests = $('#no_of_guests').val();
			var booked_days = $('#booked_days').val();
			var is_business = $('#is_business').val();
			$.ajax({
				type: 'POST',
				url: "<?php echo base_url();?>booking/booking_and_pay",
				data: {escape_id:escape_id, total_price:total_price,start_date:start_date, end_date:end_date, no_of_guests:no_of_guests,
						booked_days:booked_days, is_business:is_business},
				success: function(data){
					//var obj = $.parseJSON(data);
					$('.checkout_btns').html(data);
					$('#submit_swipehq_payment_form').click();
				}
			});
		}else{
			alert('You must agree on terms and conditions.');
		}
	});
});
</script>

<style>
input[type=text] {
	width:80px;
}
</style>
<section id="content">
<div class="wrapper clearfix">
<ul class="breadcrumb">
  <li><a href="<?php echo site_url('home'); ?>"><img src="<?php echo base_url(); ?>assets/frontend/images/home-breadcrumb.png" /></a></li>
  <li><a href="<?php echo site_url('home'); ?>">Home</a> <span class="divider"><img src="<?php echo base_url(); ?>assets/frontend/images/breadcrumb-divider.png" alt="" /></span></li>
  <li>Confirm</li>
</ul>


<div class="row-fluid">

<!-- h2> <img src="<?php echo base_url(); ?>assets/frontend/images/user-icon.png"  alt="popular icon" /> Confirm Booking for <?php echo $escape_detail->title ?> </h2 -->
  <?php if($escape_detail->booking_type == '0'): ?>
  <form method="post" class="booking_confirm" action="<?php echo site_url('booking/request'); ?>">
  <?php else: ?>
  <form method="post" class="booking_confirm" action="<?php echo site_url('booking/booking_direct'); ?>">
    <?php endif ?>
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

                    <td><a href="<?php echo site_url('escapedetails/index/'.$booking_data['property_id']);?>"><?php echo $escape_detail->title;?></a></td>
                    <td><?php echo $escape_detail->region_name; ?>, <br /><?php echo $escape_detail->country_name; ?></td>
                    <td><?php echo $booking_data['start_date'];?></td>
                    <td><?php echo $booking_data['end_date'];?></td>
                    <td style="text-align:center"><span class="days"><?php echo $booking_data['booked_days'];?></span></td>
                    <td style="text-align:center"><?php echo $booking_data['no_of_guests'] ?></td>
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

                <?php if(empty($escape_detail->cleaning_amount)): ?>
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
                      <td class='alnright'><span class="gstp"><?php echo ((15/100) * $booking_data['total_price']) ?></span></td>
                </tr>

				  <tr>
                     
                      <td style="padding-right:0 !important">Grand Total</td>
                      <td class='alnright'><span class="grand_total"><?php echo totalCalc($booking_data['total_price'], $escape_detail->bond_amount ,$escape_detail->cleaning_amount, true) ?></span></td>
			      </tr>
				</tbody>
			</table>
            
             <div class="clearfix" style="margin-bottom:20px;"></div>
             
        <div class="swipe-hq-button">
          <div style="margin-bottom:10px;">
            <label for="accept">
              <input type="checkbox" name="accept" id="accept" />
              <a href="/terms" target="_blank">I accept terms and conditions</a></label>
          </div>
          <div class="checkout_btns">
            <input type="submit" class="btn buttonBlue" value="Confirm" />
            <a href="javascript:history.back()" class="btn buttonRed" role="button">Back</a> </div>
          <div class="span12"> </div>
        </div>
        
		</div>
         </form>
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


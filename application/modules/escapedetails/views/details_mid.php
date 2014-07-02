<?php if($this->session->flashdata('success_msg')): ?>
    <div class="message" >
    <?php echo $this->session->flashdata('success_msg') ?><br />
</div>
<?php endif ?>

<script type="text/javascript">
    var price_text = '<?php echo $property_detail->price_night;?>';
</script>

<div class="row-fluid clearfix">
	<div class="span9 span9option detailPage">
		<div class="ratingstars floatRight">
			<?php
			$total_avgt = 0;
			$str = $this->uri->segment(2);
			preg_match_all('!\d+!', $str, $matches);
			$prop_id = intval($matches[0][0]);
			foreach($ratings_cat as $rc)
			{
			 $eachcat_avg_rate = $this->escapedetails_model->avgRateByCatID($rc->id, $prop_id);
			 $total_avgt +=  $eachcat_avg_rate->avgr;
			 }
			$ovarall_ratingst = ($total_avgt/count($ratings_cat));
			?>
			<div class="stars-overall-top"><?php echo $ovarall_ratingst;?></div>
			<div><?php if(count($total_reviews) > 0){?>(<?php echo count($total_reviews); ?> Guest Reviews)<?php } else { echo '(No Reviews)'; }?></div>
		</div>
		<h2><?php echo $property_detail->title;?></h2>
		<?php $this->load->view('escapedetails/details_slider');?>
		<div class="tabbable">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab1" data-toggle="tab">Information</a></li>
				<li class=""><a href="#tab2" data-toggle="tab">Facilities</a></li>
				<li class=""><a href="#tab3" id="map_location" data-toggle="tab"> Location Details</a></li>
				<li class=""><a href="#tab5" data-toggle="tab">Calendar</a></li>
				<li class=""><a href="#tab4" data-toggle="tab">Guest Reviews</a></li>
				<li class=""><a href="#tab10" data-toggle="tab">More Details</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab1">
				<h4 style="color:#2184be;margin-top:20px;">Escape Description</h4><br>
                  <?php echo $property_detail->detail;?><br>
				<?php if(count($escapeChannelsArr) > 0 ){ ?>  
				<h4 style="color:#2184be;margin-top:20px;">Television</h4>
				<ul class="propertyDetail">
				<?php 
						foreach($escapeChannelsArr as $key => $value) {
							foreach($escapeChannelsArr[$key] as $escape_key => $escapechannel) {
								if($escape_key == 0){ ?>
									<li style="color:#EE1162;"><dd><?php echo $escapechannel->tv_category;?></dd></li>
							<?php
								}
								echo '<li><dd>'.$escapechannel->name.'</dd></li>';
							}						
						}
				 ?>
				 </ul>
				 <?php } ?>
				</div>
				<div class="tab-pane" id="tab2">
					<div class="ame_row">
						<ul>
							<?php foreach($amenities as $ame){ ?>
							<?php if (in_array($ame->id, $property_amenities)){ ?>
							<li><div class="tick"></div><strong ><?php echo $ame->name; ?></strong>
							<?php } else { ?>
							<li><div class="no_tick"></div><span><?php echo $ame->name; ?></span>
							<?php } ?>
							<?php if ($ame->description != '') { ?><div class="ame_help" style="display:none;" <?php echo 'title="'.$ame->description.'"'; ?>></div><?php } ?>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
				<div class="tab-pane " id="tab3">
					<?php $this->load->view('escapedetails/location_map');?>
				</div>
				<div class="tab-pane " id="tab5">
					<div class="booking-calendar" style="width: 231px; height: 500px;">
						<?php $this->load->view('escapedetails/calendar');?>
					</div>
				</div>
				<div class="tab-pane" id="tab4">
					<div>
					<?php  $this->load->view('escapedetails/rate_reviews'); ?>
					</div>
				</div>
				<div class="tab-pane" id="tab10">
					<div>
					<?php  $this->load->view('escapedetails/more_details'); ?>
					</div>
				</div>
			</div>
		</div>
      <?php // $this->load->view('escapedetails/rate_reviews_form');?>   
	</div>
	<div class="span3 span3option detailPage">
		<script>
			function copy(val)
			{
                price_text = val;
				$("#price_text").html('<strong>NZ </strong>'+val);

			}
		</script>
		<div class="Block">
			<div id="price_detail">
				<form action="#" method="post" class="DetailForm" name="price-form1">
					<fieldset>
						<div class="pull-left"><span>From</span>
							<h1 id="price_text"><strong>NZ </strong><?php echo $property_detail->price_night;?></h1>
						</div>
						<?php
							$winter_is_disabled  = '';
							$holiday_is_disabled = '';
							$summer_is_disabled  = '';
							if($property_detail->winter_price_night == 0 || empty($property_detail->winter_price_night)){
								$winter_is_disabled  = 'disabled';
							}
							if($property_detail->holiday_price_night == 0 || empty($property_detail->holiday_price_night)){
								$holiday_is_disabled = 'disabled';
							}
							if($property_detail->summer_price_night == 0 || empty($property_detail->summer_price_night)){
								$summer_is_disabled  = 'disabled';
							}
						?>
						<div class="pull-right">
							<select name="price_per" onchange="copy(this.value)">
							 <optgroup label="Standard Rates">
								<option selected="selected" value="<?php echo $property_detail->price_night;?>">Per Night</option>
								<option value="<?php echo $property_detail->price_week;?>">Per Week</option>
								<option value="<?php echo $property_detail->price_month;?>">Per Month</option>
							</optgroup>								
							<optgroup <?php echo $winter_is_disabled; ?> label="Winter Rates">
								<option selected="selected" value="<?php echo $property_detail->winter_price_night;?>">Per Night</option>
								<option value="<?php echo $property_detail->winter_price_week;?>">Per Week</option>
								<option value="<?php echo $property_detail->winter_price_month;?>">Per Month</option>								
							</optgroup>	
							 <optgroup <?php echo $holiday_is_disabled; ?>  label="Holiday Rates">
							 	<option selected="selected" value="<?php echo $property_detail->holiday_price_night;?>">Per Night</option>
								<option value="<?php echo $property_detail->holiday_price_week;?>">Per Week</option>
								<option value="<?php echo $property_detail->holiday_price_month;?>">Per Month</option>	
							</optgroup>	
							<optgroup <?php echo $summer_is_disabled; ?> label="Summer Rates">
								<option selected="selected" value="<?php echo $property_detail->summer_price_night;?>">Per Night</option>
								<option value="<?php echo $property_detail->summer_price_week;?>">Per Week</option>
								<option value="<?php echo $property_detail->summer_price_month;?>">Per Month</option>
							</optgroup>	
							</select>
						</div>
					</fieldset>
				</form>
			</div>
			<fieldset>
				<div class="booking-calendar" style="width: 231px; height: 500px;display:none;">
					<?php $this->load->view('escapedetails/calendar');?>
				</div>
			</fieldset>
			<?php if ($property_detail->booking_type == '0'){ ?>
			<form action="<?php echo site_url('booking/request_confirm');?>" method="post" class="availability-check">
			<?php } else { ?>
			<form action="<?php echo site_url('booking/booking_direct');?>" method="post" class="availability-check">
			<?php } ?>
				<fieldset>
					<div class="row-fluid clearfix">
						<div class="booking-check">Check In<br />
							<input type="text" value="" name="start_date" id="start_date" />
						</div>
						<div class="booking-check">Check Out<br />
							<input type="text" value="" id="end_date" name="end_date" xonSelect="myFunction();" />
						</div>
						<div class="booking-check">Guests<br />
							<select name="no_of_guests" id="no_of_guests">
								<?php for($guest = 1; $guest<=$property_detail->guest_capacity; $guest++) : ?>
								    <option value="<?php echo $guest;?>" ><?php echo $guest;?></option>
								<?php endfor; ?>
                            </select>
						</div>
					</div>
				</fieldset>
				<div id="ajax-booking">
					<fieldset>
						<?php if ($property_detail->booking_type == '0'){ ?>
							<button class="btn btn-block buttonGreen-small" type="submit">Request Booking</button>
						<?php } else { ?>
							<button class="btn btn-block buttonGreen-small" type="submit">Booking Now</button>
						<?php } ?>
					</fieldset>
				</div>
				<input type="hidden" name="gst_reg" id="gst_reg" value="<?php echo $property_owner->gst_reg; ?>" />
			</form>
		</div>
		<div class="clear"></div>
		<script>
		(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
			  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		</script>
		<div class="Block">
			<h1 class="blockHeader"> <!--<img src="<?php echo base_url();?>assets/frontend/images/propertyicon.jpg" alt="login icon" />-->Escape Details</h1>
			<ul class="propertyDetail">
				
				<li><dd>Type of Escape: </dd><?php echo @$type_escape->title;?></li>

				<?php foreach($property_extra as $pex): ?>
                    <li><dd><?php echo $pex->type ?>:</dd>	<?php echo $pex->value?></li>
				<?php endforeach ?>

				<li><dd>Weekly Price: </dd>$<?php echo $property_detail->price_week;?></li>
				<li><dd>Monthly Price: </dd>$<?php echo $property_detail->price_month;?></li>

                <?php if (($property_detail->bond_amount != '0') && ($property_detail->bond_amount != '')): ?>
				    <li><dd>Bond : </dd>$<?php echo $property_detail->bond_amount; ?> </li>
				<?php endif ?>

                <li><dd>Bedrooms: </dd><?php echo $property_detail->bedroom;?></li>
                <li><dd>Bathrooms: </dd><?php echo $property_detail->bathroom;?></li>
                <li><dd>Adults: </dd><?php echo $property_detail->guest_capacity;?></li>
                <li><dd>Children: </dd><?php echo ($property_detail->children == 0)? 'Allowed':'Not Allowed';?></li>
                <li><dd>Pets: </dd><?php echo ($property_detail->pet == 1)? 'Allowed':'Not Allowed';?></li>
                <li><dd>Smoking: </dd>
            <?php if($property_detail->smoking == 1){
                            echo "Not Inside";
                        } elseif($property_detail->smoking == 2) {
                            echo "Outside Only";
                        } else {
                            echo "Not on Property";
                        }?>
                </li>
                <li><dd>Cleaning: </dd>
                <?php if( property_exists( get_class($property_detail), 'cleaning' ) ) {
                            if($property_detail->cleaning == 1) {
                                            echo "Leave it as you found it, spic & span,we don’t have a cleaner";
                                        } elseif($property_detail->cleaning == 2) {
                                            echo "Leave it tidy, but no need to spring clean, we have a cleaner coming in after you leave";
                                        } else {
                                            echo "No need to clean, this escape is cleaned";
                                        }
                       }
                ?>
                </li>
                <li><dd>Bed Linen: </dd>
                    <?php if( property_exists( get_class($property_detail), 'bed_lines' ) ) {echo ($property_detail->bed_lines == 1)? "Not Included, please bring your own" : "All provided for you, we will wash up after you have checked out" ;} ?>
                </li>

				<?php if($property_detail->street_visible!=1): ?>
                    <li><dd>Street Number: </dd> <?php echo $property_detail->street_no;?></li>
                    <li><dd>Street Name: </dd> <?php echo $property_detail->street_name;?></li>
				<?php endif ?>

				<?php if (!empty($property_suburb)): ?>
                    <li><dd>Suburb/Area: </dd> <?php echo $property_suburb->suburb_name;?></li>
                <?php endif ?>

                <?php if (!empty($property_city)): ?>
                    <li><dd>City: </dd> <?php echo $property_city->city_name ?></li>
                <?php endif ?>

				<?php if (!empty($property_region)): ?>
                    <li><dd>Region: </dd> <?php echo $property_region->region_name;?></li>
                <?php endif ?>

				<?php if (!empty($property_country)): ?>
                    <li><dd>Country: </dd> <?php echo $property_country->country_name;?></li>
                <?php endif ?>

				<li>
					<dd>Cancellation:</dd>
					<?php switch($property_detail->booking_cancelation){
						case 'Reasonable':
							echo '<a href="javascript:void(0);" id="cancelation_reasonable">Reasonable</a>';break;
						case 'Relaxed':
							echo '<a href="javascript:void(0);" id="cancelation_relaxed">Relaxed</a>';break;
						case 'Strict':
							echo '<a href="javascript:void(0);" id="cancelation_strict">Strict</a>';break;
					}?>
				</li>
			</ul>
		</div>
		<div class="Block ownerBlock">
			<div style="text-align:center;">
				<?php if (!empty($property_owner)): ?>
					<img src="<?php echo base_url();?>images/profile_img/large/<?php echo $property_owner->profile_picture;?>" class="" alt="owner" />
				<?php endif ?>
			</div>
			<div style="text-align:center;">
				<?php if (!empty($property_owner)){ ?>
				<h3><?php echo $property_owner->first_name.' '.$property_owner->last_name;?></h3
				<?php } ?>
				<strong>Member since</strong> <br />
				<?php if (!empty($property_owner)){ ?>
				<?php 
				$old_date_timestamp = strtotime($property_owner->user_created_date);
				$new_date = date('jS F Y', $old_date_timestamp);
				?>
				<?php echo $new_date; ?>
				<?php } ?>
			</div>
			<div class="align-center">
				<a href="<?php echo site_url('mail/message/new?id='.$property_detail->id )?>" class="btn buttonBlue">Contact <?php echo ucfirst($property_owner->first_name);?></a>
				<?php if (!empty($property_owner)){ ?>
				<p><a href="<?php echo site_url('owner/detail/'.$property_owner->id);?>">View <?php echo ucfirst($property_owner->first_name);?>'s Profile</a></p>
				<?php } ?>
			</div>
			<div>
				<ul class="propertyDetail">
					<?php if (!empty($property_owner)){ ?>
					<li>Last Online : <a href="<?php echo site_url('owner/detail/'.$property_owner->id);?>">
					<?php 
							// converting date to m/d/y formmt
							$date = new DateTime($property_owner->last_login);
							$last_login = $date->format('d/m/Y H:m:s');
							echo $last_login;
					?>
					</a></li>
					<?php } ?>
					<li>Last updated :
					   <?php
					   // converting date to m/d/y formmt
					   	if ($property_detail->updated_date == '0000-00-00 00:00:00') {
					   		$date = new DateTime($property_detail->created_date);
							$created_date = $date->format('d/m/Y H:m:s');
							echo $created_date;
						} else {
						// converting date to m/d/y formmt
							$date = new DateTime($property_detail->updated_date);
							$updated_date = $date->format('d/m/Y H:m:s');
							echo $updated_date;
							
						}
					   ?>
					</li>
					<li></li>
				</ul>
			</div>
		</div>
		<div class="Block">
			<h1 class="blockHeader"> <img src="<?php echo base_url();?>assets/frontend/images/icon-promise.png" alt="login icon" />Gr8 Escapes Promise</h1>
			<ul class="ServiceDetail">
				<li><strong>Trusted Source</strong>You are our #1 priority. Thousands of people trust Gr8 Escapes to help them choose their perfect holiday escape.</li>
				<li><strong>Flexibility &amp; Choice</strong>If you are not 100% happy with your escape you can cancel your booking at any time as per the cancellation &amp; refund policy.</li>
				<li><strong>Quality Assured</strong>You can choose from verified escapes &amp; escapes with Guest feedback to help you select the right escape for you.</li>				
			</ul>
		</div>
		<div class="Block" style="display:none;">
			<?php if (!empty($property_owner)){ ?>
			<h1 class="blockHeader"> <img src="<?php echo base_url();?>assets/frontend/images/listing.png" alt="login icon" /><?php echo $property_owner->first_name; ?>'s Other Listing</h1>
			<?php } ?>
			<ul class="media ownerListing">
				<?php foreach($owners_other as $ownx){?>
				<li>
					<a class="pull-left" href="<?php echo site_url('escapedetails/'.$ownx->custom_url);?>">
						<img class="media-object" src="<?php echo base_url();?>images/property_img/featured/thumb/<?php echo $ownx->featured_image;?>" alt="64x64">
					</a>
					<div class="media-body">
						<h4 class="media-heading"><a href="<?php echo site_url('escapedetails/'.$ownx->custom_url);?>"><?php echo $ownx->title;?> <span class="pink"><?php echo $ownx->price_night;?>/night</span></a></h4>
					</div>
				</li>
				<?php }?>
			</ul> 
		</div>
	</div>
</div>
				
<div class="modal fade bs-modal-lg" id="c_myModal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Booking Cancellation Policy</h4>
      </div>
      <div class="modal-body">
        <p>
    		<img class="modal_content" src="" />
		</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-normal" id="close_modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php // $this->load->view('escapedetails/you_might_love');?>
<script>
$('#map_location').on('shown', function (e) { 
	initialize(); // google map init function
});
</script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/jquery-ui.css" />

<script type="text/javascript" src="<?php echo base_url();?>assets/frontend/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/frontend/js/modal.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/frontend/js/bootbox.min.js"></script>

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

    //Other checking and stuffs
    $(document).ready(function(){
        $('#cancelation_reasonable').click(function(){
            $('#c_myModal img.modal_content').attr('src', '<?php echo base_url();?>assets/frontend/images/Cancellation_Reasonable.jpg');
            $('#c_myModal').modal();
        });
        $('#cancelation_relaxed').click(function(){
            $('#c_myModal img.modal_content').attr('src', '<?php echo base_url();?>assets/frontend/images/Cancellation_Relaxed.jpg');
            $('#c_myModal').modal();
        });
        $('#cancelation_strict').click(function(){
            $('#c_myModal img.modal_content').attr('src', '<?php echo base_url();?>assets/frontend/images/Cancellation_Strict.jpg');
            $('#c_myModal').modal();
        });
        $('#close_modal').click(function(){
            $('.modal-header .close').click();
        });
    });
</script>

<script type="text/javascript">
	var from = new Date();
	var to    = new Date();

	var dayDiff = 1;

    //Based on No of Guest selections
	$(function() {

        $('#no_of_guests').on("change", function() {

            var start_date   = $('#start_date').val();
            var end_date     = $('#end_date').val();
            var is_business  = $('#is_business').val();
            var no_of_guests = $('#no_of_guests option:selected').text();

            if((start_date != '' ) && (end_date != ''))
            {
                $('#ajax-booking').html('<img src="<?php echo base_url();?>assets/frontend/images/103.gif" />');

                $.ajax({
                  type: 'POST',
                  url: "<?php echo base_url();?>ajax/checkAvailability",
                  data: {property_id: '<?php echo $property_detail->id;?>',
                         start_date: start_date,
                         end_date: end_date,
                         no_of_guests: no_of_guests,
                         price_text: price_text},
                  success: function(data){

                      var obj = $.parseJSON(data);
                      if(obj.success == 0) {
                          $('#ajax-booking').html('<h1 id="total-price"><span>Not Available for Booking</span></h1>');
                      } else {
                            var output = '<fieldset><h1 id="total-price"><span>Total : </span><b>NZ &nbsp;&nbsp;</b><strong>'+obj.total_price_final+'</strong></h1>\n\
                            <input type="hidden" name="total_price" value='+obj.total_price_final+' />\n\
                            <input type="hidden" name="booked_days" value='+obj.booked_days+' />\n\
                            <input type="hidden" name="start_date" value='+obj.start_date.date+' />\n\
                            <input type="hidden" name="end_date" value='+obj.end_date.date+' />\n\
                            <input type="hidden" name="property_id" value='+obj.property_id+' />\n\
                            <button type="submit" class="btn btn-block buttonGreen-small">Request Booking</button></fieldset>';
                          $('#ajax-booking').html(output);
                      }
                  }
                });
            }

        });




      //Some calender setting
      $('#validDefaultDatepicker').datepicker();
      $.datepicker.setDefaults($.datepicker.regional['en']);

      //based on Start date
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

            var start_date   = $('#start_date').val();
            var end_date     = $('#end_date').val();
            var is_business  = $('#is_business').val();
            var no_of_guests = $('#no_of_guests option:selected:selected').text();

            if((start_date != '' ) && (end_date != ''))
            {
                $('#ajax-booking').html('<img src="<?php echo base_url();?>assets/frontend/images/103.gif" />');

                $.ajax({
                  type: 'POST',
                  url: "<?php echo base_url();?>ajax/checkAvailability",
                  data: {property_id: '<?php echo $property_detail->id;?>',
                         start_date: start_date,
                         end_date: end_date,
                         no_of_guests: no_of_guests,
                         price_text: price_text},
                  success: function(data) {
                    var obj = $.parseJSON(data);

                    if(obj.success == 0)
                    {
                        $('#ajax-booking').html('<h1 id="total-price"><span>Not Available for Booking</span></h1>');
                    } else {

                        var output = '<fieldset><h1 id="total-price"><span>Total : </span><b>NZ &nbsp;</b><strong> '+obj.total_price_final+'</strong></h1>\n\
                        <input type="hidden" name="total_price" value='+obj.total_price_final+' />\n\
                        <input type="hidden" name="booked_days" value='+obj.booked_days+' />\n\
                        <input type="hidden" name="start_date" value='+obj.start_date.date+' />\n\
                        <input type="hidden" name="end_date" value='+obj.end_date.date+' />\n\
                        <input type="hidden" name="property_id" value='+obj.property_id+' />\n\
                        <button type="submit" class="btn btn-block buttonGreen-small"><?php if ($property_detail->booking_type == "0"){ ?>Request Booking <?php } else { ?> Booking Now <?php } ?></button></fieldset>';
                        $('#ajax-booking').html(output);
                    }
                  }
            });
            }
      }});

      //based on end date
      $('#end_date').datepicker({
          dateFormat: "dd/mm/yy",
          changeMonth: true,
          changeYear: true,
          beforeShowDay: NotBeforeToday,
          onSelect: function(selectedDate) {

           $('#start_date').datepicker('option', 'maxDate', $(this).datepicker('getDate')); // Reset maximum date

           var start_date   = $('#start_date').val();
           var end_date     = $('#end_date').val();
           var is_business  = $('#is_business').val();
           var no_of_guests = $('#no_of_guests option:selected').text();

            if((start_date != '' ) && (end_date != ''))
            {
                $('#ajax-booking').html('<img src="<?php echo base_url();?>assets/frontend/images/103.gif" />');

                $.ajax({
                  type: 'POST',
                  url: "<?php echo base_url();?>ajax/checkAvailability",
                  data: {property_id: '<?php echo $property_detail->id;?>',
                         start_date: start_date,
                         end_date: end_date,
                         no_of_guests: no_of_guests,
                         price_text: price_text},
                  success: function(data) {
                    var obj = $.parseJSON(data);
                    if(obj.success == 0)
                    {
                        $('#ajax-booking').html('<h1 id="total-price"><span>Not Available for Booking</span></h1>');
                    } else {
                        var output = '<fieldset><h1 id="total-price"><span>Total : </span><b>NZ &nbsp;&nbsp;</b><strong>'+obj.total_price_final+'</strong></h1>\n\
                        <input type="hidden" name="total_price" value='+obj.total_price_final+' />\n\
                        <input type="hidden" name="booked_days" value='+obj.booked_days+' />\n\
                        <input type="hidden" name="start_date" value='+obj.start_date.date+' />\n\
                        <input type="hidden" name="end_date" value='+obj.end_date.date+' />\n\
                        <input type="hidden" name="property_id" value='+obj.property_id+' />\n\
                        <button type="submit" class="btn btn-block buttonGreen-small">Request Booking</button></fieldset>';
                      $('#ajax-booking').html(output);
                    }
                  }
                });
            }
      }});
	});

    //Checking and validation of date
	$(document).ready(function() {
		$('#start_date,#end_date').datepicker({ minDate: -7, maxDate: +7 });
		$('.availability-check').validate({
			errorPlacement: $.datepicker.errorPlacement,
			rules: {
				start_date:{
				required: true,
				dpDate: true,
				focusCleanup: true
				},
				end_date:{
				required: true,
				dpDate: true
				}
			}
		});
	});

	$('.availability-check :text').val('');

	$(function() {
	    $('div.stars-overall-top').starsOverallTop();
	});

	$.fn.starsOverallTop = function() {
	    return $(this).each(function() {
	        var val = parseFloat($(this).html());
	        var size = Math.max(0, (Math.min(5, val))) * 15;
	        var $span = $('<span />').width(size);
	        $(this).html($span);
	    });
	}

	$(document).ready(function() {
		$('#send_enquiry').validate({
			rules: {
				name: {
					required: true,
					maxlength: 40
				},
				email: {
					required: true,
					email: true
				},
				message: {
					required: true
				}
			},
			messages: {
                name: {
					required: "Please enter your first name",
					minlength: "Your first name must be less than 40 characters"
				},
				email: "Please enter a valid email address",
				message: "Please write message"
			},
            submitHandler: function(send_enquiry){
				var name = $('#name').val();  
				var email = $('#email').val(); 
				var message = $('#message').val(); 
				$('.popupInquiry').html('<img src="<?php echo base_url();?>assets/frontend/images/103.gif" />');
				$.ajax({
					type: "POST",
					data: {name : name, email : email, message : message},
					url: "<?php echo site_url('ajax/sendenquiry');?>",
					success: function(msg){
					if(msg == 1)
						{
							$('.popupInquiry').html('<h4>Thanks for your enquiry. We will contact you back very soon!</h4>'); 
						}
					},
					error: function(msg){
						console.log( "Error: " + msg);
					}
				});
        	}
		});
	});
</script>

<!-- Modal -->
<div id="myModal" class="modal hide fade owner-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Send your general Inquiry</h3>
	</div>
	<div class="popupInquiry">
		<form id="send_enquiry" name="send_enquiry" action="" method="post">
			<div class="modal-body">
				<fieldset>
					<label>Name</label> <input type="text" value="" name="name" id="name" />
				</fieldset>
				<fieldset>
					<label>Email</label> <input type="text" value="" name="email" id="email" />
				</fieldset>
				<fieldset>
					<label>Message</label> <textarea value="" name="message" id="message"></textarea>
				</fieldset>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary btn buttonBlue">Submit</button>
				<button class="btn btn buttonBlue" data-dismiss="modal" aria-hidden="true">Close</button>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	$(function() {
		$( document ).tooltip();
	});
</script>

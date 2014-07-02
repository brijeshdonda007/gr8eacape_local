<script type="text/javascript">
$(document).ready(function(){
    var counter = 2;
    $("#addButton").click(function () {
	if(counter>10){
            alert("Only 10 textboxes allow");
            return false;
	}
	var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + counter);
	newTextBoxDiv.after().html('<label>Label #'+ counter + ' : </label>' +
	      '<input type="text" name="item['+ counter +'][type]" id="textbox' + counter + '" value="" >' + '<input type="text" name="item['+ counter +'][value]" id="value1' + counter + '" value="" >');
	newTextBoxDiv.appendTo("#TextBoxesGroup");
	counter++;
     });
     $("#removeButton").click(function () {
	if(counter==1){
          alert("No more textbox to remove");
          return false;
       }
	counter--;
        $("#TextBoxDiv" + counter).remove();
     });
     $("#getButtonValue").click(function () {
	var msg = '';
	for(i=1; i<counter; i++){
   	  msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
	}
    	  alert(msg);
     });
  });
</script>
<script type="text/javascript">
    $(function () {
        $("[rel='tooltip']").tooltip();
    });
</script>
<section id="content">
    <div class="wrapper clearfix">
        <?php if(@$property_info){?>
        Escape Details of <?php echo $property_info->title;?>
        <?php }
		 else {
		     echo '<h2 style="float:left;">Add New Escape</h2><h4 style="float:right;line-height:40px;">Please provide the required(<span class="red">*</span>) fields to list your escape!</h4><div class="clear"></div>';
		 }?>
		<form id="form-3" method="post" class="profileform wizard" action="<?php echo site_url('user/addeditescape_details'); ?><?php if(isset($property_code)) { echo "/".$property_code;}?>" enctype="multipart/form-data">
		<input type="hidden" name="save_property_id"  id="save_property_id" value="0">
		<input type="hidden" name="property_status"  id="property_status" value="<?php @$property_info->property_status ?>">
		<input type="hidden" name="admin_action"  id="admin_action" value="<?php @$property_info->admin_action ?>">
		<input type="hidden" name="step1_save"  id="step1_save" value="0">
		<input type="hidden" name="step2_save"  id="step2_save" value="0">
		<input type="hidden" name="step3_save"  id="step3_save" value="0">
		<input type="hidden" name="step4_save"  id="step4_save" value="0">
		<input type="hidden" name="step5_save"  id="step5_save" value="0">
		<input type="hidden" name="certificate_upload"  id="certificate_upload" value="">
            <h3>General</h3>

            <article>
				<fieldset id="escape_title_wrap">
					<label class="control-label">Escape Name:<span>*</span></label>
					<input type="text" placeholder="" class="input-large" name="title" id="escape_title" value="<?php echo @$property_info->title; ?>">
				</fieldset>
				<fieldset id="escape_detail_wrap">
					<label class="control-label">Escape Description
					<span>*</span></label>
					<textarea name="detail" id="escape_detail"><?php echo stripslashes(@$property_info->detail);?></textarea>
				</fieldset>
				<fieldset id="escape_booking_type_wrap">
					<label class="control-label">Booking Type:<span>*</span></label>
					<select class="input-medium" id="bookingType" name="booking_type">
						<option value="">Please select booking type</option>
						<option value="0" <?php if(@$property_info->booking_type == '0') { echo 'selected'; }?>>Pre confirm booking</option>
						<option value="1" <?php if(@$property_info->booking_type == '1') { echo 'selected'; }?>>Confirmed booking </option>
					</select>
				</fieldset>
				<fieldset id="escape_type_wrape">
					<label class="control-label">Type of Escape:<span>*</span></label>
					<select rel="tooltip" title="Escape Category" class="input-medium" id="s" name="type_escape_id">
						<option value="">Select a Type of Escape</option>
						<?php foreach($escapes as $toe){ ?>
						<option value="<?php echo $toe->id;?>" <?php if($toe->id == @$property_info->type_escape_id) { echo 'selected'; }?>><?php echo $toe->title;?></option>
						<?php } ?>
					</select>
				</fieldset>
				<fieldset id="guest_capacity_wrap">
					<label class="control-label">Guest Capacity:<span>*</span></label>
					<select rel="tooltip" title="Total capacity" name="guest_capacity" id="guest_capacity">
					<option value="">Please select Guest Capacity</option>
					<?php for($guest = 1; $guest<=15; $guest++){
					$ab2 = $property_info->guest_capacity;
					?>
					<option value="<?php echo $guest;?>" <?php if(@$ab2 == $guest){ echo 'selected'; }?>><?php echo $guest;?></option>
					<?php } $abd = $property_info->guest_capacity;?>
					<option value="6" <?php if(@$abd == 6){ echo 'selected'; }?>>N/A</option>
					</select>
					</select>
				</fieldset>
				<fieldset id="children_wrap" class="radio-fix">
					<label>Children allowed</label>
					<input type="radio" name="children" id="children_allowed"value="1" <?php if (@$property_info->children == '1') echo 'checked="checked"'; ?> />Yes
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="children" id="children_allowed" value="0" <?php if (@$property_info->children == '0') echo 'checked="checked"'; ?> <?php if(!isset($property_info)){echo 'checked="checked"';} ?>/>No
				</fieldset>
				<fieldset id="pet_wrap" class="radio-fix">
					<label>Pets allowed</label>
					<input type="radio" name="pet" id="pet_allowed" value="0" <?php if (@$property_info->pet == '0') echo 'checked="checked"'; ?> />Inside Outside only 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="pet" id="pet_allowed" value="1" <?php if (@$property_info->pet == '1') echo 'checked="checked"'; ?> />No
				</fieldset>
				<fieldset id="check_in_date_wrap">
				<?php if(empty($property_info->check_in_date)) { 
							$value=date("d/m/Y");
					  } else {
							$date = new DateTime($property_info->check_in_date);
							$created_date = $date->format('d/m/Y');
							$value= $created_date;
					  }
				?>
					<label class="control-label">Check in time:<span>*</span></label>
					<input type="text" class="input-small" name="check_in_date" id="check_in_date" value="<?php echo $value; ?>" />
				</fieldset>
				<fieldset id="check_out_date_wrap">
				<?php if(empty($property_info->check_out_date)) {
								//// current date
							$value=date("d/m/Y");
					  } else {
								/// date from database
							$date = new DateTime($property_info->check_out_date);
							$created_date = $date->format('d/m/Y');
							$value= $created_date;
					  }
				?>
					<label class="control-label">Check out time:<span>*</span></label>
					<input type="text" class="input-small" name="check_out_date" id="check_out_date" value="<?php echo $value; ?>" />
				</fieldset>
				<fieldset id="smoking_wrap" class="radio-fix">
					<label>Smoking:</label>
					<input type="radio" name="smoking" id="smoking" value="1" <?php if (@$property_info->smoking == '1') echo 'checked="checked"'; ?> />Not Inside
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="smoking" id="smoking" value="0"  <?php if (@$property_info->smoking == '0') echo 'checked="checked"'; ?> /> Outside Only
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="smoking" id="smoking" value="2"  <?php if (@$property_info->smoking == '2') echo 'checked="checked"'; ?> />Not on Property
				</fieldset>
				<fieldset id="photographer_wrap" class="radio-fix">
					<label>Request for Photographer:</label>
					<input type="radio" name="photographer" value="1" <?php if (@$property_info->photographer == '1') echo 'checked="checked"'; ?> />Required
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="photographer" value="0" <?php if (@$property_info->photographer == '0') echo 'checked="checked"'; ?> />Not required
				</fieldset>
				<fieldset id="gallery_video_wrap" class="video-gallery-error">
					<label class="control-label" style="float:none;">Escape Video:</label>
					<label class="control-label small-text">Please put the youtube video ID, not video url.</label>
					<?php if (@$gallery_videos) { ?>
					<iframe class="iframe" src="<?php echo base_url();?>ajax/editGalleryVideo/<?php echo @$property_info->id;?>"></iframe>
					<?php } ?>
					<div id="text">
					<input name="property_video" id="property_video" type="text" value="<?php echo @$property_info->youtube_video_id; ?>"/>
					</div>
				</fieldset>
				<fieldset id="escape_age_wrap">
					<label class="control-label">Escape age:<span>*</span></label>
					<input type="text" placeholder="" class="input-large" name="age" id="age" value="<?php echo @$property_info->age; ?>" />
				</fieldset>
				<fieldset id="escape_dwellings_wrap">
					<label class="control-label">Number of dwellings:<span>*</span></label>
					<input type="text" placeholder="" name="dwelling" id="dwelling" value="<?php echo @$property_info->dwelling; ?>" />
				</fieldset>
				<fieldset id="escape_bedrooms_wrap">
					<label class="control-label">Number of bedrooms:<span>*</span></label>
					<input type="text" placeholder="" name="bedrooms" id="bedrooms" value="<?php echo @$property_info->bedroom; ?>" />
				</fieldset>
				<fieldset id="escape_bathrooms_wrap">
					<label class="control-label">Number of bathrooms:<span>*</span></label>
					<input type="text" placeholder="" name="bathrooms" id="bathrooms" value="<?php echo @$property_info->bathroom; ?>" />
				</fieldset>
				<fieldset id="escape_curtains_wrap">
					<label class="control-label">Curtains:<span>*</span></label>
					<select rel="tooltip" title="" name="curtains" id="curtains">
					<option value="0">N/A</option>
					<?php for($a = 1; $a<=5; $a++){
					$abd = $property_info->curtain;
					?>
					<option value="<?php echo $a;?>" <?php if(@$abd == $a){ echo 'selected'; }?>><?php echo $a;?></option>
					<?php } $abd = $property_info->curtain;?>
					<!--<option value="6" <?php if(@$abd == 6){ echo 'selected'; }?>>N/A</option> -->
					</select>
				<!--<fieldset id="escape_curtains_wrap">
					<label class="control-label">Curtains:<span>*</span></label>
					<input class="hover-star" type="radio" name="test-3B-rating-1" value="1" title="Very poor"/>
					<input class="hover-star" type="radio" name="test-3B-rating-1" value="2" title="Poor"/>
					<input class="hover-star" type="radio" name="test-3B-rating-1" value="3" title="OK"/>
					<input class="hover-star" type="radio" name="test-3B-rating-1" value="4" title="Good"/>
					<input class="hover-star" type="radio" name="test-3B-rating-1" value="5" title="Very Good"/>
					<span id="hover-test" style="margin:0 0 0 20px;">Roll over stars, then click to rate.</span>
					<input type="hidden" name="curtains" id="curtain_rating_value" value="" />
				</fieldset>-->
				</fieldset>
				<fieldset id="escape_appliances_wrap">
					<label class="control-label">Appliances:<span>*</span></label>
					<select rel="tooltip" title="" name="appliances" id="appliances">
					<option value="0">N/A</option>
					<?php for($b = 1; $b<=5; $b++){
					$abd = $property_info->appliance;
					?>
					<option value="<?php echo $b;?>" <?php if(@$abd == $b){ echo 'selected'; }?>><?php echo $b;?></option>
					<?php } $abd = $property_info->appliance;?>
				<!--	<option value="6" <?php if(@$abd == 6){ echo 'selected'; }?>>N/A</option> -->
					</select>		
				</fieldset>
				<fieldset id="escape_cutlery_wrap">
					<label class="control-label">Crockery/Cutlery:<span>*</span></label>
					<select rel="tooltip" title="" name="cutlery" id="cutlery" >
					<option value="0">N/A</option>
					<?php for($c = 1; $c<=5; $c++){
					$abd = $property_info->cutlery;
					?>
					<option value="<?php echo $c;?>" <?php if(@$abd == $c){ echo 'selected'; }?>><?php echo $c;?></option>
					<?php } $abd = $property_info->cutlery;?>
				<!--	<option value="6" <?php if(@$abd == 6){ echo 'selected'; }?>>N/A</option> -->
					</select>				
				</fieldset>
				<fieldset id="escape_carpet_wrap">
					<label class="control-label">Carpet:<span>*</span></label>
					<select rel="tooltip" title="" name="carpet" id="carpet">
					<option value="0">N/A</option>
					<?php for($d = 1; $d<=5; $d++){
					$abd = $property_info->carpet;
					?>
					<option value="<?php echo $d;?>" <?php if(@$abd == $d){ echo 'selected'; }?>><?php echo $d;?></option>
					<?php } $abd = $property_info->carpet;?>
			<!--		<option value="6" <?php if(@$abd == 6){ echo 'selected'; }?>>N/A</option> -->
					</select>
				</fieldset>
				<fieldset id="escape_furniture_wrap">
					<label class="control-label">Furniture:<span>*</span></label>
					<select rel="tooltip" title="" name="furniture" id="furniture">
					<option value="0">N/A</option>
					<?php for($e = 1; $e<=5; $e++){
					$abd = $property_info->furniture;
					?>
					<option value="<?php echo $e;?>" <?php if(@$abd == $e){ echo 'selected'; }?>><?php echo $e;?></option>
					<?php } $abd = $property_info->furniture;?>
				<!--	<option value="6" <?php if(@$abd == 6){ echo 'selected'; }?>>N/A</option> -->
					</select>
				</fieldset>
				<fieldset id="escape_utensil_wrap">
					<label class="control-label">Kitchen Utensils:<span>*</span></label>
					<select rel="tooltip" title="" name="utensil" id="utensil">
					<option value="0">N/A</option>
					<?php for($f = 1; $f<=5; $f++){
					$abd = $property_info->utensil;
					?>
					<option value="<?php echo $f;?>" <?php if(@$abd == $f){ echo 'selected'; }?>><?php echo $f;?></option>
					<?php } $abd = $property_info->utensil;?>
			<!--		<option value="6" <?php if(@$abd == 6){ echo 'selected'; }?>>N/A</option> -->
					</select>
				</fieldset>
				<fieldset id="escape_mattress_wrap">
					<label class="control-label">Beds/Mattresses:<span>*</span></label>
					<select rel="tooltip" title="" name="mattress" id="mattress">
					<option value="0">N/A</option>
					<?php for($g = 1; $g<=5; $g++){
					$abd = $property_info->mattress;
					?>
					<option value="<?php echo $g;?>" <?php if(@$abd == $g){ echo 'selected'; }?>><?php echo $g;?></option>
					<?php } $abd = $property_info->mattress;?>
			<!--		<option value="6" <?php if(@$abd == 6){ echo 'selected'; }?>>N/A</option> -->
					</select>
					</select>
					<div align="right" id="save_div" >
						<input type="button" name="save_button" value="Save Information" id="save_button" onclick="saveInformation(0);" style="width:150px">
					</div> 
				</fieldset>
            </article>

            <h3>Price</h3>
            <article>
                <fieldset id="price_night_wrap">
                    <label class="control-label">Price Per Night:<span>*</span></label>
                    <input type="text" placeholder="" class="input-large numberinput" name="price_night" id="price_night" value="<?php echo @$property_info->price_night; ?>">
                </fieldset>
                <fieldset id="price_week_wrap">
                    <label class="control-label">Price Per Week:<span>*</span></label>
                    <input type="text" placeholder="" class="input-large numberinput" name="price_week" id="price_week" value="<?php echo @$property_info->price_week; ?>">
                </fieldset>
                <fieldset id="price_month_wrap">
                    <label class="control-label">Price Per Month:<span>*</span></label>
                    <input type="text" placeholder="" class="input-large numberinput" name="price_month" id="price_month"  value="<?php echo @$property_info->price_month; ?>">
                </fieldset>
				<div id="season_rate_wrap">
					<fieldset id="standard_rate_wrap" class="radio-fix">
					<label class="control-label">Season Rate<span>*</span></label>
					<input type="hidden" name="standard_changed"id="standard_changed" value="0">
					<input type="hidden" name="winter_changed"  id="winter_changed" value="0">
					<input type="hidden" name="holiday_changed" id="holiday_changed" value="0">
					<input type="hidden" name="summer_changed"  id="summer_changed" value="0">
					<?php if(@$property_info->standard_rate==1) { 
								$standard_check="checked";
								$standard_style="";
								$start = explode('-',$property_info->standard_start_date); 
								$standard_start_date=$start[2]."/".$start[1]."/".$start[0]; 
								$end = explode('-',$property_info->standard_end_date); 
								$standard_end_date=$end[2]."/".$end[1]."/".$end[0]; 
								$standard_price_night = $property_info->standard_price_night;
								$standard_price_week = $property_info->standard_price_week;
								$standard_price_month = $property_info->standard_price_month;
							} else {
								$standard_check="";
								$standard_style='style="display:none;"';
								$standard_start_date='';
								$standard_end_date='';
								$standard_price_night = '';
								$standard_price_week = '';
								$standard_price_month = '';
							}
					
					?>
						<span style="margin-right:-3px;">Standard Rate </span><input type="checkbox" name="standard"  id="standard_rate" <?php echo $standard_check;?>/>
						
						<span id="standard_rate_div" <?php echo $standard_style ;?>>
							Start Date <input type="text" name="standard_start_date" id="standard_start_date"  value="<?php echo $standard_start_date ;?>" onclick='$(".error").hide();'>
							End Date <input type="text" name="standard_end_date" id="standard_end_date" value="<?php echo $standard_end_date;?>" onclick='$(".error").hide();'>
						</span>
						</fieldset>
						
						
						<fieldset id="winter_rate_wrap" class="radio-fix">
						<label class="control-label">&nbsp;</label>
					<?php if(@$property_info->winter_rate==1) { 
								$winter_check="checked";
								$winter_style="";
								$start = explode('-',$property_info->winter_start_date); 
								$winter_start_date=$start[2]."/".$start[1]."/".$start[0]; 
								$end = explode('-',$property_info->winter_end_date); 
								$winter_end_date=$end[2]."/".$end[1]."/".$end[0]; 
								$winter_price_night = $property_info->winter_price_night;
								$winter_price_week = $property_info->winter_price_week;
								$winter_price_month = $property_info->winter_price_month;
							} else {
								$winter_check="";
								$winter_style='style="display:none;"';
								$winter_start_date='';
								$winter_end_date='';
								$winter_price_night = '';
								$winter_price_week = '';
								$winter_price_month = '';
							}
					
					?>
						<span style="margin-right:14px;">Winter Rate</span><input type="checkbox" name="winter_rate" id="winter_rate" <?php echo $winter_check ;?> />
						
						<span id="winter_rate_div" <?php echo $winter_style ;?> >
							Start Date <input type="text" name="winter_start_date" id="winter_start_date" style="width:300px;" value="<?php echo $winter_start_date ;?>" onclick='$(".error").hide();'>
							End Date <input type="text" name="winter_end_date" id="winter_end_date" style="width:300px;" value="<?php echo $winter_end_date ;?>" onclick='$(".error").hide();'>
							
					</span>
						</fieldset>
						<fieldset id="winter_rate_div_price" class="radio-fix" <?php echo $winter_style ;?>>
							<label class="control-label">&nbsp;</label>
							Price Night<input type="text" name="winter_price_night" id="winter_price_night" style="width:300px;" value="<?php echo $winter_price_night;?>" onclick='$(".error").hide();'>
							Price Week<input type="text" name="winter_price_week" id="winter_price_week" style="width:300px;" value="<?php echo $winter_price_night;?>" onclick='$(".error").hide();'>
							Price Month<input type="text" name="winter_price_month" id="winter_price_month" style="width:300px;" value="<?php echo $winter_price_night;?>" onclick='$(".error").hide();'>
						</fieldset>
						
						<fieldset id="holiday_rate_wrap" class="radio-fix">
						<label class="control-label">&nbsp;</label>
					<?php if(@$property_info->holiday_rate==1) { 
								$holiday_check="checked";
								$holiday_style="";
								$holiday_start_date=$property_info->holiday_start_date;
								$holiday_end_date=$property_info->holiday_end_date;
								$holiday_price_night = $property_info->holiday_price_night;
								$holiday_price_week = $property_info->holiday_price_week;
								$holiday_price_month = $property_info->holiday_price_month;
							} else {
								$holiday_check="";
								$holiday_style='style="display:none;"';
								$holiday_start_date='';
								$holiday_end_date='';
								$holiday_price_night = '';
								$holiday_price_week = '';
								$holiday_price_month = '';
							}
					
					?>	
						
						<span style="margin-right:8px;">Holiday Rate</span><input type="checkbox" name="holiday_rate" id="holiday_rate"  <?php echo $holiday_check;?> />
						
						<span id="holiday_rate_div" <?php echo $holiday_style;?>>
							Start Date <input type="text" name="holiday_start_date" id="holiday_start_date" style="width:300px;" value="<?php echo $holiday_start_date ;?>" onclick='$(".error").hide();'>
							End Date <input type="text" name="holiday_end_date" id="holiday_end_date" style="width:300px;" value="<?php echo $holiday_end_date ;?>" onclick='$(".error").hide();'>
							
						</span>
						</fieldset>
						<fieldset id="holiday_rate_div_price" class="radio-fix" <?php echo $holiday_style;?>>
							<label class="control-label">&nbsp;</label>
							Price Night<input type="text" name="holiday_price_night" id="holiday_price_night" style="width:300px;" value="<?php echo $holiday_price_night;?>" onclick='$(".error").hide();'>
							Price Week<input type="text" name="holiday_price_week" id="holiday_price_week" style="width:300px;" value="<?php echo $holiday_price_week;?>" onclick='$(".error").hide();'>
							Price Month<input type="text" name="holiday_price_month" id="holiday_price_month" style="width:300px;" value="<?php echo $holiday_price_month;?>" onclick='$(".error").hide();'>
						</fieldset>
						
						<fieldset id="summer_rate_wrap" class="radio-fix">
						<label class="control-label">&nbsp;</label>
						
					<?php if(@$property_info->summer_rate==1) { 
								$summer_check="checked";
								$summer_style="";
								$summer_start_date=$property_info->summer_start_date;
								$summer_end_date=$property_info->summer_end_date;
								$summer_price_night = $property_info->summer_price_night;
								$summer_price_week = $property_info->summer_price_week;
								$summer_price_month = $property_info->summer_price_month;
							} else {
								$summer_check="";
								$summer_style='style="display:none;"';
								$summer_start_date='';
								$summer_end_date='';
								$summer_price_night = '';
								$summer_price_week = '';
								$summer_price_month = '';
							}
					
					?>		
						
						
						<span style="margin-right:3px;">Summer Rate</span><input type="checkbox" name="summer_rate"  id="summer_rate" <?php  echo $summer_check;?> />
						
						<span id="summer_rate_div" <?php echo $summer_style; ?>>
							Start Date <input type="text" name="summer_start_date" id="summer_start_date" style="width:300px;" value="<?php echo $summer_start_date ;?>" onclick='$(".error").hide();'>
							End Date <input type="text" name="summer_end_date" id="summer_end_date" style="width:300px;" value="<?php echo $summer_end_date ;?>" onclick='$(".error").hide();'>
							
						</span>
					
					</fieldset>
					<fieldset id="summer_rate_div_price" class="radio-fix" <?php echo $summer_style; ?> >
							<label class="control-label">&nbsp;</label>
							Price Night <input type="text" name="summer_price_night" id="summer_price_night" style="width:300px;" value="<?php echo $summer_price_night;?>" onclick='$(".error").hide();'>
							Price Week <input type="text" name="summer_price_week" id="summer_price_week" style="width:300px;" value="<?php echo $summer_price_week;?>" onclick='$(".error").hide();'>
							Price_night <input type="text" name="holiday_price_month" id="summer_price_month" style="width:300px;" value="<?php echo $summer_price_month;?>" onclick='$(".error").hide();'>
					</fieldset>
					
				</div>
                <fieldset id="booking_cancellation_wrap" class="radio-fix">
                    <label class="control-label">Booking Cancellation Policy<span>*</span></label>
					<input type="radio" class="booking_name_radio" name="booking_cancelation" value="Reasonable" <?php if (@$property_info->booking_cancelation == 'Reasonable') echo 'checked="checked"'; ?> <?php if(!isset($property_info)){echo 'checked="checked"';} ?>/><a href="javascript:void(0);" id="cancelation_reasonable">Reasonable</a>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" class="booking_name_radio"  name="booking_cancelation" value="Relaxed" <?php if (@$property_info->booking_cancelation == 'Relaxed') echo 'checked="checked"'; ?> /><a href="javascript:void(0);" id="cancelation_relaxed">Relaxed</a>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" class="booking_name_radio"  name="booking_cancelation" value="Strict" <?php if (@$property_info->booking_cancelation == 'Strict') echo 'checked="checked"'; ?> /><a href="javascript:void(0);" id="cancelation_strict">Strict</a>
                </fieldset>
                <fieldset id="bond_wrap" class="radio-fix">
            		<label class="control-label">Bond</label>
            		<div id="bond_val"><input type="text" name="bond_amount" id="bond_amount" value="<?php echo @$property_info->bond_amount; ?>"/></div>
                </fieldset>
				<div align="right" id="save_price_div" >
						<input type="button" name="save_price_button" value="Save Information" id="save_price_button" onclick="saveInformation(1);" style="width:150px">
				</div>  
            </article>

            <h3><span onclick="getLocationValues();">Location</span></h3>
            <article>
			 <?php $this->load->view('user/new_location_map');?>
				<fieldset class="radio-fix">
					<label>No street address</label>
					
					<input type="hidden" id="is_visible" value="0">
					<input type="hidden" name="street_enabled" id="street_enabled" value="0">
					<input type="hidden" name="is_street_enable" id="is_street_enable" value="0">
					<input type="hidden" name="street_visibility" id="street_visibility" value="0">
					<input type="hidden" name="is_street_visible" id="is_street_visible" value="0">
					<input type="checkbox" name="street_enable" id="street_enable" value="1" <?php if (@$property_info->street_enable == '1') echo 'checked="checked"'; ?> />Yes
					
				</fieldset>
				<fieldset class="radio-fix">
					<label>Hide details from escape listing</label>
					<input type="checkbox" name="street_visible" id="street_visible" value="1" <?php if (@$property_info->street_visible == '1') echo 'checked="checked"'; ?> />Yes
					<input type="hidden" name="is_checked" id="is_checked" value="0">
				</fieldset>
				<?php if(@$property_info->street_enable==1) { ?>
				<fieldset class="how_to_reach_wrap" id="reach_destination">
					<label>please provide location instructions on how to find this escape</label>
					<textarea name="how_to_reach" id="how_to_reach"><?php echo @$property_info->how_to_reach;?></textarea>
					
				</fieldset>
				
				<?php } else { ?>
				<fieldset class="how_to_reach_wrap" id="reach_destination" style="display:none;">
					<label>please provide location instructions on how to find this escape</label>
					<textarea name="how_to_reach" id="how_to_reach"></textarea>
					<input type="hidden" id="is_enable" value="0">
				</fieldset>
				<?php } ?>
				<?php if (@$property_info->street_enable != '1'){?>
               <fieldset id="street_number_wrap">
                    <label class="control-label">Street Number:<span>*</span></label>
                    <input type="text" placeholder="" class="input-large" name="street_no" id="street_no" value="<?php echo @$property_info->street_no; ?>">
                </fieldset>
                <fieldset id="street_name_wrap">
                    <label class="control-label">Street Name:<span>*</span></label>
                    <input type="text" placeholder="" class="input-large" name="street_name" id="street_name" value="<?php echo @$property_info->street_name; ?>">
                </fieldset>
                <?php } ?>
				<fieldset id="country_wrap">
					<label class="control-label">Country<span>*</span></label>
					<select class="input-medium" id="country_id" name="country_id"  onchange="getLocationValues();">
						<option value="">Select ur country</option>
						<?php $i = 1;
						foreach ($countries as $alc) { ?>
						<option value="<?php echo $alc->id; ?>" <?php if(@$property_info->country_id == $alc->id) { echo 'selected';}?>><?php echo $alc->country_name; ?></option>
						<?php $i++; } ?>
					</select>
				</fieldset>
				<?php if (@$property_info->country_id == '1'){?>
				<fieldset id="certificate_wrap">
					<label class="control-label">Certificate File:<span>*</span></label>
					<input type="file" class="input-large" name="certificate" id="certificate" >
					<input type="hidden" name="old_certificate" id="old_certificate" value="<?php echo @$property_info->certificate;?>" />
				</fieldset>
				<?php } ?>
				
				<fieldset id="region_wrap">
					<label class="control-label">Region<span>*</span></label>
					<div id="ajax-region">
					<?php if(isset($property_info->region_name) && !empty($property_info->region_name) ) { ?>
					<input type="text" name="country_region" id="country_region" value="<?php echo $property_info->region_name;?>" onblur="getLocationValues();"/>
					
					<?php } elseif(isset($region)) {?>
						<select name="region_id" id="region_id" onchange="getLocationValues();">
						<option value="">Select</option>
						<?php
						foreach($region as $rn):
						?>
						<option value="<?php echo $rn->id;?>" <?php if(($rn->id == @$property_info->region_id)) { ?>selected<?php }?>><?php echo $rn->region_name?></option>
						<?php
						endforeach;
						?>
						</select>
						
						<?php } else { ?>
						<select name="region_id" id="region_id">
						<option value="">Select ur region</option>
						</select>
					<?php } ?>
					</div>
				</fieldset>
				<fieldset id="city_wrap">
					
					<label class="control-label">City<span>*</span></label>
					<div id="ajax-city">
					<?php if(isset($property_info->city_name) && !empty($property_info->city_name) ) { ?>
					<input type="text" name="region_city" id="region_city" value="<?php echo $property_info->city_name?>" onblur="getLocationValues();">
						<?php  } elseif(isset($cities)) {?>
						<select name="city_id" required="1" id="city_id" required="1" onchange="getLocationValues();">
							<option value="0">Select</option>
							<?php foreach($cities as $ct): ?>
							<option value="<?php echo $ct->id;?>" <?php if(($ct->id == @$property_info->city_id)) { ?>selected<?php }?>><?php echo $ct->city_name?></option>
							<?php endforeach; ?>
						</select>
						<?php } else { ?>
						<select name="city_id" id="city_id" >
						<option value="">Select ur city</option>
						</select>
					<?php } ?>
					</div>
					<div id="text_div" style="display:none;">
					</div>
				</fieldset>
				<?php
						$display_style = '';
					if((@$property_info->country_id != '1' && isset($property_info->country_id))){ 
						$display_style = 'display:none;';
					}
				?>
				<fieldset id="suburb_wrap" style="<?php echo $display_style; ?>">
					<label class="control-label">Suburb<span>*</span></label>
					<div id="ajax-suburb">
					<?php if(isset($property_info->city_suburb) && !empty($property_info->city_suburb) ) { ?>
					<input type="text" name="city_suburb" id="city_suburb" value="<?php echo $property_info->city_suburb?>" onblur="getLocationValues();">
						<?php  } else if(isset($suburbs)) {?>
						<select name="suburb_id" required="1" id="suburb_id" required="1">
							<option value="0">Select</option>
							<?php foreach($suburbs as $sb): ?>
							<option value="<?php echo $sb->id;?>" <?php if(($sb->id == @$property_info->suburb_id)) { ?>selected<?php }?>><?php echo $sb->suburb_name; ?></option>
							<?php endforeach; ?>
						</select>
						<?php } else { ?>
						<select name="suburb_id" id="suburb_id">
							<option value="">Select ur suburb</option>
						</select>
						<?php } ?>
					</div>
					<div id="ajax_new_suburb" style="display:none;">
					</div>
				</fieldset>
				
                <fieldset id="postcode_wrap">
                    <label class="control-label">Postcode:<span>*</span></label>
                    <input type="text" placeholder="" class="input-large" name="postcode" id="postcode" value="<?php echo @$property_info->postcode; ?>">
                </fieldset>
			<div align="right" id="save_location_div" >
						<input type="button" name="save_location_button" value="Save Information" id="save_location_button" onclick="saveInformation(2);" style="width:150px">
				</div> 
            </article>

            <h3>Facilities</h3>
            <article>
				<fieldset id="amenities_wrap">
					<label>Amenities:<span>*</span></label>
					<div id="amenities_id" class="property-category">
						<?php foreach($amenities as $amenity){?>
						<fieldset>
						<input type="checkbox" name="property_amenity[]" id="<?php echo @$amenity->id; ?>" class="amenities_class" value="<?php echo @$amenity->id;?>" <?php if(@$prop_ames){if(in_array(@$amenity->id, @$prop_ames)){ echo 'checked';}}?>><?php echo @$amenity->name; ?>
						</fieldset>
						<?php } ?>
					</div>
				</fieldset>
				 <div align="right" id="save_div" >
						<input type="button" name="save_facility_button" value="Save Information" id="save_facility_button" onclick="saveInformation(3);" style="width:150px">
					</div>  
			</article>

            <h3>Categories</h3>
            <article>
                <fieldset id="escape_category_wrap">
                    <label class="control-label">Categories:<span>*</span></label>
                    <div class="property-category">
                    <?php foreach($categories as $cat){ ?>
                        <fieldset id="category_checkbox">
                          <input type="checkbox" id="<?php echo @$cat->id."_"."cat"; ?>" name="property_category[]" class="property_category" value="<?php echo $cat->id;?>" <?php if($this->uri->segment(3)){ if(in_array(@$cat->id, @$prop_cats)){ echo 'checked';}}?>><?php echo @$cat->category_title; ?>
                        </fieldset>
                    <?php } ?>
                    </div>
                </fieldset>
				<div align="right" id="save_cateory_div" >
						<input type="button" name="save_category_button" value="Save Information" id="save_category_button" onclick="saveInformation(4);" style="width:150px">
					</div> 
            </article>
			<h3>Sky Channels</h3>
            <article>
                <fieldset id="escape_sky_channel_wrap">
                    <label class="control-label">Sky Channels:<span>*</span></label>
                    <div class="property-sky_channels">
                    <?php foreach($skyChannel as $sky){ ?>
                        <fieldset id="sky_channel_checkbox">
                          <input type="checkbox" id="<?php echo @$sky->id."_"."sky"; ?>" name="property_sky_channel[]" class="property_sky_channel" value="<?php echo $sky->id;?>" <?php if($this->uri->segment(3)){ if(in_array(@$sky->id, @$prop_sky_channel)){ echo 'checked';}}?>><?php echo @$sky->name; ?>
                        </fieldset>
                    <?php } ?>
                    </div>
                </fieldset>
				<div align="right" id="save_cateory_div" >
						<input type="button" name="save_sky_channel_button" value="Save Information" id="save_sky_channel_button" onclick="saveInformation(5);" style="width:150px">
					</div>  
            </article>
            <h3>Gallery</h3>
            <article>
				<fieldset id="gallery_wrap" class="image-gallery-error">
					<?php if (@$gallery_images) { ?>
					<iframe class="iframe" src="<?php echo base_url();?>ajax/editGalleryImg/<?php echo @$property_info->id;?>"></iframe>
					<?php } ?>
		              <input id="file_upload" name="file_upload" type="file" id="file_upload" />

		              <input type="hidden" value="<?php echo base_url()?>" id="hiddenBaseUrl"/> 
		              <input type="hidden" value="<?php echo './images/gallery/'?>" id="uploadfolder"/>
		              <a style="margin:10px 0;display:block;width:95px;" href="javascript:;" id="upload_gallery" class="btn large primary">Upload Files</a>
		              <div id="displayFiles"></div>
					<script type="text/javascript" src="<?php echo base_url()?>assets/frontend/js/uploadify/swfobject.js"></script>
					<script type="text/javascript" src="<?php echo base_url()?>assets/frontend/js/uploadify/jquery.uploadify.v2.1.4.min.js"></script>
					<script type="text/javascript" src="<?php echo base_url()?>assets/frontend/js/uploadify/vortexdev.js"></script>
				</fieldset>
				<div align="right" id="save_gallary_div" >
						<input type="button" name="save_gallary_button" value="Save Information" id="save_gallary_button" onclick="saveInformation(5);" style="width:150px">
				</div> 
            </article>

            <h3>Finalize</h3>
            <article>
				<fieldset>
					<label>Escape Name:</label>
					<span id="escape_name_"></span>
				</fieldset>
				<fieldset>
					<label>Escape Description:</label>
					<span id="escape_description_"></span>
				</fieldset>
				<fieldset>
					<label>Booking Type:</label>
					<span id="booking_type_"></span>
				</fieldset>
				<fieldset>
					<label>Type of Escape:</label>
					<span id="escape_type_"></span>
				</fieldset>
				<fieldset>
					<label>Guest Capacity:</label>
					<span id="guest_capacity_"></span>
				</fieldset>
				<fieldset>
					<label>Children allowed:</label>
					<span id="clidren_allowed_"></span>
				</fieldset>
				<fieldset>
					<label>Pets allowed:</label>
					<span id="pets_allowed_"></span>
				</fieldset>
				<fieldset>
					<label>Check in time:</label>
					<span id="check_in_time_"></span>
				</fieldset>
				<fieldset>
					<label>Check out time:</label>
					<span id="check_out_time_"></span>
				</fieldset>
				<fieldset>
					<label>Smoking:</label>
					<span id="smoking_"></span>
				</fieldset>
				<fieldset>
					<label>Request for photographer:</label>
					<span id="photographer_"></span>
				</fieldset>
				<fieldset>
					<label>Escape Video:</label>
					<span id="escape_video_"></span>
				</fieldset>
				<fieldset>
					<label>Escape age:</label>
					<span id="escape_age_"></span>
				</fieldset>
				<fieldset>
					<label>Number of dwellings:</label>
					<span id="num_dwelling_"></span>
				</fieldset>
				<fieldset>
					<label>Number of bedrooms:</label>
					<span id="num_bedroom_"></span>
				</fieldset>
				<fieldset>
					<label>Number of bathrooms:</label>
					<span id="num_bathroom_"></span>
				</fieldset>
				<fieldset>
					<label>Curtains:</label>
					<span id="num_curtain_"></span>
				</fieldset>
				<fieldset>
					<label>Appliances:</label>
					<span id="appliances_"></span>
				</fieldset>
				<fieldset>
					<label>Crockery/Cutlery:</label>
					<span id="cutlery_"></span>
				</fieldset>
				<fieldset>
					<label>Carpet:</label>
					<span id="carpet_"></span>
				</fieldset>
				<fieldset>
					<label>Furniture:</label>
					<span id="furniture_"></span>
				</fieldset>
				<fieldset>
					<label>Kitchen Utensils:</label>
					<span id="utensils_"></span>
				</fieldset>
				<fieldset>
					<label>Beds/Mattresses:</label>
					<span id="mattresses_"></span>
				</fieldset>
				<fieldset>
					<label>Price per Night:</label>
					<span id="price_night_"></span>
				</fieldset>
				<fieldset>
					<label>Price per Week:</label>
					<span id="price_week_"></span>
				</fieldset>
				<fieldset>
					<label>Price per Month:</label>
					<span id="price_month_"></span>
				</fieldset>
				<fieldset>
					<label>Booking cancellation policy:</label>
					<span id="cancellation_"></span>
				</fieldset>
				<fieldset>
					<label>Bond amount:</label>
					<span id="bond_"></span>
				</fieldset>
				<fieldset>
					<label>No street address:</label>
					<span id="street_enable_"></span>
				</fieldset>
				<fieldset>
					<label>Hide details from escape listing:</label>
					<span id="street_visible_"></span>
				</fieldset>
				<fieldset>
					<label>Street Number:</label>
					<span id="street_number_"></span>
				</fieldset>
				<fieldset>
					<label>Street Name:</label>
					<span id="street_name_"></span>
				</fieldset>
				<fieldset>
					<label>Destination Guide:</label>
					<span id="how_to_reach_"></span>
				</fieldset>
				<fieldset>
					<label>Country:</label>
					<span id="country_"></span>
				</fieldset>
				<fieldset>
					<label>Region:</label>
					<span id="region_"></span>
				</fieldset>
				<fieldset>
					<label>New Region :</label>
					<span id="country_region_"></span>
				</fieldset>
				<fieldset>
					<label>City:</label>
					<span id="city_"></span>
				</fieldset>
				<fieldset>
					<label>New City:</label>
					<span id="region_city_"></span>
				</fieldset>
				<fieldset>
					<label>Suburb:</label>
					<span id="suburb_"></span>
				</fieldset>
				<fieldset>
					<label>New Suburb:</label>
					<span id="city_suburb_"></span>
				</fieldset>
				<fieldset>
					<label>Postcode:</label>
					<span id="postcode_"></span>
				</fieldset>
				<fieldset>
					<label>Category:</label>
					<span id="category_"></span>
				</fieldset>
				<fieldset>
					<label>Sky Channels</label>
					<span id="Sky_channels_"></span>
				</fieldset>
				<fieldset style="text-align:right;">
				     <?php if (@$property_info){?>
					<input type="hidden" name="property_id" id="property_id" value="<?php echo $property_info->id;?>" />
					<input type="hidden" name="property_code" id="property_code" value="<?php echo $property_info->private_code;?>" />
					<input type="hidden" name="created_date" id="created_date" value="<?php echo $property_info->created_date;?>" />
				     <?php } ?>
					<input type="submit" class="btn btn-primary" id="mybutton" name="submit" value="Confirm & Save" />
				</fieldset>
            </article>
        </form>
    </div>
</section>


<div class="modal fade bs-modal-lg" id="myModal" role="dialog">
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

<style type="text/css">
    #map{width: 90%; height: 450px; float: left; border: none;}
    #map label { width: auto; display:inline; }
    #map img { max-height: none; max-width: none; }
</style>
<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/jquery-ui.css" />
<script src="<?php echo base_url();?>assets/frontend/js/jquery-ui.js"></script>
<?php
if(!isset($property_info))
{
?>
<script>
    $(document).ready(function() {
        $("option[value='']").attr('selected', 'selected');
    });
</script>
<?php
}
?>
<script>
 $(document).ready(function () {
    $('input.numberinput').bind('keypress', function (e) {
        return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) ? false : true;
    });
});
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/frontend/js/jquery.steps.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/frontend/js/modal.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/frontend/js/bootbox.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/wizard.css" />

<script type="text/javascript">

	function errorPlacement(error, element)
    {
        element.before(error);
    }
	
    $(document).ready(function() {
	
	
	
		$("#form-3").steps({
                headerTag: "h3",
                bodyTag: "article",
                transitionEffect: "slideLeft",
                <?php if(@$property_info){?>
                enableAllSteps: true,
                <?php } ?>
                onStepChanging: function (event, currentIndex, newIndex)
                {	
					
					$(".error").hide();
					var hasError=false;
					
				 // Always allow previous action even if the current form is not valid!
                   if (currentIndex > newIndex)
                    {
                        return true;
                    }

                    // Forbid next action on "Warning" step if the user is to young
                    if (newIndex === 3 && Number($("#age-2").val()) < 18)
                    {
                        return false;
                    }

                    // Needed in some cases if the user went back (clean up)
                    if (currentIndex < newIndex)
                    {
                        // To remove error styles
                        $("#form-3 .body:eq(" + newIndex + ") label.error").remove();
                        $("#form-3 .body:eq(" + newIndex + ") .error").removeClass("error");
                    }

                    $("#form-3").validate().settings.ignore = ":disabled,:hidden";
                    return $("#form-3").valid();
                },
                onStepChanged: function (event, currentIndex, priorIndex)
                {
                	/* if($('#escape_detail').val()=='') {
						alert("enter detail first");
					
					} */
					 if (currentIndex == 6){
                		$('#escape_name_').html($('#escape_title').val());
                		$('#escape_description_').html($('#escape_detail').val());

						var temp = '';
                		if ($('#bookingType').val() == '0')
                			temp = 'Pre confirm booking';
                		else
                			temp = 'Confirmed booking';
                		$('#booking_type_').html(temp);
                		$('#escape_type_').html($('#type_escape_id option:selected').text());
                		$('#guest_capacity_').html($('#guest_capacity').val());
                		if ($('input[name=children]:checked').val() == '1')
                			temp = 'Yes';
                		else
                			temp = 'No';
                		$('#clidren_allowed_').html(temp);
                		if ($('input[name=pet]:checked').val() == '1')
                			temp = 'Allowed inside';
                		else
                			temp = 'No Inside only Outside';
                		$('#pets_allowed_').html(temp);
                		$('#check_in_time_').html($('#check_in_date').val());
                		$('#check_out_time_').html($('#check_out_date').val());
                		if ($('input[name=smoking]:checked').val() == '1')
                			temp = 'Allowed inside';
                		else
                			temp = 'No Inside only Outside';
                		$('#smoking_').html(temp);
                		if ($('input[name=photographer]:checked').val() == '1')
                			temp = 'Required';
                		else
                			temp = 'Not required';
                		$('#photographer_').html(temp);
                		$('#escape_video_').html($('#property_video').val());
                		$('#escape_age_').html($('input[name=age]').val());
                		$('#num_dwelling_').html($('input[name=dwelling]').val());
                		$('#num_bedroom_').html($('input[name=bedrooms]').val());
                		$('#num_bathroom_').html($('input[name=bathrooms]').val());
                		$('#num_curtain_').html($('select[name=curtains]').val());
                		$('#appliances_').html($('select[name=appliances]').val());
                		$('#cutlery_').html($('select[name=cutlery]').val());
                		$('#carpet_').html($('select[name=carpet]').val());
                		$('#furniture_').html($('select[name=furniture]').val());
                		$('#utensils_').html($('select[name=utensil]').val());
                		$('#mattresses_').html($('select[name=mattress]').val());
                		$('#price_night_').html($('input[name=price_night]').val());
                		$('#price_week_').html($('input[name=price_week]').val());
                		$('#price_month_').html($('input[name=price_month]').val());
                		$('#cancellation_').html($('input:radio[name=booking_cancelation]:checked').val());
                		$('#bond_').html($('input[name=bond_amount]').val());
                		
                		if ($('#street_enable').is(":checked")) {
							$('#street_enabled').val('Yes');
							$('#is_street_enable').val(1);
                		} else {
                			$('#street_enabled').val('No');
                		    $('#is_street_enable').val(0);
						}
                		if ($('#street_visible').is(":checked")) { 
							$('#street_visibility').val('Yes');
							$('#is_street_visible').val(1);
                		 } else {
                			$('#street_visibility').val('No');
							$('#is_street_visible').val(0);
                		}
						var count = '';
						$(".property_category").each(function( key, value ) {
								
								//count=count + ',';
								if ($('#'+this.id).is(":checked"))  {
									
									count+=this.id + ',';
									$('#category_').html(count);
									
								}
								
						}); 
						
						var count_channel = '';
						$(".property_sky_channel").each(function( key, value ) {
								
								//count=count + ',';
								if ($('#'+this.id).is(":checked"))  {
									
									count_channel+=this.id + ',';
									$('#Sky_channels_').html(count_channel);
									
								}
								
						});
                		$('#street_number_').html($('input[name=street_no]').val());
                		$('#street_visible_').html($('#street_visibility').val());
                		$('#street_enable_').html($('#street_enabled').val());
                		$('#street_name_').html($('input[name=street_name]').val());
                		$('#how_to_reach').html($('input[name=how_to_reach]').val());

                		$('#country_region_').html($('input[name=country_region]').val());
                		$('#region_city_').html($('input[name=region_city]').val());
						$('#country_').html($('#country_id option:selected').text());
                		$('#region_').html($('#region_id option:selected').text());
                		$('#city_').html($('#city_id option:selected').text());
                		$('#suburb_').html($('#suburb_id option:selected').text());
                		$('#city_suburb_').html($('input[name=city_suburb]').val());
                		$('#postcode_').html($('input[name=postcode]').html());
                	}
                    // Used to skip the "Warning" step if the user is old enough.
                    if (currentIndex === 2 && Number($("#age-2").val()) >= 18)
                    {
                        $("#form-3").steps("next");
                    }

                    // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
                    if (currentIndex === 2 && priorIndex === 3)
                    {
                        $("#form-3").steps("previous");
                    }
                },
                onFinishing: function (event, currentIndex)
                {
                    $("#form-3").validate().settings.ignore = ":disabled";
                    return $("#form-3").valid();
                },
                onFinished: function (event, currentIndex)
                {
                    alert("Submitted!");
                    $('#form-3').submit();
                }
            }).validate({
                errorPlacement: errorPlacement,
                rules: {
                    confirm: {
                        equalTo: "#password-2"
                    }
                }
            });
		$('#check_in_date').datepicker({
			dateFormat: "dd/mm/yy"
		});
		$('#check_out_date').datepicker({
			dateFormat: "dd/mm/yy"
		});
		$('#standard_start_date').datepicker({
			dateFormat: "dd/mm/yy"
		});
		$('#standard_end_date').datepicker({
			dateFormat: "dd/mm/yy"
		});
		$('#winter_start_date').datepicker({
			dateFormat: "dd/mm/yy"
		});
		$('#winter_end_date').datepicker({
			dateFormat: "dd/mm/yy"
		});
		$('#holiday_start_date').datepicker({
			dateFormat: "dd/mm/yy"
		});
		$('#holiday_end_date').datepicker({
			dateFormat: "dd/mm/yy"
		});
		$('#summer_start_date').datepicker({
			dateFormat: "dd/mm/yy"
		});
		$('#summer_end_date').datepicker({
			dateFormat: "dd/mm/yy"
		});
		$('input[name=children]').on('change', function(){
			if ($(this).val() == '1'){
				var html = '<fieldset id="escape_children_wrap">';
					html += '<label class="control-label">Safety Hazards';
					html += '</label>';
					html += '<textarea name="safety_children" id="safety_children"></textarea>';
					html += '</fieldset>';
					$(this).parent().after(html);
			}else{
				$(this).parent().next().remove();
			}
		});
		$('#street_enable').change(function () { 
				$('#street_no').val('');
				$('#street_name').val('');
				$('#how_to_reach').val('');
			if ($('#street_enable').is(":checked")) {
					
					$('#street_number_wrap').hide();
					$('#street_name_wrap').hide();
					$('#reach_destination').show();
					$('#is_enable').val(1);
					
				} else { 
					$('#reach_destination').hide();
					$('#is_enable').val(0);
					var html = '<fieldset id="street_number_wrap">';
                    html += '<label class="control-label">Street Number:<span>*</span></label>';
                    html += '<input type="text" placeholder="" class="input-large" name="street_no" id="street_no">';
                    html += '</fieldset>';
                    html += '<fieldset id="street_name_wrap">';
                    html += '<label class="control-label">Street Name:<span>*</span></label>';
                    html += '<input type="text" placeholder="" class="input-large" name="street_name" id="street_name">';
                    html += '</fieldset>';
                    $(this).parent().next().after(html);
					
				}
			
		});
		$('.amenities_class').change(function () { 
			$(".error").hide();
		});
		$('.property_category').change(function () { 
			$(".error").hide();
		});
		$('.property_sky_channel').change(function () { 
			$(".error").hide();
		});
		$('#standard_rate').change(function () { 
				$("#standard_start_date").val('');
				$("#standard_end_date").val('');
				$(".error").hide();
			if ($('#standard_rate').is(":checked")) {
				$("#standard_rate_div").show();
				$("#standard_rate_div_price").show();
				
				$("#standard_changed").val(1);
				
			} else { 
				
				$("#standard_rate_div_price").hide();
				$("#standard_rate_div").hide();
				$("#standard_changed").val(0);
			}
		});
		$('#winter_rate').change(function () { 
				$("#winter_start_rate").val('');
				$("#winter_end_rate").val('');
				$(".error").hide();
			if ($('#winter_rate').is(":checked")) {
				$("#winter_rate_div").show();
				$("#winter_rate_div_price").show();
				
				$("#winter_changed").val(1);
			} else {
				$("#winter_rate_div_price").hide();
				$("#winter_rate_div").hide();
				$("#winter_changed").val(0);
			}
		});
		$('#holiday_rate').change(function () {
			    $("#holiday_start_rate").val('');
				$("#holiday_end_rate").val('');
				$(".error").hide();
			if ($('#holiday_rate').is(":checked")) {
				$("#holiday_rate_div").show();
				$("#holiday_rate_div_price").show();
				
				$("#holiday_changed").val(1);
			} else {
				$("#holiday_rate_div_price").hide();
				$("#holiday_rate_div").hide();
				$("#holiday_changed").val(0);
			}
		});
		$('#summer_rate').change(function () { 
				$("#summer_start_rate").val('');
				$("#summer_end_rate").val('');
				$(".error").hide();
			if ($('#summer_rate').is(":checked")) {
				$("#summer_rate_div").show();
				$("#summer_rate_div_price").show();
				
				$("#summer_changed").val(1);
			} else {
				$("#summer_rate_div_price").hide();
				$("#summer_rate_div").hide();
				$("#summer_changed").val(0);
			}
		});
		
	  $('#cutlery').on('change', function() {
					$(".error").hide();
		});
	  $('#curtains').on('change', function() {
		$(".error").hide();
	  });
	  $('#appliances').on('change', function() {
		$(".error").hide();
	  });
	  $('#carpet').on('change', function() {
		$(".error").hide();
	  });
	  $('#utensil').on('change', function() {
		$(".error").hide();
	  });
	  $('#furniture').on('change', function() {
		$(".error").hide();
	  });
	   $('#mattress').on('change', function() {
		$(".error").hide();
	  });
      $('#bookingType').on('change', function() {
			$(".error").hide();
	  });
	  $('#s').on('change', function() {
		$(".error").hide();
	  });
		
        $('#country_id').on('change', function()
        {
			$(".error").hide();
			var parent_hide=0;
			$('#country_region').val(''); 
			$('#region_city').val(''); 
			$('#city_suburb').val(''); 
            if ($(this).val() != '1') {
				$('#ajax-suburb').parent().hide();
				parent_hide=1;
			} else {
				$('#ajax-suburb').parent().show();
				parent_hide=0;
            }
			$('#ajax-region').html('Loading...');
            if ($(this).val() > 0)
            {

                $.ajax({
                    url: "<?php echo base_url(); ?>ajax/getRegionAjax/" + $(this).val(),
                    success: function(data) {
                       $('#ajax-region').show();
                       $('#ajax-region').html(data);
						 if($("#is_region").val()==1) { 
							$('#ajax-city').hide();
							$('#text_div').show();
							$('#text_div').html('<input type="text" name="region_city" id="region_city" onblur="getLocationValues();" value="">');
							if(parent_hide==0) {
								$('#ajax-suburb').hide();
								$('#ajax_new_suburb').show();
								$('#ajax_new_suburb').html('<input type="text" name="city_suburb" id="city_suburb" value="" onblur="getLocationValues();">');
						    }  
							$('#is_suburb').val(1);
						  //$('#ajax_new_suburb').show();
							
						} else {
							
							$('#text_div').hide();
							$('#ajax-city').show();
							if(parent_hide==0) {
								$('#ajax_new_suburb').hide();
								$('#ajax-suburb').show();
								
							}
						} 
						
                    }
                });
            }
            else
            {
                $('#ajax-region').html('Loading...');
                $('#ajax-region').hide();
            }
            if ($(this).val() == '1'){
            	var html = '<fieldset id="certificate_wrap">';
                    html += '<label class="control-label">Certificate File:<span>*</span></label>';
                    html += '<input type="file" class="input-large" name="certificate" id="certificate" >';
                    html += '</fieldset>';
            	$('#country_wrap').after(html);
            }else{
            	$('#certificate_wrap').remove();
            }
        });
        $('#region_id').on('change', function()
        {
			$(".error").hide();
			var is_city=0;
			$('#ajax-city').html('Loading...');
            if ($(this).val() > 0)
            {
                $.ajax({
                    url: "<?php echo base_url(); ?>ajax/getCityAjax/" + $(this).val(),
                    success: function(data) {
						if(is_city==1) {
							$('#ajax-city').hide();
							$('#text_div').show();
							$('#text_div').html('<input type="text" name="region_city" id="region_city" onblur="getLocationValues();" value="">');
							$('#ajax-suburb').hide();
							$('#ajax_new_suburb').show();
							$('#ajax_new_suburb').html('<input type="text" name="city_suburb" id="city_suburb"> onblur="getLocationValues();"');
						} else {
							$('#text_div').hide();
							$('#ajax-city').show();
							$('#ajax-city').html(data);
							$('#ajax_new_suburb').hide();
							$('#ajax-suburb').show();
							
						}
					}
                });
            }
            else
            {
                $('#ajax-city').html('Loading...');
                $('#ajax-city').hide();
            }
        });
        $('#ajax-city').on('change','#city_id', function()
        {
           $(".error").hide();
		   $('#ajax-suburb').html('Loading...');
            if ($(this).val() > 0)
            {
                $.ajax({
                    url: "<?php echo base_url(); ?>ajax/getSuburbAjax/" + $(this).val(),
                    success: function(data) {
                        $('#ajax-suburb').show();
                        $('#ajax-suburb').html(data);
                    }
                });
            }
            else
            {
                $('#ajax-suburb').html('Loading...');
                $('#ajax-suburb').hide();
            }
        });
		$('#cancelation_reasonable').click(function(){
			$('#myModal img.modal_content').attr('src', '<?php echo base_url();?>assets/frontend/images/Cancellation_Reasonable.jpg');
			$('#myModal').modal();
		});
		$('#cancelation_relaxed').click(function(){
			$('#myModal img.modal_content').attr('src', '<?php echo base_url();?>assets/frontend/images/Cancellation_Relaxed.jpg');
			$('#myModal').modal();
		});
		$('#cancelation_strict').click(function(){
			$('#myModal img.modal_content').attr('src', '<?php echo base_url();?>assets/frontend/images/Cancellation_Strict.jpg');
			$('#myModal').modal();
		});
		$('#close_modal').click(function(){
			$('.modal-header .close').click();
		});
    });
</script>

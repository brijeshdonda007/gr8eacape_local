<h4>More Details</h4>
<ul class="propertyDetail">
		<li><dd>Type of Escape: </dd><?php echo @$type_escape->title;?></li>
		<li><dd>Bedroom: </dd><?php echo $property_detail->bedroom;?></li>
		<li><dd>Bathroom: </dd><?php echo $property_detail->bathroom;?></li>
		<li><dd>Adult: </dd><?php echo $property_detail->adult;?></li>
		<li><dd>Children: </dd><?php echo ($property_detail->children == 0)?'No':'Yes';?></li>
		<li><dd>Pets: </dd><?php echo ($property_detail->pet == 1)?'Yes':'No';?></li>
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
		<li><dd>Bed Lines: </dd>
	        <?php if( property_exists( get_class($property_detail), 'bed_lines' ) ) {echo ($property_detail->bed_lines == 1)? "Not Included, please bring your own" : "All provided for you, we will wash up after you have checked out" ;} ?>
		</li>
	    <?php
		$start_date ='';
		$end_date ='';
		$standard_start_date ='';
		$standard_end_date ='';
		$winter_start_date ='';
		$winter_end_date ='';
		$winter_price_night ='';
		$winter_price_week ='';
		$winter_price_month ='';
		$holiday_start_date ='';
		$holiday_end_date ='';
		$holiday_price_night ='';
		$holiday_price_week ='';
		$holiday_price_month ='';
		$summer_start_date ='';
		$summer_end_date ='';
		$summer_price_night ='';
		$summer_price_week ='';
		$winter_price_month ='';
	?>
	<?php 	if($property_detail->standard_rate == 1) {  // if Standard Rate checkbox is selected
				$start_date = explode('-', $property_detail->standard_start_date);
				$standard_start_date = $start_date[2]."/".$start_date[1]."/".$start_date[0];
				$end_date = explode('-', $property_detail->standard_end_date);
				$standard_end_date = $end_date[2]."/".$end_date[1]."/".$end_date[0];
			} else {
				$standard_start_date = "N/A";
				$standard_end_date = "N/A";
			} 
			if($property_detail->winter_rate == 1) {  // if Winter Rate checkbox is selected
				$start_date = explode('-', $property_detail->winter_start_date);
				$winter_start_date = $start_date[2]."/".$start_date[1]."/".$start_date[0];
				$end_date = explode('-', $property_detail->winter_end_date);
				$winter_end_date = $end_date[2]."/".$end_date[1]."/".$end_date[0];
				$winter_price_night = "$".$property_detail->winter_price_night;
				$winter_price_week = "$".$property_detail->winter_price_week;
				$winter_price_month = "$".$property_detail->winter_price_month;
			} else {
				$winter_start_date = "N/A";
				$winter_end_date = "N/A";
				$winter_price_night = "N/A";
				$winter_price_week = "N/A";
				$winter_price_month = "N/A";
			} 
	?>
		<li><h4 style="color:#2184be;margin-top:20px;">Standard Season</h4></li>
		<li><dd>Standard Season Start Date : </dd><?php echo $standard_start_date;?></li>
		<li><dd>Standard Season End Date: </dd><?php echo $standard_end_date;?></li>
		
		<li><h4 style="color:#2184be;margin-top:20px;">Winter Season</h4></li>
		<li><dd>Winter Season Start Date : </dd><?php echo $winter_start_date;?></li>
		<li><dd>Winter Season End Date: </dd><?php echo $winter_end_date;?></li>
		<li><dd>Winter Night Price: </dd><?php echo $winter_price_night;?></li>
		<li><dd>Winter Weekly Price: </dd><?php echo $winter_price_week;?></li>
		<li><dd>Winter Monthly Price: </dd><?php echo $winter_price_month;?></li>
	
	<?php 	if($property_detail->holiday_rate == 1) {  // if Holiday Rate checkbox is selected
				$start_date = explode('-', $property_detail->holiday_start_date);
				$holiday_start_date = $start_date[2]."/".$start_date[1]."/".$start_date[0];
				$end_date = explode('-', $property_detail->holiday_end_date);
				$holiday_end_date = $end_date[2]."/".$end_date[1]."/".$end_date[0];
				$holiday_price_night = "$".$property_detail->holiday_price_night;
				$holiday_price_week = "$".$property_detail->holiday_price_week;
				$holiday_price_month = "$".$property_detail->holiday_price_month;
			
			} else {
				$holiday_start_date = "N/A";
				$holiday_end_date = "N/A";
				$holiday_price_night = "N/A";
				$holiday_price_week = "N/A";
				$holiday_price_month = "N/A";
		 
			} 
	?>
		<li><h4 style="color:#2184be;margin-top:20px;">Holiday Season</h4></li>
		<li><dd>Holiday Season Start Date : </dd><?php echo $holiday_start_date;?></li>
		<li><dd>Holiday Season End Date: </dd><?php echo $holiday_end_date;?></li>
		<li><dd>Holiday Night Price: </dd><?php echo $holiday_price_night;?></li>
		<li><dd>Holiday Weekly Price: </dd><?php echo $holiday_price_week;?></li>
		<li><dd>Holiday Monthly Price: </dd><?php echo $holiday_price_month;?></li>
	
	<?php 	if($property_detail->summer_rate == 1) {  // if Summer Rate checkbox is selected
				$start_date = explode('-', $property_detail->summer_start_date);
				$summer_start_date = $start_date[2]."/".$start_date[1]."/".$start_date[0];
				$end_date = explode('-', $property_detail->summer_end_date);
				$summer_end_date = $end_date[2]."/".$end_date[1]."/".$end_date[0];
				$summer_price_night = "$".$property_detail->summer_price_night;
				$summer_price_week = "$".$property_detail->summer_price_week;
				$summer_price_month = "$".$property_detail->summer_price_month;
			} else {
				$summer_start_date = "N/A";
				$summer_end_date = "N/A";
				$summer_price_night = "N/A";
				$summer_price_week = "N/A";
				$summer_price_month = "N/A";
			} 
	?>
		<li><h4 style="color:#2184be;margin-top:20px;">Summer Season</h4></li>
		<li><dd>Summer Season Start Date : </dd><?php echo $summer_start_date;?></li>
		<li><dd>Summer Season End Date: </dd><?php echo $summer_end_date;?></li>
		<li><dd>Summer Night Price: </dd><?php echo $summer_price_night;?></li>
		<li><dd>Summer Weekly Price: </dd><?php echo $summer_price_week;?></li>
		<li><dd>Summer Monthly Price: </dd><?php echo $summer_price_month;?></li>
		
	<?php 	if($property_detail->street_enable==1) {  // if no street checkbox is selected ?>
		<li><h4 style="color:#2184be;margin-top:20px;"> Address </h4></li>
		<li><dd>Instructions How to Reach the Destination: </dd> </li>
		<li><?php echo $property_detail->how_to_reach;?></li>
	<?php	} else if($property_detail->street_visible!=1) {  // if Hide details from escape listing checkbox is selected  ?>
		<li><h4 style="color:#2184be;margin-top:20px;"> Address </h4></li>
		<li><dd>Street Number: </dd> <?php echo $property_detail->street_no;?></li>
		<li><dd>Street Name: </dd> <?php echo $property_detail->street_name;?></li>
	<?php 	} ?>	
				
</ul>
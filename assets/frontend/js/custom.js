/* 
*	function to validate fields
*/
function checkValue(current_index) {

		var hasError=false;
		var no_checked=0;
		$(".error").hide();
		 
			   if(current_index==0){
						//// step 1 of add/edit escape	
						if($('#escape_title').val()=='') {
							$('#escape_title').after('<span class="error">Enter escape title </span>')
							hasError=true;
						}  
						
						if($('#escape_detail').val()=='') {
							$('#escape_detail').after('<span class="error">Enter escape description </span>')
							hasError=true;
						} 
						
						if($('#bookingType').val()=='') {
							$('#bookingType').after('<span class="error">Select booking type </span>')
							hasError=true;
						}
						
						if($('#s').val()=='') {
							$('#s').after('<span class="error">Select Type of Escape </span>')
							hasError=true;
						}
						
						if($('#guest_capacity').val()=='') {
							$('#guest_capacity').after('<span class="error">Select Guest Capacity </span>')
							hasError=true;
						}
												
						
						if($('#check_in_date').val()=='') {
							$('#check_in_date').after('<span class="error">Enter Check in time </span>')
							hasError=true;
						} 
						
						if($('#check_out_date').val()=='') {
							$('#check_out_date').after('<span class="error">Enter Check out time </span>')
							hasError=true;
						}
						
						if($('#age').val()=='') {
							$('#age').after('<span class="error">Enter age </span>')
							hasError=true;
						} else {
							var value = $('#age').val().replace(/^\s\s*/, '').replace(/\s\s*$/, '');
								var intRegex = /^\d+$/;
								if(!intRegex.test(value)) {
									$('#age').after('<span class="error"> Age must be Numeric </span>')
									hasError=true;
								}
						} 
						
						if($('#dwelling').val()=='') {
							$('#dwelling').after('<span class="error">Enter No. of dwelling </span>')
							hasError=true;
						} else {
							var value = $('#dwelling').val().replace(/^\s\s*/, '').replace(/\s\s*$/, '');
								var intRegex = /^\d+$/;
								if(!intRegex.test(value)) {
									$('#dwelling').after('<span class="error"> No of dwellings must be Numeric </span>')
									hasError=true;
								}
						
						} 
						
						if($('#bedrooms').val()=='') {
							$('#bedrooms').after('<span class="error">Enter No. of bedrooms </span>')
							hasError=true;
						} else {
							var value = $('#bedrooms').val().replace(/^\s\s*/, '').replace(/\s\s*$/, '');
								var intRegex = /^\d+$/;
								if(!intRegex.test(value)) {
									$('#bedrooms').after('<span class="error"> No of bedrooms must be Numeric </span>')
									hasError=true;
								}
						} 
						
						if($('#bathrooms').val()=='') {
							$('#bathrooms').after('<span class="error">Enter No. of bathrooms </span>')
							hasError=true;
						} else {
							var value = $('#bathrooms').val().replace(/^\s\s*/, '').replace(/\s\s*$/, '');
								var intRegex = /^\d+$/;
								if(!intRegex.test(value)) {
									$('#bathrooms').after('<span class="error"> No of bathrooms must be Numeric </span>')
									hasError=true;
								}
						} 
						
						if($('#curtains').val()=='') {
							$('#curtains').after('<span class="error">Enter No. of curtains </span>')
							hasError=true;
						}	
						
						if($('#appliances').val()=='') {
							$('#appliances').after('<span class="error">Enter No. of Appliances </span>')
							hasError=true;
						}
						
						if($('#cutlery').val()=='') {
							$('#cutlery').after('<span class="error">Enter No. of Crockery/Cutlery </span>')
							hasError=true;
						}
						
						if($('#carpet').val()=='') {
							$('#carpet').after('<span class="error">Enter No. of Carpet </span>')
							hasError=true;
						}
						
						if($('#furniture').val()=='') {
							$('#furniture').after('<span class="error">Enter No. of Furniture </span>')
							hasError=true;
						} 
						
						if($('#utensil').val()=='') {
							$('#utensil').after('<span class="error">Enter No. of Kitchen Utensil </span>')
							hasError=true;
						}
						
						if($('#mattress').val()=='') {
							$('#mattress').after('<span class="error">Enter No. of Beds/Mattresses </span>')
							hasError=true;
						}
						if($('#cleaning_wrap input[type="radio"]:checked').length==0) {
										$('#cleaning_wrap').after('<span class="error"> Select Cleaning Option </span>');
										hasError=true;	
						}
						if($('#cleaning_charge_wrap input[type="radio"]:checked').length==0) {
										$('#cleaning_charge_wrap').after('<span class="error"> Select Cleaning Option </span>');
										hasError=true;	
						}
						if($('#cleaning_help_details input[type="radio"]:checked').length==0) {
										$('#cleaning_help_details').after('<span class="error"> Select Separate Help Option </span>');
										hasError=true;	
						}
                                                // escape phone radio chek
                                                if($('#escape_phone_wrap input[type="radio"]:checked').length==0) {
										$('#escape_phone_wrap').after('<span class="error"> Select escape phone option </span>');
										hasError=true;	
						}
                                                //ends
						if($(".cleaning_charge[type='radio']:checked").val()==1) {		
							if($("#charge_amount_value").val()=='') {
									$('#charge_amount_value').after('<span class="error"> Enter Cleaning Charges </span>');
										hasError=true;
							}else {
								var value = $('#charge_amount_value').val().replace(/^\s\s*/, '').replace(/\s\s*$/, '');
								var intRegex = /^\d+$/;
								if(!intRegex.test(value)) {
									$('#charge_amount_value').after('<span class="error"> Amount must be a number </span>')
									hasError=true;
								}
							}
							
						}else{
                                                    hasError = false;
                                                }
                                                // escape phone validation
                                                if($("input[name=escape_phone_radio]:checked").val()==1) {		
							if($("#escape_phone_value").val()=='') {
									$('#escape_phone_value').after('<span class="error"> Enter Escape Phone </span>');
										hasError=true;
							}else {
								var value = $('#escape_phone_value').val();
								var Regex = /[0-9-()+]{3,20}/;
								if(!Regex.test(value)) {
									$('#escape_phone_value').after('<span class="error"> Enter a Valid Phone Number </span>')
									hasError=true;
								}
							}
							
						}else {
                                                    hasError = false;
                                                }
                                                // escape phone validation ends
						
						if($(".cleaning_help[type='radio']:checked").val()==1) {		
							if($("#first_name").val()=='') {
									$('#first_name').after('<span class="error"> Enter Fisrt Name </span>');
										hasError=true;
							}
							if($("#last_name").val()=='') {
									$('#last_name').after('<span class="error"> Enter Last Name </span>');
										hasError=true;
							}
							if($("#phone").val()=='') {
									$('#phone').after('<span class="error"> Enter Phone Number</span>');
										hasError=true;
							} else {
								var value = $('#phone').val().replace(/^\s\s*/, '').replace(/\s\s*$/, '');
								var intRegex = /^\d+$/;
								if(!intRegex.test(value)) {
									$('#phone').after('<span class="error"> Phone Number must be a number </span>')
									hasError=true;
								}
							}
							
						}		
						if($('#bed_lines_wrap input[type="radio"]:checked').length==0) {
										$('#bed_lines_wrap').after('<span class="error"> Select Bed Lines </span>');
										hasError=true;	
						}
						if(hasError==true) {
							return false;
							//return true;
						} else {
							return true;
						}
				  
				//  Step 2 of add/edit escape	
				
				 } else if(current_index==1){	
                                                        // min nights
                                                        if($('#min_nights').val()=='') {
							$('#min_nights').after('<span class="error"> Enter Minimum Nights </span>')
							hasError=true;
                                                        }
                                                        // min nights ends
				 			no_checked=  $('#season_rate_wrap input[type="checkbox"]:checked').length;
							if(no_checked==0 && !$("#standard_rate_group_1").is(":checked") && !$("#standard_rate_group_2").is(":checked") && !$("#standard_rate_group_3").is(":checked")) {
								$('#season_rate_wrap').after('<span class="error">Please select a rate</span>');							
								hasError=true;
							}
							if($('#price_night').val()=='' && $("#standard_rate_group_1").is(":checked")) {								
								$('#price_night').after('<span class="error">Enter price per night </span>')
								hasError=true;
							} else if($('#price_night').val()!='' && $("#standard_rate_group_1").is(":checked")) {
								var value = $('#price_night').val().replace(/^\s\s*/, '').replace(/\s\s*$/, '');
									var numberRegex = /^\-?([0-9]+(\.[0-9]+)?|Infinity)$/;
									if(!numberRegex.test(value)) {
										$('#price_night').after('<span class="error"> Price per night must be Number </span>')
										hasError=true;
									}
							} 
							
							if($('#price_week').val()=='' && $("#standard_rate_group_2").is(":checked")) {
								$('#price_week').after('<span class="error">Enter price per week </span>')
								hasError=true;
							} else if($('#price_week').val()!='' && $("#standard_rate_group_2").is(":checked")) {
								var value = $('#price_week').val().replace(/^\s\s*/, '').replace(/\s\s*$/, '');
									var numberRegex = /^\-?([0-9]+(\.[0-9]+)?|Infinity)$/;
									if(!numberRegex.test(value)) {
										$('#price_week').after('<span class="error"> Price per week must be Number </span>')
										hasError=true;
									}
							} 
							
							if($('#price_month').val()=='' && $("#standard_rate_group_3").is(":checked")) {
								$('#price_month').after('<span class="error">Enter price per month </span>')
								hasError=true;
							} else if($('#price_month').val()!='' && $("#standard_rate_group_3").is(":checked")){
								var value = $('#price_month').val().replace(/^\s\s*/, '').replace(/\s\s*$/, '');
									var numberRegex = /^\-?([0-9]+(\.[0-9]+)?|Infinity)$/;
									if(!numberRegex.test(value)) {
										$('#price_month').after('<span class="error"> Price per month must be Number </span>')
										hasError=true;
									}
							} 
														
							if($("#standard_changed").val()==1) {
								if($("#standard_start_date").val()=='') {
									$('#standard_start_date').after('<span class="error">Select Start Date </span>')
											hasError=true;
								} 
								if($("#standard_end_date").val()=='') {
									$('#standard_end_date').after('<span class="error">Select end Date </span>')
											hasError=true;
								}
							}
							if($("#winter_changed").val()==1) { 
								if($("#winter_start_date").val()=='') {
									$('#winter_start_date').after('<span class="error">Select  Start Date </span>')
											hasError=true;
								}  
								if($("#winter_end_date").val()=='') {
									$('#winter_end_date').after('<span class="error">Select  end Date </span>')
											hasError=true;
								}
								if($("#winter_price_night").val()=='') {
									$('#winter_price_night').after('<span class="error">Enter Night Price </span>')
											hasError=true;
								} else {
									var value = $('#winter_price_night').val();
									var numberRegex = /^\-?([0-9]+(\.[0-9]+)?|Infinity)$/;
									if(!numberRegex.test(value)) {
										$('#winter_price_night').after('<span class="error"> Price per month must be Number </span>')
										hasError=true;
									}
						    	}  
								
								if($("#winter_price_week").val()=='') {
									$('#winter_price_week').after('<span class="error">Enter Week Price </span>')
											hasError=true;
								} else {
									var value = $('#winter_price_week').val();
									var numberRegex = /^\-?([0-9]+(\.[0-9]+)?|Infinity)$/;
									if(!numberRegex.test(value)) {
										$('#winter_price_week').after('<span class="error"> Price per month must be Number </span>')
										hasError=true;
									}
						    	}  
								
								if($("#winter_price_month").val()=='') {
									$('#winter_price_month').after('<span class="error">Enter Month Price </span>')
											hasError=true;
								} else {
									var value = $('#winter_price_month').val();
									var numberRegex = /^\-?([0-9]+(\.[0-9]+)?|Infinity)$/;
									if(!numberRegex.test(value)) {
										$('#winter_price_month').after('<span class="error"> Price per month must be Number </span>')
										hasError=true;
									}
						    	}  
								
							}
							if($("#holiday_changed").val()==1) {
								if($("#holiday_start_date").val()=='') {
									$('#holiday_start_date').after('<span class="error">Select Start Date </span>')
											hasError=true;
								} 
								if($("#holiday_end_date").val()=='') {
									$('#holiday_end_date').after('<span class="error">Select end Date </span>')
											hasError=true;
								}
								if($("#holiday_price_night").val()=='') {
									$('#holiday_price_night').after('<span class="error">Enter Night Price </span>')
											hasError=true;
								} else {
									var value = $('#holiday_price_night').val();
									var numberRegex = /^\-?([0-9]+(\.[0-9]+)?|Infinity)$/;
									if(!numberRegex.test(value)) {
										$('#holiday_price_night').after('<span class="error"> Price per month must be Number </span>')
										hasError=true;
									}
						    	}  
								
								if($("#holiday_price_week").val()=='') {
									$('#holiday_price_week').after('<span class="error">Enter Week Price </span>')
											hasError=true;
								} else {
									var value = $('#holiday_price_week').val();
									var numberRegex = /^\-?([0-9]+(\.[0-9]+)?|Infinity)$/;
									if(!numberRegex.test(value)) {
										$('#holiday_price_week').after('<span class="error"> Price per month must be Number </span>')
										hasError=true;
									}
						    	}  
								
								if($("#holiday_price_month").val()=='') {
									$('#holiday_price_month').after('<span class="error">Enter Month Price </span>')
											hasError=true;
								} else {
									var value = $('#holiday_price_month').val();
									var numberRegex = /^\-?([0-9]+(\.[0-9]+)?|Infinity)$/;
									if(!numberRegex.test(value)) {
										$('#holiday_price_month').after('<span class="error"> Price per month must be Number </span>')
										hasError=true;
									}
						    	}  
								
							}
							if($("#summer_changed").val()==1) {
								if($("#summer_start_date").val()=='') {
									$('#summer_start_date').after('<span class="error">Select Start Date </span>')
											hasError=true;
								} 
								if($("#summer_end_date").val()=='') {
									$('#summer_end_date').after('<span class="error">Select end Date </span>')
											hasError=true;
								}
								if($("#summer_price_night").val()=='') {
									$('#summer_price_night').after('<span class="error">Enter Night Price </span>')
											hasError=true;
								} else {
									var value = $('#summer_price_night').val().replace(/^\s\s*/, '').replace(/\s\s*$/, '');
									var numberRegex = /^\-?([0-9]+(\.[0-9]+)?|Infinity)$/;
									if(!numberRegex.test(value)) {
										$('#summer_price_night').after('<span class="error"> Price per month must be Number </span>')
										hasError=true;
									}
						    	}  
								
								if($("#summer_price_week").val()=='') {
									$('#summer_price_week').after('<span class="error">Enter Week Price </span>')
											hasError=true;
								} else {
									var value = $('#summer_price_week').val();
									var numberRegex = /^\-?([0-9]+(\.[0-9]+)?|Infinity)$/;
									if(!numberRegex.test(value)) {
										$('#summer_price_week').after('<span class="error"> Price per month must be Number </span>')
										hasError=true;
									}
						    	}  
								
								if($("#summer_price_month").val()=='') {
									$('#summer_price_month').after('<span class="error">Enter Month Price </span>')
											hasError=true;
								} else {
									var value = $('#summer_price_month').val();
									var numberRegex = /^\-?([0-9]+(\.[0-9]+)?|Infinity)$/;
									if(!numberRegex.test(value)) {
										$('#summer_price_month').after('<span class="error"> Price per month must be Number </span>')
										hasError=true;
									}
						    	}  
								
							}
							if($('fieldset#booking_cancellation_wrap input[type="radio"]').length >=1) {
									if($('#booking_cancellation_wrap input[type="radio"]:checked').length==0) {
										$('#cancelation_strict').after('<span class="error" style="margin-left:10px;">  Select a cancellation policy</span>');
										hasError=true;	
									}
							}
							
							 if(hasError==true) {
								return false;
								//return true;
							} else {
								return true;
							} 
							//return true;
							
				// step 3 of add/edit escape	
				 } else if(current_index==2){ 
						if($('#is_enable').val() == 0) { // no street adress unchecked //////
							
								if($("#street_no").val() == '') {
									$('#street_no').after('<span class="error">Enter Street Number </span>');
									hasError=true;
								} 
								if($("#street_name").val ()== '') { 
									$('#street_name').after('<span class="error">Enter Street Name </span>');
									hasError=true;
								}					
						} else {
								if($("#how_to_reach").val ()== '') { 
									$('#how_to_reach').after('<span class="error">Enter how to reach </span>');
									hasError=true;
								}
						}
						if($('#country_id').val() == '') {
								$('#country_id').after('<span class="error">Select Your Country </span>');
								hasError=true;
						}
						
						if($("#is_region").val()== 1) {
								if($("#country_region").val ()== '') { 
									$('#country_region').after('<span class="error">Enter Your Region</span>');
									hasError=true;
								}
								if($("#region_city").val ()== '') { 
									$('#region_city').after('<span class="error">Enter Your City </span>');
									hasError=true;
								}
							
								if($('#country_id').val() == 1 || $('#country_id').val() == '') {
									if ($("#city_suburb").val ()== '') { 
										$('#city_suburb').after('<span class="error">Enter Your Suburb </span>');
										hasError=true;
									} 
									if($('#is_suburb').val() == 1) {
										if($("#city_suburb").val ()== '') { 
											$('#city_suburb').after('<span class="error">Enter Your Suburb </span>');
											hasError=true;
										}
									}
								}
							
						} else {
								if($('#region_id').val() == '') {
									$('#region_id').after('<span class="error">Select Your Region </span>');
									hasError=true;
								}
								if($('#is_city').val()==1) {
									if($('#region_city').val() == '') {
										$('#region_city').after('<span class="error">Enter Your City </span>');
										hasError=true;
									} 
								} else {
									if($('#city_id').val() == '') {
										$('#city_id').after('<span class="error">Select Your City </span>');
										hasError=true;
									}
								
								if($('#country_id').val() == 1 || $('#country_id').val() == '') {
									if ($("#certificate").val ()== '') { 
										$('#certificate').after('<span class="error">Select Certificate </span>');
										hasError=true;
									} 
									
									if($('#is_suburb').val() == 1) {
											//////// no suburb in selected city
										if($("#city_suburb").val ()== '') { 
											$('#city_suburb').after('<span class="error">Enter Suburb </span>');
											hasError=true;
										}
									}  else {
											if ($("#suburb_id").val ()== '') { 
												$('#suburb_id').after('<span class="error">Select Suburb </span>');
												hasError=true;
											} 
										
										}
									}
								}
						}
						if($("#postcode").val()=='') {
								$('#postcode').after('<span class="error"> Enter Postcode </span>')
								hasError=true;
						}
						
						if(hasError==true) {
								return false;
								//return true;
						} else {
							return true;
						}
				
				
			   } else if(current_index==3){
				// step 3 of add escape
							if($('#amenities_id input[type="checkbox"]').length >=1) {
									if($('#amenities_id input[type="checkbox"]:checked').length==0) {
										$('#amenities_id').after('<span class="error"> Select atleast one amenities </span>');
										hasError=true;	
									}
							}
							if(hasError==true) {
										return false;
										//return true;
										
							} else {
										return true;
							}
					
				
				} else if(current_index==4){
				
							if($('fieldset#escape_category_wrap input[type="checkbox"]').length >=0) {
								if($('fieldset#escape_category_wrap input[type="checkbox"]:checked').length ==0) {
										$('#escape_category_wrap').after('<span class="error"> Select atleast one category </span>');
										hasError=true;	
									}
							} 
							if(hasError==true) {
										return false;
										//return true;
							} else {
										return true;
							}
							
				} else if(current_index == 5){
							return true; // delete this line to activate validation on step 6
							if($('fieldset#escape_sky_channel_wrap input[type="checkbox"]').length >=0) {
								if($('fieldset#escape_sky_channel_wrap input[type="checkbox"]:checked').length ==0) {
										$('#escape_sky_channel_wrap').after('<span class="error"> Select atleast one Sky Channel </span>');
										hasError=true;	
									}
							} 
							if(hasError==true) {
										return false; 
										//return true; 
							} else {
										return true;
							}
				} else {
					return true;
				
				}
}

 resultArr = [];


/*
*  function to save Information
*
*/
function saveInformation(current_index) { 
	var not_empty=true;
	var escape_title='';
	var property_status=0;
	var step1_save=0;
	var step2_save=0;
	var step3_save=0;
	var step4_save=0;
	var step5_save=0;
	var step6_save=0;
	var step7_save=0;
	var admin_action='';
	var pet_allowed='';
	var smoking='';
	var standard_changed=0;
	var winter_changed=0;
	var holiday_changed=0;
	var summer_changed=0;
	var is_street_enable = 0;
	var is_visible = 0;
	var photographer='';
	var country_region = '';
	var region_city='';
	var city_suburb ='';
	var region_active = 0;
	var certificate_upload = '';
	var amenitiesArr= [];
	var amenitiesDeleteArr= [];
	var categoryArr= [];
    var channels    = [];
    var delete_channels = [];
	var categoryDeleteArr= [];
	var skyChannelArr= [];
	var skyChannelDeleteArr= [];
	var country_id = 0;
	var region_id = 0;
	var city_id = 0;
	var suburb_id = 0;
	var count_amenities = 0;
	var count_delete_amenities = 0;
	var count_categories = 0;
    var count_channels = 0;
    var count_delete_channels = 0;
	var count_delete_categories = 0;
	var count_sky_channels = 0;
	var count_delete_sky_channels = 0;
	var cleaning = 0;
	var cleaning_fee = 0;
	var cleaning_amount = 0;
	var arrange_cleaning = 0;
	var first_name ='';
	var last_name ='';
	var email ='';
	var phone ='';
	var home_phone ='';
	var bed_lines = 0;
        var escape_phone = '';
	not_empty=checkValue(current_index);
	//// if all the required fields filled
	if(not_empty==true) {
		var status=9;
		save_property_id = $('#save_property_id').val();
		if(typeof save_property_id === "undefined") {
			save_property_id = 0;
		}
		
		property_id = $('#property_id').val();
		if(typeof property_id === "undefined") {
			property_id = 0;
		}
		property_code = $('#property_code').val();
		if(typeof property_code === "undefined") {
			property_code = 0;
		}
		created_date = $('#created_date').val();
		step1_save = $('#step1_save').val();
		step2_save = $('#step2_save').val();
		step3_save = $('#step3_save').val();
		step4_save = $('#step4_save').val();
		step5_save = $('#step5_save').val();
		step6_save = $('#step6_save').val();
		step7_save = $('#step7_save').val();
		
		if(property_id) {
			save_escape_property_id=property_id;
		} else {
			save_escape_property_id=save_property_id;
		}
		
		if($('#property_status').val()!='') {
			property_status =$('#property_status').val();
		} else {
			property_status=0;
		}
		
		if($('#admin_action').val()!='') {
			admin_action =$('#admin_action').val();
		} else {
			admin_action='pending';
		}
		///// selected Facilities
		$(".amenities_class").each(function( key, value ) {
		
			if ($('#'+this.id ).is(":checked"))  {
									
				amenitiesArr[count_amenities]= this.value ;
				count_amenities = count_amenities + 1;	
			} else {
				amenitiesDeleteArr[count_delete_amenities]= this.value ;
				count_delete_amenities = count_delete_amenities + 1;	
			}
							
		});
		///// selected Categories
		$(".property_category").each(function( key, value ) {
		
			if ($('#'+ this.id).is(":checked"))  {
							
				 categoryArr[count_categories]= this.value ;
				 count_categories = count_categories + 1;	 
			} else {
				categoryDeleteArr[count_delete_categories]= this.value ;
				 count_delete_categories = count_delete_categories + 1;
			}	
		}); 	
		//// selected Sky Channels
		$(".property_sky_channel").each(function( key, value ) {
		
			if ($('#'+this.id).is(":checked"))  {
									
				skyChannelArr[count_sky_channels]= this.value ;
				count_sky_channels = count_sky_channels + 1;	
			} else {
				skyChannelDeleteArr[count_delete_sky_channels]= this.value ;
				count_delete_sky_channels = count_delete_sky_channels + 1;
			}
							
		});


        //// selected Channels
		$(".property_channels").each(function( key, value ) {

			if ($('#'+this.id).is(":checked"))  {
				channels[count_channels]= this.value ;
				count_channels = count_channels + 1;
			} else {
				delete_channels[count_delete_channels]= this.value ;
				count_delete_channels = count_delete_channels + 1;
			}

		});
		escape_title = $('#escape_title').val();
		escape_detail = $('#escape_detail').val();
		booking_type = $('#bookingType').val();
		type_of_escape = $('#s').val();
		guest_capacity = $('#guest_capacity').val();
		property_video = $('#property_video').val();
                escape_phone = $('#escape_phone_value').val();
		photographer = $(".photographer_radio[type='radio']:checked").val();
		if(typeof photographer === "undefined") {
			photographer = '';
		}
		check_in_date = $('#check_in_date').val();
		check_out_date = $('#check_out_date').val();
		children_allowed = $(".children_radio[type='radio']:checked").val();
		if(typeof children_allowed === "undefined") {
			children_allowed = '';
		}
		safety_children = $('#safety_children').val();
		if(typeof safety_children === "undefined") {
			safety_children = '';
		}
		pet_allowed = $(".pet_radio[type='radio']:checked").val();
		if(typeof pet_allowed === "undefined") {
			pet_allowed =$('#original_pet_allowed').val();
		}
		smoking = $(".smoking_radio[type='radio']:checked").val();
		if(typeof smoking === "undefined") {
			smoking ='';
		}
		age = $('#age').val();
		dwelling = $('#dwelling').val();
		bedrooms = $('#bedrooms').val();
		bathrooms = $('#bathrooms').val();
		curtains = $('#curtains').val();
		appliances = $('#appliances').val();
		cutlery = $('#cutlery').val();
		carpet = $('#carpet').val();
		furniture = $('#furniture').val();
		utensil = $('#utensil').val();
		mattress = $('#mattress').val();
		cleaning = $(".cleaning_escape[type='radio']:checked").val();
		
		if(typeof cleaning === "undefined") {
			cleaning = 0;
		}
		
		cleaning_fee = $(".cleaning_charge[type='radio']:checked").val();
		if(typeof cleaning_fee === "undefined") {
			cleaning_fee = 0;
		}
		cleaning_amount = $('#charge_amount_value').val();
		if(typeof cleaning_amount === "undefined") {
			cleaning_amount = 0;
		}
		arrange_cleaning = $(".cleaning_help[type='radio']:checked").val();
		if(typeof arrange_cleaning === "undefined") {
			arrange_cleaning = 0;
		}
		first_name = $('#first_name').val();
		if(typeof first_name === "undefined") {
			first_name = '';
		}
		last_name = $('#last_name').val();
		if(typeof last_name === "undefined") {
			last_name = '';
		}
		email = $('#email').val();
		if(typeof email === "undefined") {
			email = '';
		}
		phone = $('#phone').val();
		if(typeof phone === "undefined") {
			phone = 0;
		}
		home_phone = $('#home_phone').val();
		if(typeof home_phone === "undefined") {
			home_phone = 0;
		}
		bed_lines = $(".bed_lines_escape[type='radio']:checked").val();
		if(typeof bed_lines === "undefined") {
			bed_lines = 0;
		}
		price_night = $('#price_night').val();
		price_week = $('#price_week').val();
		price_month = $('#price_month').val();
		winter_price_night = $('#winter_price_night').val();
		winter_price_week = $('#winter_price_week').val();
		winter_price_month = $('#winter_price_month').val();
		holiday_price_night = $('#holiday_price_night').val();
		holiday_price_week = $('#holiday_price_week').val();
		holiday_price_month = $('#holiday_price_month').val();
		summer_price_night = $('#summer_price_night').val();
		summer_price_week = $('#summer_price_week').val();
		summer_price_month = $('#summer_price_month').val();
		standard_rate_original = $("#standard_rate_original").val();
		winter_rate_original = $("#winter_rate_original").val();
		holiday_rate_original = $("#holiday_rate_original").val();
		summer_rate_original =$("#summer_rate_original").val();
		if($('#standard_rate').is(":checked")) {
					standard_changed = 1  }
		else {
				standard_changed =0;
		}
		standard_start_date = $('#standard_start_date').val();
		standard_end_date = $('#standard_end_date').val();
		if($('#winter_rate').is(":checked")) {
					winter_changed = 1  }
		else {
				winter_changed =0;
		}
		winter_start_date = $('#winter_start_date').val();
		winter_end_date = $('#winter_end_date').val();
		if($('#holiday_rate').is(":checked")) {
					holiday_changed = 1  }
		else {
				holiday_changed =0;
		}
		holiday_start_date = $('#holiday_start_date').val();
		holiday_end_date = $('#holiday_end_date').val();
		if($('#summer_rate').is(":checked")) {
					summer_changed = 1  }
		else {
				summer_changed =0;
		}
		summer_start_date = $('#summer_start_date').val();
		summer_end_date = $('#summer_end_date').val();
		booking_name_radio = $(".booking_name_radio[type='radio']:checked").val();
		if(typeof booking_name_radio === "undefined") {
			booking_name_radio = '';
		}
		bond_amount = $('#bond_amount').val();
                min_nights = $('#min_nights').val();

		// step 3 ////////////
		street_enable = $('#street_enable').val();
		street_visible = $('#street_visible').val();
		street_no = $('#street_no').val();
		street_name = $('#street_name').val();
		if(typeof street_no === "undefined") {
			street_no = '';
		}
		if(typeof street_name === "undefined") {
			street_name = '';
		}
		is_enable = $('#is_enable').val();
		is_visible = $('#is_visible').val();
		if($('#street_enable').is(":checked")) {
					is_street_enable = 1;  
		} else {
					is_street_enable =0;
		}
		if($('#street_visible').is(":checked")) {
					is_visible = 1; 
		} else {
					is_visible =0;
		}
		how_to_reach = $('#how_to_reach').val();
		if(typeof how_to_reach === "undefined") {
			how_to_reach = '';
		}
		country_id = $('#country_id').val();
		if(typeof country_id === "undefined") {
			country_id = 0;
		}
		certificate_file = $('#certificate').val();
		if(typeof certificate_file === "undefined") {
			certificate_file = '';
		}
		region_id = $('#region_id').val();
		if(typeof region_id === "undefined") {
			region_id =0;
		}
		country_region = $('#country_region').val();
		if(typeof country_region === "undefined") {
			country_region = '';
		}
		region_active = $('#region_active').val();
		if(typeof region_active  === "undefined") {
			region_active =0;
		}	
		city_id = $('#city_id').val();
		if(typeof city_id === "undefined") {
			city_id = 0;
		}
		region_city = $('#region_city').val();
		if(typeof region_city === "undefined") {
			region_city = '';
		}
		suburb_id = $('#suburb_id').val();
		if(typeof suburb_id === "undefined") {
			suburb_id = 0;
		}
		city_suburb = $('#city_suburb').val();
		if(typeof city_suburb === "undefined") {
			city_suburb = '';
		}
		postcode = $('#postcode').val();
		
		if(current_index == 0) {
	
				$.ajax({
						url: base_url + 'Addescape/saveInformation',
						type: "post",
						data: { current_index    : current_index,
                                escape_title     : escape_title,
                                escape_detail    : escape_detail,
                                booking_type     : booking_type,
                                type_of_escape   : type_of_escape,
                                guest_capacity   : guest_capacity,
                                check_in_date    : check_in_date ,
                                check_out_date   : check_out_date,
                                children_allowed : children_allowed,
                                safety_children  : safety_children,
                                pet_allowed      : pet_allowed ,
                                smoking          : smoking,
                                age              : age,
                                dwelling         : dwelling,
                                bedrooms         : bedrooms,
                                bathrooms        : bathrooms,
                                curtains         : curtains,
                                appliances       : appliances,
                                cutlery          : cutlery,
                                carpet           : carpet,
                                furniture        : furniture,
                                utensil          : utensil,
                                mattress         : mattress,
                                property_status  : property_status ,
                                admin_action     : admin_action,
                                property_code    : property_code ,
                                created_date     : created_date,
                                save_property_id : save_property_id,
                                property_id      : property_id,
                                step1_save       : step1_save ,
                                property_video   : property_video,
                                escape_phone     : escape_phone,
                                photographer     : photographer,
                                cleaning         : cleaning,
                                cleaning_fee     : cleaning_fee,
                                cleaning_amount  : cleaning_amount,
                                first_name       : first_name,
                                last_name        : last_name ,
                                email            : email,
                                phone            : phone,
                                home_phone       : home_phone,
                                arrange_cleaning : arrange_cleaning,
                                bed_lines        : bed_lines},
						success: function(data) {
								  if(data == 'Information saved Successfully/Edit ') {
									$('#step1_save').val(1);
									
								} else {
									$('#save_property_id').val(data);
									$('#step1_save').val(1);
								}  
						}
				});
					
		} else if(current_index == 1) {
				 if($('#step1_save').val() == 1) {
						$.ajax({
								url: base_url + 'Addescape/saveInformation',
								type: "post",
								data: { property_id             : property_id ,
                                        save_property_id        : save_property_id,
                                        current_index           : current_index,
                                        price_night             : price_night,
                                        price_week              : price_week ,
                                        price_month             : price_month,
                                        standard_changed        : standard_changed,
                                        summer_changed          : summer_changed,
                                        holiday_changed         : holiday_changed,
                                        winter_changed          : winter_changed,
                                        standard_start_date     : standard_start_date,
                                        standard_end_date       : standard_end_date,
                                        winter_start_date       : winter_start_date,
                                        winter_end_date         : winter_end_date,
                                        holiday_start_date      : holiday_start_date,
                                        holiday_end_date        : holiday_end_date,
                                        summer_start_date       : summer_start_date,
                                        summer_end_date         : summer_end_date,
                                        booking_name_radio      : booking_name_radio ,
                                        bond_amount             : bond_amount,
                                        min_nights              : min_nights,
                                        step1_save              : step1_save,
                                        property_code           : property_code ,
                                        created_date            : created_date,
                                        winter_price_night      : winter_price_night ,
                                        winter_price_week       : winter_price_week ,
                                        winter_price_month      : winter_price_month ,
                                        holiday_price_night     : holiday_price_night ,
                                        holiday_price_week      : holiday_price_week,
                                        holiday_price_month     : holiday_price_month ,
                                        summer_price_night      : summer_price_night ,
                                        summer_price_week       : summer_price_week ,
                                        summer_price_month      : summer_price_month
                                },
								success: function(data) { //alert(data);
										$("#step2_save").val(1);
										
								}
						});
						
				} else {
						$.ajax({
									url: base_url + 'Addescape/saveInformation',
									type: "post",
									data: { property_id : property_id ,  
											save_property_id : save_property_id,  
											save_escape_property_id : save_escape_property_id, 
											current_index : current_index, 
											escape_title : escape_title, 
											escape_detail : escape_detail,
											booking_type: booking_type, 
											type_of_escape:type_of_escape, 
											guest_capacity  : guest_capacity, 
											check_in_date : check_in_date , 
											check_out_date  : check_out_date ,
											children_allowed : children_allowed, 
											safety_children : safety_children, 
											pet_allowed : pet_allowed , 
											smoking : smoking, age : age, 
											dwelling : dwelling, 
											bedrooms : bedrooms, 
											bathrooms : bathrooms, 
											curtains : curtains, 
											appliances : appliances, 
											cutlery : cutlery, 
											carpet : carpet, 
											furniture : furniture, 
											utensil : utensil, 
											mattress :mattress,
											cleaning : cleaning, 
											cleaning_fee : 
											cleaning_fee, 
											cleaning_amount : cleaning_amount,
											first_name : first_name, 
											last_name : last_name , 
											email : email, 
											phone : phone, 
											home_phone : home_phone, 
											arrange_cleaning : arrange_cleaning, 
											bed_lines : bed_lines,
											
											price_night : price_night,
											price_week: price_week ,
											price_month : price_month, 
											standard_changed : standard_changed,
											summer_changed:summer_changed, 
											holiday_changed : holiday_changed, 
											winter_changed : winter_changed, 
											standard_start_date : standard_start_date, 
											standard_end_date :standard_end_date, 
											winter_start_date : winter_start_date, 
											winter_end_date : winter_end_date, 
											holiday_start_date: holiday_start_date, 
											holiday_end_date: holiday_end_date, 
											summer_start_date : summer_start_date, 
											summer_end_date: summer_end_date, 
											booking_name_radio : booking_name_radio , 
											min_nights: min_nights, 
											
											bond_amount: bond_amount ,
											min_nights              : min_nights,
											property_status : property_status , 
											admin_action : admin_action ,
											property_code : property_code , 
											created_date : created_date,
											step1_save : step1_save , 
											winter_price_night : winter_price_night , 
											winter_price_week : winter_price_week , 
											winter_price_month : winter_price_month ,
											holiday_price_night : holiday_price_night , 
											holiday_price_week : holiday_price_week, 
											holiday_price_month : holiday_price_month , 
											summer_price_night : summer_price_night , 
											summer_price_week : summer_price_week , 
											summer_price_month : summer_price_month ,  
											property_video : property_video, 
											escape_phone : escape_phone, 
											photographer : photographer  },
									success: function(data) {
											//$('#save_property_id').val(data);
											$("#step2_save").val(1);
									}
					});
				} 
		} else if(current_index == 2) {
			
			if($('#step2_save').val() == 1) {
						
							if(certificate_file != '') { 
								$.ajaxFileUpload({
									  url: base_url + 'Addescape/imageUpload', 
									 secureuri: false,
									  fileElementId: 'certificate',
									  dataType: 'JSON',
									  success: function(data) {
										certificate_upload = data; 
									}
								});
							} 
							
						setTimeout(function(){$.ajax({
									url: base_url + 'Addescape/saveInformation',
									type: "post",
									data: { property_id : property_id,current_index : current_index, property_code : property_code , created_date : created_date,street_enable :street_enable ,street_visible :street_visible ,street_no : street_no, street_name : street_name , is_enable :is_enable , is_visible : is_visible, is_street_enable  : is_street_enable, how_to_reach :how_to_reach ,country_id : country_id,region_id :region_id, country_region  : country_region , region_city : region_city, city_id : city_id, suburb_id :suburb_id ,city_suburb : city_suburb , region_active : region_active, postcode : postcode,step1_save:step1_save,step2_save : step2_save, save_property_id:save_property_id, certificate_upload : certificate_upload  },
									success: function(data) {

											$("#step3_save").val(1);
											
									}
							});
						},500);	
				}  else if($('#step1_save').val() == 1) {
				
						/* if(certificate_file != '') { 
								$.ajaxFileUpload({
									  url: base_url + 'Addescape/imageUpload', 
									 secureuri: false,
									  fileElementId: 'certificate',
									  dataType: 'JSON',
									  success: function(data) {
										certificate_upload = data; 
									}
								});
						} */
				setTimeout(function(){$.ajax({
									url: base_url + 'Addescape/saveInformation',
									type: "post",
									data: { property_id : property_id ,  save_property_id : save_property_id,  save_escape_property_id : save_escape_property_id, current_index : current_index, 
									price_night : price_night, price_week: price_week , price_month : price_month, standard_changed : standard_changed,summer_changed:summer_changed, holiday_changed : holiday_changed, winter_changed : winter_changed, standard_start_date : standard_start_date, standard_end_date :standard_end_date, winter_start_date : winter_start_date, winter_end_date : winter_end_date, holiday_start_date: holiday_start_date, holiday_end_date: holiday_end_date, summer_start_date : summer_start_date, summer_end_date: summer_end_date, booking_name_radio : booking_name_radio , bond_amount: bond_amount ,min_nights: min_nights, property_status : property_status , admin_action : admin_action ,property_code : property_code , created_date : created_date,step2_save : step2_save,street_enable :street_enable ,street_visible :street_visible ,street_no : street_no, street_name : street_name , is_enable :is_enable , is_visible : is_visible, is_street_enable  : is_street_enable, how_to_reach :how_to_reach ,country_id : country_id,city_id:city_id,region_id :region_id, country_region  : country_region , region_city : region_city, suburb_id :suburb_id ,city_id:city_id,city_suburb : city_suburb , postcode : postcode,region_active:region_active,certificate_upload:certificate_upload,step1_save:step1_save , winter_price_night : winter_price_night , winter_price_week : winter_price_week , winter_price_month : winter_price_month , holiday_price_night : holiday_price_night , holiday_price_week : holiday_price_week, holiday_price_month : holiday_price_month , summer_price_night : summer_price_night , summer_price_week : summer_price_week , summer_price_month : summer_price_month},
									success: function(data) {
											
											$("#step3_save").val(1);
									}
					}); 
				},500);
				} else {
						/* if(certificate_file != '') { 
								$.ajaxFileUpload({
									  url: base_url + 'Addescape/imageUpload', 
									 secureuri: false,
									  fileElementId: 'certificate',
									  dataType: 'JSON',
									  success: function(data) {
										certificate_upload = data; 
									}
								});
						} */ 
					setTimeout(function(){$.ajax({
									url: base_url + 'Addescape/saveInformation',
									type: "post",
									data: { property_id : property_id ,  save_property_id : save_property_id,  save_escape_property_id : save_escape_property_id, current_index : current_index, escape_title : escape_title, escape_detail : escape_detail, booking_type: booking_type, type_of_escape:type_of_escape, guest_capacity  : guest_capacity, check_in_date : check_in_date , check_out_date  : check_out_date ,children_allowed : children_allowed, safety_children : safety_children, pet_allowed : pet_allowed , smoking : smoking, age : age, dwelling : dwelling,bedrooms : bedrooms, bathrooms : bathrooms, curtains : curtains, appliances : appliances, cutlery : cutlery, carpet : carpet, furniture : furniture, utensil : utensil, mattress :mattress,property_video : property_video, escape_phone : escape_phone, photographer : photographer , cleaning : cleaning, cleaning_fee : cleaning_fee, cleaning_amount : cleaning_amount, first_name : first_name, last_name : last_name , email : email, phone : phone, home_phone : home_phone, arrange_cleaning : arrange_cleaning, bed_lines : bed_lines,
									price_night : price_night, price_week: price_week , price_month : price_month, standard_changed : standard_changed,summer_changed:summer_changed, holiday_changed : holiday_changed, winter_changed : winter_changed, standard_start_date : standard_start_date, standard_end_date :standard_end_date, winter_start_date : winter_start_date, winter_end_date : winter_end_date, holiday_start_date: holiday_start_date, holiday_end_date: holiday_end_date, summer_start_date : summer_start_date, summer_end_date: summer_end_date, booking_name_radio : booking_name_radio ,min_nights: min_nights, bond_amount: bond_amount ,property_status : property_status , admin_action : admin_action ,property_code : property_code , created_date : created_date,step2_save : step2_save,street_enable :street_enable ,street_visible :street_visible ,street_no : street_no, street_name : street_name , is_enable :is_enable , is_visible : is_visible, is_street_enable  : is_street_enable, how_to_reach :how_to_reach ,country_id : country_id,region_id :region_id, city_id:city_id,country_region  : country_region , region_city : region_city, suburb_id :suburb_id ,city_suburb : city_suburb , postcode : postcode,region_active:region_active,certificate_upload:certificate_upload,step1_save:step1_save , winter_price_night : winter_price_night , winter_price_week : winter_price_week , winter_price_month : winter_price_month , holiday_price_night : holiday_price_night , holiday_price_week : holiday_price_week, holiday_price_month : holiday_price_month , summer_price_night : summer_price_night , summer_price_week : summer_price_week , summer_price_month : summer_price_month },
									success: function(data) { 
											$('#save_property_id').val(data);
											$("#step3_save").val(1);
									}
					});
				 },500);
						
				} 
		} else if(current_index==3) { 
		
				if($('#step3_save').val() == 1) {
							$.ajax({
									url: base_url + 'Addescape/saveInformation',
									type: "post",
									data: { property_id:property_id,current_index : current_index,step2_save : step2_save,property_code : property_code , created_date : created_date,step3_save:step3_save,step1_save:step1_save , step2_save:step2_save,save_property_id:save_property_id,status:1,amenitiesArr : amenitiesArr, amenitiesDeleteArr : amenitiesDeleteArr, certificate_upload : certificate_upload },
									success: function(data) {
											$("#step4_save").val(1);
											
									}
							});
				}  else if($('#step2_save').val() == 1) {
							if(certificate_file != '') { 
								$.ajaxFileUpload({
									  url: base_url + 'Addescape/imageUpload', 
									 secureuri: false,
									  fileElementId: 'certificate',
									  dataType: 'JSON',
									  success: function(data) {
										certificate_upload = data; 
									}
								});
							
							} 
						
				setTimeout(function(){$.ajax({
									url: base_url + 'Addescape/saveInformation',
									type: "post",
									data: { save_property_id:save_property_id,property_id:property_id,current_index : current_index,step2_save : step2_save,save_property_id:save_property_id,property_code : property_code , created_date : created_date,street_enable :street_enable ,street_visible :street_visible ,street_no : street_no, street_name : street_name , is_enable :is_enable , is_visible : is_visible, is_street_enable  : is_street_enable, how_to_reach :how_to_reach ,country_id : country_id,region_id :region_id, country_region  : country_region , region_city : region_city,city_id:city_id, suburb_id :suburb_id ,city_suburb : city_suburb ,region_active:region_active, postcode : postcode,certificate_upload:certificate_upload,step3_save:step3_save,step1_save:step1_save , step2_save:step2_save,status:0 ,amenitiesArr : amenitiesArr, amenitiesDeleteArr : amenitiesDeleteArr },
									success: function(data) {
											$("#step4_save").val(1);
											
									}
							});
				 },500);
				} else if($('#step1_save').val() == 1) {
						if(certificate_file != '') { 
								$.ajaxFileUpload({
									  url: base_url + 'Addescape/imageUpload', 
									 secureuri: false,
									  fileElementId: 'certificate',
									  dataType: 'JSON',
									  success: function(data) {
										certificate_upload = data; 
									}
								});
							
						} 
				setTimeout(function(){$.ajax({
									url: base_url + 'Addescape/saveInformation',
									type: "post",
									data: { property_id : property_id ,  save_property_id : save_property_id,  save_escape_property_id : save_escape_property_id, current_index : current_index,price_night : price_night, price_week: price_week , price_month : price_month, standard_changed : standard_changed,summer_changed:summer_changed, holiday_changed : holiday_changed, winter_changed : winter_changed, standard_start_date : standard_start_date, standard_end_date :standard_end_date, winter_start_date : winter_start_date, winter_end_date : winter_end_date, holiday_start_date: holiday_start_date, holiday_end_date: holiday_end_date, summer_start_date : summer_start_date, summer_end_date: summer_end_date, booking_name_radio : booking_name_radio ,min_nights: min_nights, bond_amount: bond_amount ,property_status : property_status , admin_action : admin_action ,property_code : property_code , created_date : created_date,step2_save : step2_save,street_enable :street_enable ,street_visible :street_visible ,street_no : street_no, street_name : street_name , is_enable :is_enable , is_visible : is_visible, is_street_enable  : is_street_enable, how_to_reach :how_to_reach ,country_id : country_id,city_id:city_id,region_id :region_id, country_region  : country_region , region_city : region_city, suburb_id :suburb_id ,city_id:city_id,city_suburb : city_suburb , postcode : postcode,region_active:region_active,certificate_upload:certificate_upload,step3_save:step3_save,step1_save:step1_save , step2_save:step2_save,status:0 , amenitiesArr : amenitiesArr , amenitiesDeleteArr : amenitiesDeleteArr , winter_price_night : winter_price_night , winter_price_week : winter_price_week , winter_price_month : winter_price_month , holiday_price_night : holiday_price_night , holiday_price_week : holiday_price_week, holiday_price_month : holiday_price_month , summer_price_night : summer_price_night , summer_price_week : summer_price_week , summer_price_month : summer_price_month},
									success: function(data) {
											$("#step4_save").val(1);
									}
					});
				},500);
				} else {
						if(certificate_file != '') { 
								$.ajaxFileUpload({
									  url: base_url + 'Addescape/imageUpload', 
									 secureuri: false,
									  fileElementId: 'certificate',
									  dataType: 'JSON',
									  success: function(data) {
										certificate_upload = data; 
									}
								});
							
						} 
							
				setTimeout(function(){$.ajax({
									url: base_url + 'Addescape/saveInformation',
									type: "post",
									data: { property_id : property_id ,  save_property_id : save_property_id,  save_escape_property_id : save_escape_property_id, current_index : current_index, 
									escape_title : escape_title, escape_detail : escape_detail, booking_type: booking_type, type_of_escape:type_of_escape, guest_capacity  : guest_capacity, check_in_date : check_in_date , check_out_date  : check_out_date ,children_allowed : children_allowed, safety_children : safety_children, pet_allowed : pet_allowed , smoking : smoking, age : age, dwelling : dwelling, bedrooms : bedrooms, bathrooms : bathrooms, curtains : curtains, appliances : appliances, cutlery : cutlery, carpet : carpet, furniture : furniture, utensil : utensil, mattress :mattress,property_video : property_video, escape_phone : escape_phone, photographer : photographer ,cleaning :
									cleaning, cleaning_fee : cleaning_fee, cleaning_amount : cleaning_amount, first_name : first_name, last_name : last_name , email : email, phone : phone, home_phone : home_phone, arrange_cleaning : arrange_cleaning, bed_lines : bed_lines,price_night : price_night, price_week: price_week , price_month : price_month,standard_changed : standard_changed,summer_changed:summer_changed, holiday_changed : holiday_changed, winter_changed : winter_changed, standard_start_date : standard_start_date, standard_end_date :standard_end_date, winter_start_date : winter_start_date, winter_end_date : winter_end_date, holiday_start_date: holiday_start_date, holiday_end_date: holiday_end_date, summer_start_date : summer_start_date, summer_end_date: summer_end_date, booking_name_radio : booking_name_radio ,min_nights: min_nights, bond_amount: bond_amount ,property_status : property_status , admin_action : admin_action ,property_code : property_code , created_date : created_date,
									street_enable :street_enable ,street_visible :street_visible ,street_no : street_no, street_name : street_name , is_enable :is_enable , is_visible : is_visible, is_street_enable  : is_street_enable, how_to_reach :how_to_reach ,country_id : country_id,region_id :region_id, city_id:city_id,country_region  : country_region , region_city : region_city, suburb_id :suburb_id ,city_suburb : city_suburb , postcode : postcode,region_active:region_active,certificate_upload:certificate_upload,step3_save:step3_save,step1_save:step1_save,step2_save:step2_save ,status:0 , amenitiesArr : amenitiesArr , amenitiesDeleteArr : amenitiesDeleteArr , winter_price_night : winter_price_night , winter_price_week : winter_price_week , winter_price_month : winter_price_month , holiday_price_night : holiday_price_night , holiday_price_week : holiday_price_week, holiday_price_month : holiday_price_month , summer_price_night : summer_price_night , summer_price_week : summer_price_week , summer_price_month : summer_price_month
									},
									success: function(data) {
											
											$('#save_property_id').val(data);
											$("#step4_save").val(1);
									}
					});
				},500);
				}
		} else if(current_index==4) {
			
			if($('#step3_save').val() == 1) {
							$.ajax({
									url: base_url + 'Addescape/saveInformation',
									type: "post",
									data: { property_id:property_id,current_index : current_index,step2_save : step2_save,property_code : property_code , created_date : created_date,step3_save:step3_save,step1_save:step1_save , step2_save:step2_save,save_property_id:save_property_id ,step4_save : step4_save,status:1,categoryArr : categoryArr , amenitiesArr : amenitiesArr, amenitiesDeleteArr : amenitiesDeleteArr,categoryDeleteArr :categoryDeleteArr ,status:1},
									success: function(data) {
											$("#step5_save").val(1);
									}
							});
				}  else if($('#step2_save').val() == 1) {
							if(certificate_file != '') { 
								$.ajaxFileUpload({
									  url: base_url + 'Addescape/imageUpload', 
									 secureuri: false,
									  fileElementId: 'certificate',
									  dataType: 'JSON',
									  success: function(data) {
										certificate_upload = data; 
									}
								});
							
							} 
							
							
							
						setTimeout(function(){$.ajax({
									url: base_url + 'Addescape/saveInformation',
									type: "post",
									data: { property_id:property_id,current_index : current_index,step2_save : step2_save,save_property_id:save_property_id,property_code : property_code , created_date : created_date,street_enable :street_enable ,street_visible :street_visible ,street_no : street_no, street_name : street_name , is_enable :is_enable , is_visible : is_visible, is_street_enable  : is_street_enable, how_to_reach :how_to_reach ,country_id : country_id,region_id :region_id, country_region  : country_region , region_city : region_city,city_id:city_id, suburb_id :suburb_id ,city_suburb : city_suburb ,region_active:region_active, postcode : postcode,certificate_upload:certificate_upload,step3_save:step3_save,step1_save:step1_save , step2_save:step2_save ,step4_save :step4_save ,categoryArr : categoryArr , amenitiesArr : amenitiesArr, amenitiesDeleteArr : amenitiesDeleteArr,categoryDeleteArr :categoryDeleteArr ,status:0 , winter_price_night : winter_price_night , winter_price_week : winter_price_week , winter_price_month : winter_price_month , holiday_price_night : holiday_price_night , holiday_price_week : holiday_price_week, holiday_price_month : holiday_price_month , summer_price_night : summer_price_night , summer_price_week : summer_price_week , summer_price_month : summer_price_month},
									success: function(data) {
											$("#step5_save").val(1);
											
									}
							});
					},500);
				} else if($('#step1_save').val() == 1) {
					if(certificate_file != '') { 
								$.ajaxFileUpload({
									  url: base_url + 'Addescape/imageUpload', 
									 secureuri: false,
									  fileElementId: 'certificate',
									  dataType: 'JSON',
									  success: function(data) {
										certificate_upload = data; 
									}
								});
					} 
							
				
				
					setTimeout(function(){$.ajax({
									url: base_url + 'Addescape/saveInformation',
									type: "post",
									data: { property_id:property_id,
                                             current_index : current_index,
                                            step2_save : step2_save,
                                             property_code : property_code,
                                             created_date : created_date,
                                             step3_save:step3_save,
                                             step1_save:step1_save ,
                                             step2_save:step2_save,
                                             save_property_id:save_property_id ,
                                             step4_save : step4_save,
                                             step5_save:step5_save,
                                             status:1,
                                             categoryArr : categoryArr ,
                                             amenitiesArr : amenitiesArr,
                                             amenitiesDeleteArr : amenitiesDeleteArr,
                                             categoryDeleteArr :categoryDeleteArr ,
                                            skyChannelArr : skyChannelArr ,
                                           skyChannelDeleteArr :skyChannelDeleteArr,
                                            channels: channels,
											delete_channels			: delete_channels},
									success: function(data) {
											$("#step5_save").val(1);
									}
						});
					},500);
				} else {
						/* if(certificate_file != '') { 
								$.ajaxFileUpload({
									  url: base_url + 'Addescape/imageUpload', 
									 secureuri: false,
									  fileElementId: 'certificate',
									  dataType: 'JSON',
									  success: function(data) {
										certificate_upload = data; 
									}
								});
						} */ 
						
				
					setTimeout(function(){$.ajax({
									url: base_url + 'Addescape/saveInformation',
									type: "post",
											data: { property_id:property_id,
                                             current_index : current_index,
                                             step2_save : step2_save,
                                             save_property_id:save_property_id,
                                             property_code : property_code ,
                                             created_date : created_date,
                                             street_enable :street_enable ,
                                             street_visible :street_visible ,
                                             street_no : street_no,
                                             street_name : street_name ,
                                             is_enable :is_enable ,
                                            is_visible : is_visible,
                                             is_street_enable  : is_street_enable,
                                             how_to_reach :how_to_reach ,
                                             country_id : country_id,
                                            region_id :region_id,
                                             country_region  : country_region ,
                                             region_city : region_city,
                                             city_id:city_id,
                                             suburb_id :suburb_id ,
                                             city_suburb : city_suburb ,
                                            region_active:region_active,
                                            postcode : postcode,
                                             certificate_upload:certificate_upload,
                                             step3_save:step3_save,
                                             step1_save:step1_save ,
                                             step2_save:step2_save ,
                                             step4_save :step4_save,
                                             step5_save:step5_save ,
                                             status:0,
                                             categoryArr : categoryArr ,
                                            amenitiesArr : amenitiesArr,
                                            amenitiesDeleteArr : amenitiesDeleteArr,
                                             categoryDeleteArr :categoryDeleteArr ,
                                             skyChannelArr : skyChannelArr ,
                                             channels: channels,
                                             delete_channels: delete_channels,
                                             skyChannelDeleteArr :skyChannelDeleteArr ,
                                             winter_price_night : winter_price_night ,
                                             winter_price_week : winter_price_week ,
                                             winter_price_month : winter_price_month ,
                                             holiday_price_night : holiday_price_night ,
                                             holiday_price_week : holiday_price_week,
                                            holiday_price_month : holiday_price_month ,
                                            summer_price_night : summer_price_night ,
                                             summer_price_week : summer_price_week ,
                                            summer_price_month : summer_price_month},
									success: function(data) {
											$('#save_property_id').val(data);
											$("#step5_save").val(1);
									}
						});
					},500);
				}
		} else if(current_index==5) {
				
				if($('#step3_save').val() == 1) {
							$.ajax({
									url: base_url + 'Addescape/saveInformation',
									type: "post",
									data: { property_id         : property_id,
                                            current_index       : current_index,
                                            property_code       : property_code,
                                            created_date        : created_date,
                                            step3_save          : step3_save,
                                            step1_save          : step1_save ,
                                            step2_save          : step2_save,
                                            save_property_id    : save_property_id ,
                                            step4_save          : step4_save,
                                            step5_save          : step5_save,
                                            status              : 1,
                                            categoryArr         : categoryArr ,
                                            amenitiesArr        : amenitiesArr,
                                            amenitiesDeleteArr  : amenitiesDeleteArr,
                                            categoryDeleteArr   : categoryDeleteArr ,
                                            skyChannelArr       : skyChannelArr ,
                                            skyChannelDeleteArr : skyChannelDeleteArr,
                                            channels            : channels,
											delete_channels			: delete_channels
                                    },
									success: function(data) {
											$("#step6_save").val(1);
											
									}
							});
				}  else if($('#step2_save').val() == 1) {
							if(certificate_file != '') { 
								$.ajaxFileUpload({
									  url: base_url + 'Addescape/imageUpload', 
									 secureuri: false,
									  fileElementId: 'certificate',
									  dataType: 'JSON',
									  success: function(data) {
										certificate_upload = data; 
									}
								});
							} 
							
						setTimeout(function(){$.ajax({
									url: base_url + 'Addescape/saveInformation',
									type: "post",
									data: { property_id:property_id,
                                            current_index : current_index,
                                            save_property_id:save_property_id,
                                            property_code : property_code ,
                                            created_date : created_date,
                                            street_enable :street_enable ,
                                            street_visible :street_visible ,
                                            street_no : street_no,
                                            street_name : street_name ,
                                            is_enable :is_enable ,
                                            is_visible : is_visible,
                                            is_street_enable  : is_street_enable,
                                            how_to_reach :how_to_reach ,
                                            country_id : country_id,
                                            region_id :region_id,
                                            country_region  : country_region ,
                                            region_city : region_city,
                                            city_id:city_id,
                                            suburb_id :suburb_id ,
                                            city_suburb : city_suburb ,
                                            region_active:region_active,
                                            postcode : postcode,
                                            certificate_upload:certificate_upload,
                                            step3_save:step3_save,
                                            step1_save:step1_save ,
                                            step2_save:step2_save ,
                                            step4_save :step4_save,
                                            step5_save:step5_save ,
                                            status:0,
                                            categoryArr : categoryArr ,
                                            amenitiesArr : amenitiesArr,
                                            amenitiesDeleteArr : amenitiesDeleteArr,
                                            categoryDeleteArr :categoryDeleteArr ,
                                            skyChannelArr : skyChannelArr ,
                                            channels: channels,
                                            delete_channels: delete_channels,
                                            skyChannelDeleteArr :skyChannelDeleteArr ,
                                            winter_price_night : winter_price_night ,
                                            winter_price_week : winter_price_week ,
                                            winter_price_month : winter_price_month ,
                                            holiday_price_night : holiday_price_night ,
                                            holiday_price_week : holiday_price_week,
                                            holiday_price_month : holiday_price_month ,
                                            summer_price_night : summer_price_night ,
                                            summer_price_week : summer_price_week ,
                                            summer_price_month : summer_price_month},
									success: function(data) {
											$("#step6_save").val(1);
											
									}
							});
						},500);
				} else if($('#step1_save').val() == 1) {
					if(certificate_file != '') { 
								$.ajaxFileUpload({
									  url: base_url + 'Addescape/imageUpload', 
									 secureuri: false,
									  fileElementId: 'certificate',
									  dataType: 'JSON',
									  success: function(data) {
										certificate_upload = data; 
									}
								});
					} 
					
				
				
					setTimeout(function(){$.ajax({
									url: base_url + 'Addescape/saveInformation',
									type: "post",
									data: { property_id             : property_id ,
                                            save_property_id        : save_property_id,
                                            save_escape_property_id : save_escape_property_id,
                                            current_index           : current_index,
									        price_night             : price_night,
                                            price_week              : price_week ,
                                            price_month             : price_month,
                                            standard_changed        : standard_changed,
                                            summer_changed          : summer_changed,
                                            holiday_changed         : holiday_changed,
                                            winter_changed          : winter_changed,
                                            standard_start_date     : standard_start_date,
                                            standard_end_date       :standard_end_date,
                                            winter_start_date       : winter_start_date,
                                            winter_end_date         : winter_end_date,
                                            holiday_start_date      : holiday_start_date,
                                            holiday_end_date        : holiday_end_date,
                                            summer_start_date       : summer_start_date,
                                            summer_end_date         : summer_end_date,
                                            booking_name_radio      : booking_name_radio ,
                                            bond_amount             : bond_amount ,
                                            min_nights              : min_nights,
                                            property_status         : property_status ,
                                            admin_action            : admin_action ,
                                            property_code           : property_code ,
                                            created_date            : created_date,
                                            step2_save              : step2_save,
                                            street_enable           : street_enable ,
                                            street_visible          : street_visible ,
                                            street_no               : street_no,
                                            street_name             : street_name ,
                                            is_enable               : is_enable ,
                                            is_visible              : is_visible,
                                            is_street_enable        : is_street_enable,
                                            how_to_reach            : how_to_reach ,
                                            country_id              : country_id,
                                            city_id                 : city_id,
                                            region_id               : region_id,
                                            country_region          : country_region ,
                                            region_city             : region_city,
                                            suburb_id               : suburb_id ,
                                            city_suburb             : city_suburb ,
                                            postcode                : postcode,
                                            region_active           : region_active,
                                            certificate_upload      : certificate_upload,
                                            step3_save              : step3_save,
                                            step1_save              : step1_save ,
                                            step4_save              : step4_save,
                                            step5_save              : step5_save ,
                                            status                  : 0,
                                            categoryArr             : categoryArr ,
                                            amenitiesArr            : amenitiesArr,
                                            amenitiesDeleteArr      : amenitiesDeleteArr,
                                            categoryDeleteArr       :categoryDeleteArr ,
                                            skyChannelArr           : skyChannelArr ,
                                            channels                : channels,
                                            delete_channels         : delete_channels,
                                            skyChannelDeleteArr     : skyChannelDeleteArr ,
                                            winter_price_night      : winter_price_night ,
                                            winter_price_week       : winter_price_week ,
                                            winter_price_month      : winter_price_month ,
                                            holiday_price_night     : holiday_price_night ,
                                            holiday_price_week      : holiday_price_week,
                                            holiday_price_month     : holiday_price_month ,
                                            summer_price_night      : summer_price_night ,
                                            summer_price_week       : summer_price_week ,
                                            summer_price_month      : summer_price_month
                                    },
									success: function(data) {
											$("#step6_save").val(1);
									}
						});
					},500);
					
				} else {
						/* if(certificate_file != '') { 
								$.ajaxFileUpload({
									  url: base_url + 'Addescape/imageUpload', 
									 secureuri: false,
									  fileElementId: 'certificate',
									  dataType: 'JSON',
									  success: function(data) {
										certificate_upload = data; 
									}
								});
						} */ 
						
					setTimeout(function(){$.ajax({
									url: base_url + 'Addescape/saveInformation',
									type: "post",
									data: { property_id             : property_id ,
                                            save_property_id        : save_property_id,
                                            save_escape_property_id : save_escape_property_id,
                                            current_index           : current_index,
                                            escape_title            : escape_title,
                                            escape_detail           : escape_detail,
                                            booking_type            : booking_type,
                                            type_of_escape          :type_of_escape,
                                            guest_capacity          : guest_capacity,
                                            check_in_date           : check_in_date ,
                                            check_out_date          : check_out_date ,
                                            children_allowed        : children_allowed,
                                            safety_children         : safety_children,
                                            pet_allowed             : pet_allowed ,
                                            smoking                 : smoking,
                                            age                     : age,
                                            dwelling                : dwelling,
                                            bedrooms                : bedrooms,
                                            bathrooms               : bathrooms,
                                            curtains                : curtains,
                                            appliances              : appliances,
                                            cutlery                 : cutlery,
                                            carpet                  : carpet,
                                            furniture               : furniture,
                                            utensil                 : utensil,
                                            mattress                : mattress,
                                            property_video          : property_video,
                                            escape_phone            : escape_phone,
                                            photographer            : photographer ,
                                            cleaning                : cleaning,
                                            cleaning_fee            : cleaning_fee,
                                            cleaning_amount         : cleaning_amount,
                                            first_name              : first_name,
                                            last_name               : last_name ,
                                            email                   : email,
                                            phone                   : phone,
                                            home_phone              : home_phone,
                                            arrange_cleaning        : arrange_cleaning,
                                            bed_lines               : bed_lines,
									        price_night             : price_night,
                                            price_week              : price_week ,
                                            price_month             : price_month,
                                            standard_changed        : standard_changed,
                                            summer_changed          : summer_changed,
                                            holiday_changed         : holiday_changed,
                                            winter_changed          : winter_changed,
                                            standard_start_date     : standard_start_date,
                                            standard_end_date       : standard_end_date,
                                            winter_start_date       : winter_start_date,
                                            winter_end_date         : winter_end_date,
                                            holiday_start_date      : holiday_start_date,
                                            holiday_end_date        : holiday_end_date,
                                            summer_start_date       : summer_start_date,
                                            summer_end_date         : summer_end_date,
                                            booking_name_radio      : booking_name_radio ,
                                            bond_amount             : bond_amount ,
                                            min_nights              : min_nights,
                                            property_status         : property_status ,
                                            admin_action            : admin_action ,
                                            property_code           : property_code ,
                                            created_date            : created_date,
                                            step2_save              : step2_save,
                                            street_enable           : street_enable ,
                                            street_visible          : street_visible ,
                                            street_no               : street_no,
                                            street_name             : street_name ,
                                            is_enable               : is_enable ,
                                            is_visible              : is_visible,
                                            is_street_enable        : is_street_enable,
                                            how_to_reach            : how_to_reach ,
                                            country_id              : country_id,
                                            region_id               : region_id,
                                            city_id                 : city_id,
                                            country_region          : country_region ,
                                            region_city             : region_city,
                                            suburb_id               : suburb_id ,
                                            city_suburb             : city_suburb ,
                                            postcode                : postcode,
                                            region_active           : region_active,
                                            certificate_upload      : certificate_upload,
                                            step3_save              : step3_save,
                                            step1_save              : step1_save,
                                            step4_save              : step4_save ,
                                            step5_save              : step5_save ,
                                            status                  : 0,
                                            categoryArr             : categoryArr ,
                                            amenitiesArr            : amenitiesArr,
                                            amenitiesDeleteArr      : amenitiesDeleteArr,
                                            categoryDeleteArr       :categoryDeleteArr ,
                                            skyChannelArr           : skyChannelArr ,
                                            skyChannelDeleteArr     :skyChannelDeleteArr ,
                                            winter_price_night      : winter_price_night ,
                                            winter_price_week       : winter_price_week ,
                                            winter_price_month      : winter_price_month ,
                                            holiday_price_night     : holiday_price_night ,
                                            holiday_price_week      : holiday_price_week,
                                            holiday_price_month     : holiday_price_month ,
                                            summer_price_night      : summer_price_night ,
                                            summer_price_week       : summer_price_week ,
                                            summer_price_month      : summer_price_month,
                                            channels                : channels,
                                            delete_channels         : delete_channels
                                    },
									success: function(data) {
											$('#save_property_id').val(data);
											$("#step6_save").val(1);
									}
					});
				},500);
				}
		} else {
		
		}
	} 
	
}
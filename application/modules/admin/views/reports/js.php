<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="<?php echo base_url() ?>assets/backend/js/FormatDateTime.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
		$("#formfilter").submit(function(e){
			$('#datanya').html('Loading');
			var postData = $(this).serialize();
			var formURL = $(this).attr("action");
			$.ajax(
			{
				url : formURL,
				type: "POST",
				data : postData,
				success:function(data, textStatus, jqXHR) 
				{
					$('#datanya').html(data);
				},
				error: function(jqXHR, textStatus, errorThrown) 
				{
				}
			});
			e.preventDefault();
		});
	});
</script>
<script type="text/javascript">
    $(document).ready(function() {
		$('#datatable').dataTable();
	  
        $('#country').change(function()
        {
			id_country = $(this).val();
			$('#ajax-city').html('<select name="city_id" class="form-control" disabled="disabled"><option value="">All Cities</option></select>');
			$('#ajax-suburb').html('<select name="suburb_id" class="form-control" disabled="disabled"><option value="">All Suburbs</option></select>');
			
			if(id_country){
				$('#ajax-region').html('<select id="search-select-loading" name="region_id" class="form-control"><option value="loading">Loading..</option></select>');
				$.ajax({
					url: "<?php echo base_url(); ?>admin/ajax_get_region/" + id_country,
					success: function(data) {						
						$('#ajax-region').show();
						$('#ajax-region').html(data);
					}
				});
			} else {
				$('#ajax-region').html('<select name="region_id" class="form-control" disabled="disabled"><option value="">All Regions</option></select>');
			}
        });                    
    });
	
	function GetCityByRegion(id){
		$('#ajax-suburb').html('<select name="suburb_id" class="form-control" disabled="disabled"><option value="">All Suburbs</option></select>');
		if(id){
			$('#ajax-city').html('<select id="search-select-loading" name="city_id" class="form-control"><option value="loading">Loading..</option></select>');          		
			$.ajax({
				url: "<?php echo base_url(); ?>admin/ajax_get_city/" + id,
				success: function(data) {
					$('#ajax-city').show();
					$('#ajax-city').html(data);
				}
			});		
		} else {
			$('#ajax-city').html('<select name="city_id" class="form-control" disabled="disabled"><option value="">All Cities</option></select>');
		}
	}
	
	function GetSuburbBycity(id){
		if(id){
			$('#ajax-suburb').html('<select id="search-select-loading" name="suburb_id" class="form-control"><option value="loading">Loading..</option></select>');          		
			$.ajax({
				url: "<?php echo base_url(); ?>admin/ajax_get_suburb/" + id,
				success: function(data) {
					$('#ajax-suburb').show();
					$('#ajax-suburb').html(data);
				}
			});		
		} else {
			$('#ajax-suburb').html('<select name="suburb_id" class="form-control" disabled="disabled"><option value="">All Suburbs</option></select>');
		}
	}
</script>
<script type="text/javascript">
	function TimeType(id){
		if(id){
			$('.showdatepick').show('1000');	
			
			if(id=='daily'){
				$('.datepick').addClass('daypick');
				$('.datepick').removeClass('weekpick monthpick yearpick');
			} else if(id=='weekly'){				
				$('.datepick').addClass('weekpick');
				$('.datepick').removeClass('daypick monthpick yearpick');
			} else if(id=='monthly'){
				$('.datepick').addClass('monthpick');	
				$('.datepick').removeClass('daypick weekpick yearpick');			
			} else if(id=='yearly'){
				$('.datepick').addClass('yearpick');
				$('.datepick').removeClass('daypick weekpick monthpick');
			}
				
			$('.datepick').datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat:'MM yy',
				beforeShow: function(input, inst) {
					if ($(input).hasClass('yearpick')) {
						$('#ui-datepicker-div').addClass('yearpick');
						$('#ui-datepicker-div').removeClass('daypick weekpick monthpick');
						$(this).datepicker('option', 'showButtonPanel', true);											
						$(this).datepicker('option', 'dateFormat', 'yy');
					} else if ($(input).hasClass('monthpick')) {
						$('#ui-datepicker-div').addClass('monthpick');
						$('#ui-datepicker-div').removeClass('daypick weekpick yearpick');
						$(this).datepicker('option', 'showButtonPanel', true);																	
						$(this).datepicker('option', 'dateFormat', 'yy/mm');
					} else if ($(input).hasClass('weekpick')) {						
						$('#ui-datepicker-div').addClass('weekpick');
						$('#ui-datepicker-div').removeClass('daypick monthpick yearpick');												
						$(this).datepicker('option', 'dateFormat', 'yy/mm/dd');
						$(this).datepicker('option', 'showButtonPanel', false);
					} else if ($(input).hasClass('daypick')) {
						$('#ui-datepicker-div').removeClass('weekpick monthpick yearpick');
						$(this).datepicker('option', 'dateFormat', 'yy/mm/dd');
						$(this).datepicker('option', 'showButtonPanel', false);
					}
				},
				onClose: function(dateText, inst) {
					if ($('#ui-datepicker-div').hasClass('yearpick')) {
						var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
						$(this).datepicker('option', 'dateFormat', 'yy');
            			$(this).datepicker('setDate', new Date(year, 1));
					} else if ($('#ui-datepicker-div').hasClass('monthpick')) {
						var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
						var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
						$(this).datepicker('setDate', new Date(year, month, 1));
					} else if ($('#ui-datepicker-div').hasClass('weekpick')) {
						var date = $(this).datepicker('getDate');
						startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
						endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay()+6);
						start = startDate.customFormat("#YYYY#/#MM#/#DD#");
						end = endDate.customFormat("#YYYY#/#MM#/#DD#");		
						$(".datepick").val(start + '-' +end);				
					}
				}
			});	
		} else {
			$('.showdatepick').hide('1000');			
		}
		$(".datepick").val('');
	}
</script>
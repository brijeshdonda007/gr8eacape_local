    <div class="row-fluid">

       <div class="Block">

          <h1 class="blockHeader">

              <img src="<?php echo base_url();?>assets/frontend/images/searchbtn-pink.png" 

          alt="gr8 escape search" />Search Escapes</h1>

        	<form class="form-eventsearch" name="refine_search" id="refine_search" action="<?php echo site_url('search/refinesearch');?>" method="post">

                  <div class="row-fluid">

<!--                     <div class="span4">

                       <fieldset>

                            <label class="control-label">Keywords</label>

                            <input type="text" placeholder="Keywords" name="keywords" id="keywords" value="<?php echo @$keywords;?>">

                        </fieldset>

                     </div>-->

                       <div class="span4">

                       <fieldset>

                        <label class="control-label">Country</label>

                          <select name="country_id" id="country_id">

                              <option value="0">All Countries</option>

                              <?php

                              foreach($country as $c)

                              {

                              ?>

                            <option value="<?php echo $c->id;?>" <?php echo (@$country_id == $c->id)?'selected':'';?>><?php echo $c->country_name;?></option>

                            <?php



                              }

                            ?>

                          </select>

                        </fieldset>

                       </div>

                           <div class="span4">

                               <fieldset>

                                    <label class="control-label">Region</label>

                                    <div id="ajax-region">

                                            

                                                <select name="region_id" id="region_id" <?php if(!@$region_id and !@$country_id) { ?>disabled <?php }?>>

                                                            <option value="">All Regions</option>

                                                           <?php

                                                           foreach($region as $rn):

                                                           ?>

                                                           <option value="<?php echo $rn->id;?>" <?php echo (@$region_id == $rn->id)?'selected':'';?>><?php echo $rn->region_name?></option>

                                                           <?php

                                                           endforeach;

                                                           ?>



                                                </select>

                                    </div>

                                </fieldset>

                           </div>

                               

                     <div class="span4">

                                <fieldset>

                                    <label class="control-label">City/Town/District</label>

                                    <div id="ajax-city">

                                            

                                                <select name="city_id" id="city_id" <?php if(!@$city_id and !@$region_id and !@$country_id) { ?>disabled <?php }?>>

                                                            <option value="0">All Districts</option>

                                                           <?php

                                                           foreach($cities as $ct):

                                                           ?>

                                                           <option value="<?php echo $ct->id;?>" <?php echo (@$city_id == $ct->id)?'selected':'';?>><?php echo $ct->city_name?></option>

                                                           <?php

                                                           endforeach;

                                                           ?>



                                                </select>

                                    </div>

                                </fieldset>

                               </div>

                     

                  </div>

                  <div class="row-fluid">

                      

                      <div class="span4">

                                <fieldset>

                                        <label class="control-label">Suburb/Area</label>

                                         <div id="ajax-suburb">

                                                 

                                                     <select name="suburb_id" id="suburb_id" <?php if(!@$city_id and !@$suburb_id and !@$region_id and !@$country_id) { ?>disabled <?php }?>>

                                                                 <option value="0">All Suburbs</option>

                                                                <?php

                                                                foreach($suburb as $sb):

                                                                ?>

                                                                <option value="<?php echo $sb->id;?>" <?php echo (@$suburb_id == $sb->id)?'selected':'';?>><?php echo $sb->suburb_name?></option>

                                                                <?php

                                                                endforeach;

                                                                ?>



                                                     </select>

                                         </div>

                                     </fieldset>

                      </div>
                      <div class="span4">

                                <fieldset>

                                        <label class="control-label">Category</label>

                                        <select title="All Category" multiple="multiple" name="category_id[]" size="5" id="select-category">
                                        
                                            <?php foreach($all_category as $alc)
                                            {
                                            ?>
                                            <option value="<?php echo $alc->id;?>" <?php if((@$category_id) and in_array(@$alc->id, @$category_id)){ echo 'selected';}?>><?php echo $alc->category_title;?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        

                                </fieldset>

                      </div>
                      <div class="span4">

                        <fieldset class="radio-fix">

                            <label class="control-label">Pet</label>

                            <input type="radio" name="pet" value="1" <?php if(@$pet == 1){ echo 'checked';} else { echo '';}?> />Yes

                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="pet" value="0" <?php if(@$pet == 0){ echo 'checked';} else { echo ''; }?> />No

                        </fieldset>

                    </div>

                  </div>

                    <div class="row-fluid">

                    <div class="span4">

                      <fieldset>

                            <label class="control-label">Escape On</label>

                            <input type="text" placeholder="Start Date" name="start_date" id="start_date" value="<?php echo @$start_date;?>">

                        </fieldset>

                    </div>

                    <div class="span4">

                      <fieldset>

                            <label class="control-label">Back to Reality</label>

                            <input type="text" placeholder="End Date" name="end_date" id="end_date" value="<?php echo @$end_date;?>">

                        </fieldset>

                    </div>

                    <div class="span4">

                      <fieldset>

                            <label class="control-label">Adult</label>

                            <select name="adult" id="adult">

                                <option value="0">Select</option>

                                <?php

                                

                                $i = 1;

                                while ($i <= 10) {

                                ?>

                                <option value="<?php echo $i;?>" <?php echo (@$adult == $i)?'selected':'';?>><?php echo $i;?></option>

                                <?php

                                $i++; }

                                ?>

                            </select>

                        </fieldset>  

                    </div>

                  </div>

                  <div class="row-fluid">

                    <div class="span4">

                      <fieldset>

                            <label class="control-label">Children</label>

                            <select name="children" id="children">

                                <option value="">Select</option>

                                <?php

                                $j = 0;

                                while ($j <= 10) {

                                ?>

                                <option value="<?php echo $j;?>" <?php echo (@$children == $j)?'selected':'';?>><?php echo ($j==0)?'None':$j;?></option>

                                <?php

                                $j++; }

                                ?>

                            </select>

                            </fieldset>

                    </div>

                      <div class="span4">

                          <fieldset>

                            <label class="control-label">Bedroom</label>

                            <select name="bedroom" id="bedroom">

                                <option value="0">Select</option>

                                <?php

                                

                                $k = 1;

                                while ($k <= 10) {

                                ?>

                                <option value="<?php echo $k;?>" <?php echo (@$bedroom == $k)?'selected':'';?>><?php echo $k;?></option>

                                <?php

                                $k++; }

                                ?>

                            </select>

                        </fieldset>  

                          

                      </div>

                      <div class="span4">

                          <fieldset>

                            <label class="control-label">Bathroom</label>

                            <select name="bathroom" id="bathroom">

                                <option value="0">Select</option>

                                <?php

                                $m = 1;

                                while ($m <= 10) {

                                ?>

                                <option value="<?php echo $m;?>" <?php echo (@$bathroom == $m)?'selected':'';?>><?php echo $m;?></option>

                                <?php

                                $m++; }

                                ?>

                            </select>

                            </fieldset>

                      </div>

                    

                    

                    

                  </div>

                    <div class="row-fluid">

                        

                    </div>

                    <div class="row-fluid">

                        <div class="span4">

                      <fieldset>

                        <input type="hidden" name="refine_search" id="refine_search" value="1" />

                      <button type="submit" class="buttonBlue">Find Escapes!</button>

                    </fieldset>

                    </div>

                    </div>

            </form>

        </div>

    </div>

<script type="text/javascript">

    $(document).ready(function() {



        $('#country_id').change(function()

        {

            

            $('#ajax-region').html('<select id="search-select-loading" name="region_id"><option value="loading">Loading..</option>');

            if ($(this).val() > 0)

            {



                $.ajax({

                    url: "<?php echo base_url(); ?>ajax/getRegionAjax/" + $(this).val(),

                    success: function(data) {

                        $('#ajax-region').show();

                        $('#ajax-region').html(data);

                    }

                });

            }

            else

            {

                $('#ajax-region').html('<select id="search-select-loading" name="region_id"><option value="loading">Loading..</option>');

                $('#ajax-region').hide();

            }

        });

        

        $('#region_id').change(function()

        {

            $('#ajax-city').html('<select id="search-select-loading" name="region_id"><option value="loading">Loading..</option>');

            if ($(this).val() > 0)

            {

                

                $.ajax({

                    url: "<?php echo base_url(); ?>ajax/getCityAjax/" + $(this).val(),

                    success: function(data) {

                        $('#ajax-city').show();

                        $('#ajax-city').html(data);

                    }

                });

            }

            else

            {

                $('#ajax-city').html('Loading...');

                $('#ajax-city').hide();

            }

        });

        

         $('#city_id').change(function()

        {

            $('#ajax-suburb').html('<select id="search-select-loading" name="region_id"><option value="loading">Loading..</option>');

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

                $('#ajax-city').html('<select id="search-select-loading" name="region_id"><option value="loading">Loading..</option>');

                $('#ajax-city').hide();

            }

        });

    });

</script>



<style>

    

#search-select-loading { 

  background: url(<?php echo base_url();?>assets/frontend/images/search/loading.gif) no-repeat 0 0; 

  padding:4px; line-height: 21px;}

</style>

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

    $(function() {

          $.datepicker.setDefaults($.datepicker.regional['en']);

          $('#start_date').datepicker({dateFormat: "dd/mm/yy",beforeShowDay: NotBeforeToday,onSelect: function(selectedDate) {

                var date = $(this).datepicker('getDate');

                $('#end_date').datepicker('option', 'minDate', date); 

                date.setDate(date.getDate() + 1); 

                $('#end_date').datepicker('setDate', date); 

          }});

          $('#end_date').datepicker({dateFormat: "dd/mm/yy",onSelect: function(selectedDate) {

                $('#start_date').datepicker('option', 'maxDate', $(this).datepicker('getDate'));

          }});

    });

</script>

<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/frontend/css/jquery.multiselect.css" />
<script src="<?php echo base_url();?>assets/frontend/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/frontend/js/jquery.multiselect.js"></script>

<script type="text/javascript">
$(function(){
	$("#select-category").multiselect({header:''});
});
</script>


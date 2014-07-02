<?php $this->load->view('user/user-header');?>

<section id="content">

<div class="wrapper clearfix">

    <?php echo $general_info_ID->title;?>

<div id="tabs">

                 <ul>

                    <li><a class="active" href="<?php echo site_url('user/escapeDetails');?>/<?php echo $general_info_ID->private_code;?>">General Info</a></li>

                    <li><a href="<?php echo site_url('user/amenities');?>/<?php echo $general_info_ID->private_code;?>">Amenities</a></li>

                    <li><a href="<?php echo site_url('user/locationMap');?>/<?php echo $general_info_ID->private_code;?>">Location Map</a></li>

                    <li><a href="<?php echo site_url('user/terms');?>/<?php echo $general_info_ID->private_code;?>">Terms & Conditions</a></li>

                    <li><a href="<?php echo site_url('user/gallery');?>/<?php echo $general_info_ID->private_code;?>">Gallery</a></li>

                    <li><a href="<?php echo site_url('user/extraInfo');?>/<?php echo $general_info_ID->private_code;?>">Extra Info</a></li>

                </ul>

                <div id="tabs-1">

                    <?php $this->load->view('user/amenities_form');?>

                </div>

                         

                 

            </div>

  </div>

  

</section>









<script type="text/javascript">

    $(document).ready(function(){

        

        $('#country_id').change(function()

            {

                $('#ajax-city').html('Loading...');

                if($(this).val() > 0)

                    {

                

                $.ajax({

                  url: "<?php echo base_url();?>ajax/getCityAjax/"+$(this).val(),

                  success: function(data){

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

    });

</script>

<script type="text/javascript">



           

$(document).ready(function() {

     

	$('#generalinfo_form').validate({

		rules: {

			

                        country_id: "required",

			city_id:"required",

                        category_id:"required",

                        title:"required"

                      

			



                        

                        

		},

		messages: {

 

                        country_id: "Please select a country",

                        city_id: "Please select a city",

                        category_id: "Please select a category",

                        title: "Please select a title"

                        

							

		}

	});

        

        

});



</script>

<script>

$(document).ready(function() {

    $("option[value='']").attr('selected', 'selected');

});







</script>

  









        

        

       
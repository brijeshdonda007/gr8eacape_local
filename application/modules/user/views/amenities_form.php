

<div class="wrapper clearfix">

<div id="corporate_form_fields">

<form class="profileform" action="<?php echo site_url('user/addEditamenities');?>" method="post" name="amenities_form" id="amenities_form">

                <div class="row-fluid profileform span5">

                            <fieldset>

            

                                <label class="control-label">Amenities:</label>

                                <textarea name="amenities_detail" ><?php echo $general_info_ID->amenities;?></textarea>



                            </fieldset>



                    <fieldset>

                <input type="hidden" name="prop_id" value="<?php echo $general_info_ID->id;?>" />

                <input type="hidden" name="private_code" value="<?php echo $general_info_ID->private_code;?>"/>

              <input type="submit" class="btn buttonBlue" id="mybutton" value="Next">

              </fieldset>

            </div>

         

    

                     </form>

</div>

    </div>



<script type="text/javascript">



           

$(document).ready(function() {

     

	$('#amenities_form').validate({

		rules: {

			

                        amenities_detail: "required"

                        

                        

		},

		messages: {

 

                        amenities_detail: "Please enter amenities"

                        

							

		}

	});

        

        

});



</script>
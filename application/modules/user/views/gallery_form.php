<form action="" method="post" name="amenities_form" id="property_form1">

                <div class="control-group">

                            <div class="controls">

                                <textarea name="amenities_detail" ></textarea>



                            </div>

                          </div>



<div class="control-group">

            <div class="controls">

              <input type="submit" class="btn buttonBlue" id="mybutton" value="Submit">

              

            </div>

          </div>

                     </form>



<script type="text/javascript">



           

$(document).ready(function() {

     

	$('#amenities_form').validate({

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
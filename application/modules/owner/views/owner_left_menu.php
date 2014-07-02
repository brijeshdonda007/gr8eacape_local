<div class="span3">

      	<div class="profileBlock">

            <?php

            if($owner_detail->profile_picture)

            {

            ?>

            <img src="<?php echo base_url();?>images/profile_img/large/<?php echo $owner_detail->profile_picture;?>" />

            <?php

            }

            else

            {

            ?>

            <img src="<?php echo base_url();?>assets/frontend/images/no-image.png" />

            <?php

            }

            ?>

        </div>

    <div class="clear"></div>

        <div class="Block-first">Rating: <div class="stars-overall-top"><?php echo (@$user_ratings);?></div></div>

        <?php

        if(($this->session->userdata('user_id') != $this->uri->segment(3)))

        {

        ?>

        <div class="Block-button"><a href="#myModal" role="button" class="buttonBlue" data-toggle="modal">Contact me</a></div>

        <?php

        }

        ?>

        <div class="Block">

          <h1 class="blockHeader"> <img src="<?php echo base_url();?>assets/frontend/images/icon-location.png" alt="login icon" />Location</h1>

          <ul class="leftprofileBlock">

            <li>

                <?php 

                

                $address = "";

                if($owner_detail->street_no)

                {

                    $address .= $owner_detail->street_no;

                }

                if($owner_detail->street_name)

                {

                    $address .= $owner_detail->street_name.', ';

                }

                

                if($owner_detail->suburb)

                {

                    $address .= $owner_detail->suburb.', ';

                }

                if($owner_detail->city)

                {

                    $address .= $owner_detail->city.', ';

                }

                if($owner_detail->region)

                {

                    $address .= $owner_detail->region.', ';

                }

                

                if($owner_detail->country_id)

                {

                    $address .= $owner_country->countryname.' ';

                }

                echo $address;

                ?>

                

                

            </li>

          </ul>

        </div>

        <?php

              if(count($total_reviews) > 0)

              {

                  

              ?>

        <div class="Block">

          <h1 class="blockHeader"> <img src="<?php echo base_url();?>assets/frontend/images/icon-review.png" alt="login icon" />Reviews </h1>

          <ul class="leftprofileBlock">

              <?php

              foreach($total_reviews as $ear)

                  {

              ?>

            	<li>

					<p><?php echo $ear->reviews; ?><cite><a href="<?php echo site_url('buyer/detail/'.$ear->uid);?>"><?php echo $ear->ufname.' '.$ear->ulname;?></a></cite></p>

                </li>

                <?php

                  }

                ?>

          </ul>

        </div>

        <?php

              }

        ?>

        <div class="clear"></div>

      </div>



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

 <script>

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

				required: true,

				

			}

			

                        

		},

		messages: {

                        name: {

				required: "Please enter your first name",

				minlength: "Your first name must be less than 40 characters"

			},

                        email: "Please enter a valid email address",

                        message: "Please write message",

                        

							

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

<?php

if($owner_detail->user_type == 2)

{

?>

<script>



jQuery(function() {

    jQuery('div.stars-overall-top').starsOverallTop();

});



jQuery.fn.starsOverallTop = function() {

    return jQuery(this).each(function() {

        var val = parseFloat(jQuery(this).html());

        var size = Math.max(0, (Math.min(5, val))) * 15;

        var $span = jQuery('<span />').width(size);

        jQuery(this).html(jQuery.span);

    });

}



</script>

<?php

}

else

{

?>

<script>



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



</script>

<?php

}

?>
<?php

$total_avgl = 0;

foreach($ratings_cat as $rc)

{

 $eachcat_avg_rate = $this->buyer_model->avgRateByCatID($rc->id, $this->uri->segment(3));   

 $total_avgl +=  $eachcat_avg_rate->avgr;

 }

$ovarall_ratingsl = ($total_avgl/count($ratings_cat));

?>

<div class="span3">

      	<div class="profileBlock">

            <?php

            if($buyer_detail->profile_picture)

            {

            ?>

            <img src="<?php echo base_url();?>images/profile_img/large/<?php echo $buyer_detail->profile_picture;?>" />

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

        <div class="Block-first">Rating: <div class="stars-overall-top"><?php echo $ovarall_ratingsl;?></div></div>

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

                if($buyer_detail->street_no)

                {

                    $address .= $buyer_detail->street_no;

                }

                if($buyer_detail->street_name)

                {

                    $address .= $buyer_detail->street_name.', ';

                }

                

                if($buyer_detail->suburb)

                {

                    $address .= $buyer_detail->suburb.', ';

                }

                if($buyer_detail->city)

                {

                    $address .= $buyer_detail->city.', ';

                }

                if($buyer_detail->region)

                {

                    $address .= $buyer_detail->region.', ';

                }

                

                if($buyer_detail->country_id)

                {

                    $address .= $buyer_country->countryname.' ';

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

					<p><?php echo $ear->reviews; ?><cite><a href="<?php echo site_url('owner/detail/'.$ear->uid);?>"><?php echo $ear->ufname.' '.$ear->ulname;?></a></cite></p>

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


<section id="content">

  <div class="wrapper contact clearfix">

  <ul class="breadcrumb">

  <li><img src="<?php echo base_url(); ?>assets/frontend/images/home-breadcrumb.png"></li>

  <li><a href="<?php echo site_url();?>">Home</a> <span class="divider"><img alt="" src="<?php echo base_url();?>assets/frontend/images/breadcrumb-divider.png"></span></li>

  <li>Contact us</li>

</ul>

    <div class="row-fluid">

        <h1 class="title"><img src="<?php echo base_url();?>assets/frontend/images/contact-icon.png" alt="contact-icon" />Contact Us</h1>

    </div>
      <?php if($this->session->userdata('msg')):?>
    <div class="system_msg" style="display:block;"><?php echo $this->session->userdata('msg');$this->session->unset_userdata(array('msg'=>'')); ?></div>
    <?php endif;?> 

    <div class="row-fluid">

       <h3>Call us on <span>01225 471 465 </span>or email us <a href="#">hello@gr8escape.com</a></h3>

    </div>

    <form class="form-eventsearch" name="contact_us" id="contact_us" action="<?php echo site_url('home/contactsendemail');?>" method="post">

                  <div class="row-fluid">

                    <div class="span6"> 

                                      

                              <div class="padding-bottom">

                                <fieldset>

                                  <label class="control-label">Full Name <span class="important">*</span></label>

                                  <input id="full_name" name="full_name" type="text" placeholder="Enter Full Name" >

                                </fieldset>

                              </div>

                                  

                               <div class="padding-bottom">

                                <fieldset>

                                  <label  class="control-label">Email Address<span class="important">*</span></label>	

                                  <input id="email" name="email" type="email" placeholder="Enter Email Address" >

                                </fieldset>

                              </div>

                           

                              

                             <div class="padding-bottom">

                               <fieldset>

                                  <label  class="control-label">Phone Number <span class="important">*</span></label>		

                                  <input id="phone_number" name="phone_number" type="text" placeholder="Enter Phone Number">	

                               </fieldset>	

                             </div>

                      </div>

                    <div class="span6">

                          <div class="textarea">

                            <fieldset>

                              <label for="message">Your Message <span class="important">*</span></label>		

                              <textarea id="message" name="message" rows="6" cols="60" placeholder="Enter Your Message"></textarea>		

                            </fieldset>

                          </div>

                     </div>

                  </div>

                  <div class="row-fluid">

                      <button class="buttonBlue" name="submit" id="submit" type="submit">Submit Message</button>

                  </div>

            </form>

    <div class="row-fluid margin-top">

       <h1 class="title"><img src="<?php echo base_url();?>assets/frontend/images/google-point-icon.png" alt="google-point-icon" />You can find us here</h1>

       <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.np/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=auckland+new+zealand&amp;aq=&amp;sll=27.708911,85.326176&amp;sspn=0.084042,0.169086&amp;ie=UTF8&amp;hq=&amp;hnear=Auckland,+New+Zealand&amp;ll=-36.84846,174.763332&amp;spn=0.607592,1.352692&amp;t=m&amp;z=10&amp;output=embed"></iframe><br />

    </div>

  </div>

</section>

<script type="text/javascript">
$(document).ready(function() {
$('#contact_us').validate({
		rules: {

			full_name: {

                            required: true,

                            maxlength: 60

                        },


			email: {

				required: true,

				email: true

			},

                        phone_number: {

				required: true,

				

			},
                        
                        message: {

				required: true,

				

			}

		},

		messages: {

                        full_name: {

				required: "Please enter your first name",

				minlength: "Your first name must be less than 60 characters"

			},

                      
                        email: "Please enter a valid email address",

                        phone_number: "Please write phone number",
                        message: "Please enter message",

							

		}

	});
        
        });
</script>
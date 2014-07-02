<section id="content">
	<div class="wrapper clearfix contact">
		<ul class="breadcrumb">
			<li><img src="<?php echo base_url(); ?>assets/frontend/images/home-breadcrumb.png" /></li>
			<li><a href="<?php echo site_url('home'); ?>">Home</a> <span class="divider"><img src="<?php echo base_url(); ?>assets/frontend/images/breadcrumb-divider.png" alt="" /></span></li>
			<li><?php echo @$helpsupport->page_name; ?></li>
		</ul>
		<div class=" row-fluid">
			<div class="span12">
	      	<?php if($this->session->userdata('msg')):?>
	    	<div class="system_msg" style="display:block;"><?php echo $this->session->userdata('msg');$this->session->unset_userdata(array('msg'=>'')); ?></div>
    		<?php endif;?> 

		    	<?php echo @$helpsupport->page_description; ?>
    			<form class="form-eventsearch" name="contact_us" id="contact_us" action="<?php echo site_url('home/contactsendemail_help');?>" method="post">
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
			</div>
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
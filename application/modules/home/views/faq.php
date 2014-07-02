<section id="content">
	<div class="wrapper clearfix">
		<ul class="breadcrumb">
			<li><img src="<?php echo base_url(); ?>assets/frontend/images/home-breadcrumb.png" /></li>
			<li><a href="<?php echo site_url('home'); ?>">Home</a> <span class="divider"><img src="<?php echo base_url(); ?>assets/frontend/images/breadcrumb-divider.png" alt="" /></span></li>
			<li><?php echo @$howitworks->page_name; ?></li>
		</ul>
		<div class=" row-fluid">
			<div class="span12">
				<p>
					Hi! Welcome to our Frequently Asked Questions page. All the commonly asked questions that our customers ask are all placed ‘live’ on this web page. If you have a question that’s not already listed here please fill out the form below:
				</p>
			</div>
		</div>
		<div class=" row-fluid" id="faq-div">
		Write your question here:
		<?php if($this->session->userdata('msg')):?>
			<div class="system_msg" style="display:block;"><?php echo $this->session->userdata('msg');$this->session->unset_userdata(array('msg'=>'')); ?></div>
		<?php endif;?>
			<form class="form-eventsearch" name="faq_form" id="faq_form" action="<?php echo site_url('home/faqsend');?>" method="post">
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
								<label for="faq_question">Your Question <span class="important">*</span></label>		
								<textarea id="faq_question" name="faq_question" rows="6" cols="60" placeholder="Enter Your Question"></textarea>		
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
</section>
<script type="text/javascript">
$(document).ready(function() {
$('#faq_form').validate({
		rules: {
			full_name: {
                            required: true,
                            maxlength: 30
                        },
			email: {
				required: true,
				email: true
			},
                        faq_question: {
				required: true
			}
		},
		messages: {
                        full_name: {
				required: "Please enter your first name",
				minlength: "Your first name must be less than 30 characters"
			},
                        email: "Please enter a valid email address",
                        faq_question: "Please write question"
		}
	});
        });
</script>
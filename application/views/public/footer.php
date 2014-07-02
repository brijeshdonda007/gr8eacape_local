<footer>
    <?php
    $this->load->helper('Location_helper');
    $regions = Location_helper::get_region_by_CountryID(1,20,0);
    ?>
	<div class="row-fluid">
		<div class="wrapper clearfix">
			<div class="span8">
				<div class="row-fluid">
					<h5>Destinations</h5>
					<div class="span8">
						<ul>
							<span class="title-head">New Zealand</span>
							<li>
								<ul class="new-zealand">
								 <?php
								 foreach($regions as $r)
								 {
								 $count_city = Location_helper::get_count_property_regionID($r->id);
								 ?>
									<li><a href="<?php echo site_url('region/' .$r->region_name);?>"><?php echo $r->region_name;
									if ($count_city > 0) {
										echo ' ['. $count_city . ']' ;
									} ?>
                                        </a></li>
								<?php
								 }
								?>
								    <li><a href="<?php echo site_url('region/index/1');?>"><strong>More</strong></a></li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="span3 pacific-island">
						<ul>
							<div class="title-head">Pacific Island</div>
							<li>
								<ul>
									<li><a href="<?php echo site_url('country/Chatham Islands');?>">Chatham Islands</a></li>
									<li><a href="<?php echo site_url('country/Fiji');?>">Fiji</a></li>
									<li><a href="<?php echo site_url('country/New Caledonia');?>">New Caledonia</a></li>
									<li><a href="<?php echo site_url('country/Rarotonga');?>">Rarotonga</a></li>
									<li><a href="<?php echo site_url('country/Samoa');?>">Samoa</a></li>
									<li><a href="<?php echo site_url('country/Tonga');?>">Tonga</a></li>
									<li><a href="<?php echo site_url('country/Vanuatu');?>">Vanuatu</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="span4">
				<h5>Categories</h5>
				<?php
			$sql = "SELECT tbl_category.*,COUNT(tbl_property_cats.id) AS escape_count FROM tbl_category,tbl_property_cats WHERE tbl_category.id = tbl_property_cats.category_id AND tbl_property_cats.property_id IN(SELECT id FROM tbl_property WHERE tbl_property.id = tbl_property_cats.property_id  AND tbl_property.property_status = 1)  AND tbl_category.category_status = 1 GROUP BY tbl_category.id ORDER BY escape_count DESC LIMIT 0,9";

				$query = $this->db->query($sql);
				$categoryResultArray = $query->result();
				?>
                
                <ul>
					<li>
                        <ul class="categories">
                        <?php 
                            foreach($categoryResultArray as $categories){
                        ?>
                        <li><a href="<?php echo site_url('category/index/'.$categories->id);?>"><?php echo $categories->category_title;
                        	if ($categories->escape_count > 0) {
										echo ' ['. $categories->escape_count . ']' ;
									} ?>
                        </a></li>
                        <?php
                            } 
                        ?>
                        <li><a href="<?php echo site_url('category/lists');?>"><strong>More</strong></a></li>
                        </ul>
                    </li>
                </ul>
                
			</div>
		</div>
	</div>
	<div class="footerBottom">
		<div class="wrapper clearfix">
			<span id="subscribe_msg" style="display: none;"></span>
			<div class="input-append">
				<input class="input-large" id="full_name" type="text" placeholder="Enter your full name here" value=""/>
        		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="input-large" id="subscribe_email" type="text" placeholder="Enter your email address here" value=""/>
				<a href="javascript:void(0);" id="subscribe">Subscribe</a> 
			</div>
			<nav>
				<ul>
					<?php if (@$footer_menus){?>
					<?php foreach ($footer_menus as $fm){?>
						<li><a href="<?php echo $fm->link; ?>"><?php echo $fm->name;?></a></li>
					<?php } ?>
					<?php } ?>
					<!--<li><a href="<?php echo base_url();?>">Home</a></li>
					<li><a href="<?php echo site_url('company') ?>">Company</a></li>
					<li><a href="<?php echo site_url('search');?>">Search Escapes</a></li>
					<li><a href="<?php echo site_url('destination') ?>">Destinations</a></li>
					<li><a href="<?php echo site_url('home/faq');?>">FAQ</a></li>
					<li><a href="<?php echo site_url('helpsupport') ?>">Help/Support</a></li>
					<li><a href="#">Blogs</a></li>
					<li><a href="<?php echo site_url('contactus');?>">Contact Us</a></li>-->
				</ul>
			</nav>
			<p>Copyright &copy; <?php echo date('Y');?> Gr8escapes.com. All Rights Reserved</p>
			<nav>
				<ul>
					<?php if (@$footer_bottom_menus){?>
					<?php foreach (@$footer_bottom_menus as $fm_b){ ?>
						<li><a href="<?php echo $fm_b->link ?>"><?php echo $fm_b->name;?></a></li>
					<?php } ?>
					<?php } ?>
					<!--<li><a href="<?php echo site_url('privacypolicy') ?>">Privacy Policy</a></li>
					<li><a href="<?php echo site_url('terms') ?>">Terms &amp; Conditions</a></li>
					<li><a href="<?php echo site_url('cancellationpolicy'); ?>">Cancellation Policy</a></li>-->
				</ul>
      		</nav>
      		<a href="<?php echo $settings->facebook_link; ?>"><img src="<?php echo base_url(); ?>assets/frontend/images/facebook.jpg" alt="facebook icon" /></a> <a href="<?php echo $settings->twitter_link; ?>"><img src="<?php echo base_url(); ?>assets/frontend/images/twitter.jpg" alt="twitter icon" /></a>
		</div>
	</div>
</footer>
<script type="text/javascript">
    $(document).ready(function() {
        $('#subscribe').click(function()
        {
        var subscribe_email = $('#subscribe_email').val();
        var emailRegex = new RegExp(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i);
        var valid = emailRegex.test(subscribe_email);
        var full_name = $('#full_name').val();
        if(full_name == '')
            {
                alert('please enter your full name');
                $("#full_name").focus();
            }
        else if (subscribe_email == '')
            {
                alert('please enter your email');
                $("#subscribe_email").focus();
            }
            else if(!valid)
            {
                alert('Please enter a valid email');
                $("#subscribe_email").focus();
            }
            else
                {
            $('#subscribe_msg').css('display', 'block');
             $('#subscribe_msg').html('Checking...');
                $.ajax({
                    type: 'post',
                    data: { full_name : full_name, subscribe_email : subscribe_email },
                    url: "<?php echo base_url(); ?>ajax/subscribe",
                    success: function(data) {
                    if(data == 1)
                    {
                        $('#subscribe_msg').html('Thank you for subscribing with us.');
                    }
                    else
                    {
                        $('#subscribe_msg').html('You have already been subscribed.');
                    }
                    }
                });
         }
        });
    });
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47061288-1', 'gr8escapes.com');
  ga('send', 'pageview');

</script>

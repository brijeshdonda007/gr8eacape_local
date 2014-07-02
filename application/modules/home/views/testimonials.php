<!-- TESTIMONIALS-->
<div class="row-fluid">
    <div class="wrapper clearfix">
      <?php if(empty($testimonials)): ?>
        <?php else:?>
         <h1 class="title center"> What our customers are saying?</h1>
       <?php endif;?>  
		<ul>
		  <?php
		  $i=1;
		  foreach($testimonials as $tm)
		  {
		      if($i=1)
		      {
		          $class = 'pull-right';
		      }
		  ?>
			<li class="span6 testimonial <?php echo $class;?>">
				<?php if(!empty($tm->image)) : ?>

				<div class="img"><a href="#"><img src="<?php echo base_url(); ?>images/testimonials/<?php echo $tm->image?>" alt="<?php echo $tm->guest_name?>" /> </a>
					<div class="white"><img src="<?php echo base_url(); ?>assets/frontend/images/white.png" alt="white bg" /></div>
				</div>

			<?php else : ?>

			<?php endif; ?>	
				<div class="span8">
					<p><?php echo word_limiter($tm->detail, 50);?><img src="<?php echo base_url(); ?>assets/frontend/images/comma.png" alt="comma" /> </p>
					<strong><a href="#"><?php echo $tm->guest_name?></a></strong>
				</div>
			</li>
		<?php
		  }
		?>
		</ul>
	</div>
</div>
<?php if (empty($testimonials)){ ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.bluePart').css('margin-bottom','-12px');
		$('footer').css('margin-top','0');
	});
</script>
<?php } ?>
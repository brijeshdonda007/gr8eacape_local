<?php

if(count($you_may_love) > 0)

{

?>



<div class="clear"></div>



        <h4>You Might Also Love</h4>

        <div class="triangleArrow top"></div>

        <div class="Block guestReview clearfix">

          <div class="row-fluid clearfix">

      <ul class="widget-other">

          <?php

          foreach($you_may_love as $yml)

          {

          

          

          ?>

        <li class="span3">

          <div class="img"><a href="<?php echo site_url('escapedetails/'.$yml->custom_url);?>"> <img src="<?php echo base_url();?>images/property_img/featured/thumb/<?php echo $yml->featured_image;?>" alt="<?php echo $yml->title;?>" /> </a> </div>

         

          <h4> <a href="<?php echo site_url('escapedetails/'.$yml->custom_url);?>"><?php echo $yml->title;?><br />

          <span><?php echo $yml->price_night;?>/night </span> </a></h4>

        </li>

        <?php

          }

        

        ?>

      </ul>

    </div>

        </div>

<?php

}

?>
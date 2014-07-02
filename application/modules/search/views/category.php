<div class="Block">

          <h1 class="blockHeader"><img src="<?php echo base_url(); ?>assets/frontend/images/icon-categories.png" alt="gr8 escape categories" />Categories </h1>

          <ul class="leftBlock">

          <?php

          foreach($categories_all as $cats)

          {

          ?>

                <li><a href="<?php echo site_url('search/category/'.$cats->id);?>"><?php echo $cats->category_title;?></a></li>

        <?php

                

          }

        ?>

          </ul>

</div>
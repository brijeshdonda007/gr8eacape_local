<section id="content">

<div class="wrapper clearfix">

<ul class="breadcrumb">

  <li><img src="<?php echo base_url(); ?>assets/frontend/images/home-breadcrumb.png" /></li>

  <li><a href="<?php echo site_url('home'); ?>">Home</a> <span class="divider"><img src="<?php echo base_url(); ?>assets/frontend/images/breadcrumb-divider.png" alt="" /></span></li>

  <li>All Categories</li>

</ul>

    <div class="category-list">

        <ul>

            <?php

            foreach($all_category as $alc)
            {
				$link = site_url('category/index/'.$alc->catid);
				$onclick = '';
				if($alc->numberc == 0){
					$link = 'javascript:;';
					$onclick = 'onclick="alert(\'' . 'NO RESULT FOUND' . '\');"';
			}
            ?>

            <li><a href="<?php echo $link; ?>"  <?php echo $onclick ?>><?php echo $alc->category_title;?> [<?php echo $alc->numberc;?>]</a></li>

            <?php

            }

            ?>

        </ul>

    </div>

</div>

</section>
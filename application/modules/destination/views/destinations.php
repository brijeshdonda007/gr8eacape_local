<section id="content">
<div class="wrapper clearfix">
<ul class="breadcrumb">
  <li><img src="<?php echo base_url(); ?>assets/frontend/images/home-breadcrumb.png" /></li>
  <li><a href="<?php echo site_url('home'); ?>">Home</a> <span class="divider"><img src="<?php echo base_url(); ?>assets/frontend/images/breadcrumb-divider.png" alt="" /></span></li>
  <li><?php echo @$destination->page_name; ?></li>
</ul>
<div class=" row-fluid">
<?php
    $this->load->helper('Location_helper');
    $regions = Location_helper::get_region_by_CountryID(1,20,0);
    ?>
	<ul>
        <span class="title-head">New Zealand</span>
        <li>
          <ul class="new-zealand">
             <?php
             foreach($regions as $r)
             {
             $count_city = Location_helper::get_count_city_regionID($r->id);
             ?>
            <li><a href="<?php echo site_url('city/index/'.$r->id);?>"><?php echo $r->region_name;?> [<?php echo $count_city;?>]</a></li>
           <?php
             }
           ?>
                <li><a href="<?php echo site_url('region/index/1');?>"><strong>More</strong></a></li>
          </ul>
        </li>
      </ul>
    <ul>
        <div class="title-head">Pacific Island</div>
        <li>
          <ul>
           <li><a href="<?php echo site_url('region/index/9');?>">Chatham Islands</a></li>
           <li><a href="<?php echo site_url('region/index/5');?>">Fiji</a></li>
           <li><a href="<?php echo site_url('region/index/10');?>">New Caledonia</a></li>
           <li><a href="<?php echo site_url('region/index/4');?>">Rarotonga</a></li>
           <li><a href="<?php echo site_url('region/index/6');?>">Samoa</a></li>
           <li><a href="<?php echo site_url('region/index/7');?>">Tonga</a></li>
           <li><a href="<?php echo site_url('region/index/8');?>">Vanuatu</a></li>
          </ul>
        </li>
      </ul>
</div>
</div>
</section>
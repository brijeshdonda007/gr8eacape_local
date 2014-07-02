<?php $this->load->view('public/header');?> 
<script type="text/javascript">
function loadHomeSearchedData(pageLimit,searchq){
     $(".flash").show();
     $(".flash").fadeIn(400).html
            ('<img src="<?php echo base_url();?>assets/frontend/images/ajax-loading.gif" />');
     $.ajax({
            type: "POST",
            url: "<?php echo site_url();?>ajax/loadHomeSearchResults",
            data: {pageLimit: pageLimit, searchq: searchq},
            cache: false,
            success: function(result){ 
            $(".flash").hide();
            $(".load_more_link").addClass('noneLink');
            $("#pageData").html(result);
      }
  });
}
</script>
<script type="text/javascript">
function loadRefineSearchedData(pageLimit){
     $(".flash").show();
     $(".flash").fadeIn(400).html
            ('<img src="<?php echo base_url();?>assets/frontend/images/ajax-loading.gif" />');
     var keywords = $("#keywords").val();
     var country_id = $("#country_id").val();
     var region_id = $("#region_id").val();
     var city_id = $("#city_id").val();
     var suburb = $("#suburb").val();
     var start_date = $("#start_date").val();
     var end_date = $("#end_date").val();
     var adult = $("#adult").val();
     var children = $("#children").val();
     $.ajax({
            type: "POST",
            url: "<?php echo site_url();?>ajax/loadRefineSearchResults",
            data: {pageLimit: pageLimit, keywords: keywords, country_id: country_id, region_id: region_id, city_id: city_id, suburb: suburb, start_date: start_date, end_date: end_date, adult: adult, children: children},
            cache: false,
            success: function(result){ 
            $(".flash").hide();
            $(".load_more_link").addClass('noneLink');
            $("#pageData").html(result);
      }
  });
}
</script>
<script type="text/javascript">
function loadCategoryData(pageLimit){
     $(".flash").show();
     $(".flash").fadeIn(400).html
            ('<img src="<?php echo base_url();?>assets/frontend/images/ajax-loading.gif" />');
     $.ajax({
            type: "POST",
            url: "<?php echo site_url();?>ajax/loadPropertyByCat/<?php echo $this->uri->segment(3);?>",
            data: {pageLimit:pageLimit},
            cache: false,
            success: function(result){ 
            $(".flash").hide();
            $(".load_more_link").addClass('noneLink');
            $("#pageData").html(result);
      }
  });
}
</script>
<style>
    .noneLink{display:none;}
</style>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
<section class="content">

<div class="wrapper search clearfix">

<?php $this->load->view('search/refine_search'); ?>

<?php $this->load->view($search_mid_view); ?>

<?php //$this->load->view('search/refine_search_results'); ?>

</div>

</section>

<?php $this->load->view('public/footer'); ?>

</body>

</html>


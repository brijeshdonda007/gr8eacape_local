<div id="wrapper" class="span9">

        <div id="pageData">

    

        </div>

    </div>





<script type="text/javascript">

function loadData(pageLimit){

     $(".flash").show();

     $(".flash").fadeIn(400).html

            ('<img src="<?php echo base_url();?>assets/frontend/images/ajax-loading.gif" />');

     var dataString = 'pageLimit='+ pageLimit;

     $.ajax({

            type: "POST",

            url: "<?php echo site_url();?>ajax/loadMore_owner/"+'<?php echo $this->uri->segment(3);?>',

            data: dataString,

            cache: false,

            success: function(result){ 

            $(".flash").hide();

            $(".load_more_link").addClass('noneLink');

            $("#pageData").append(result);

      }

  });

}

  loadData('0');

</script>

<style>

    .noneLink{display:none;}

</style>
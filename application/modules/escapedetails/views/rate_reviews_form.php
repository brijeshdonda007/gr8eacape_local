<h4>Rate It</h4>

<div class="triangleArrow top"></div>

<div class="Block guestReview clearfix">

    

  <div class="row-fluid clearfix">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr>

<td colspan="5">&nbsp;</td>

</tr>

<?php

$i=1;

foreach($ratings_cat as $rc)

{

?>

<tr>

<td><?php echo $rc->title;?></td>

<td>

   <div id="r<?php echo $i;?>" class="rate_widget">

        <div class="star_1 ratings_stars"></div>

        <div class="star_2 ratings_stars"></div>

        <div class="star_3 ratings_stars"></div>

        <div class="star_4 ratings_stars"></div>

        <div class="star_5 ratings_stars"></div>

    </div>

</td>

</tr>

<?php

$i++;

}

?>



<tr>

          <td>

              <form id="prop_review" method="post" action="<?php echo site_url('escapedetails/rateReviews');?>">

                  Write Review

                  <textarea name="reviews" id="reviews"></textarea>

              <input type="hidden" name="property_id" value="<?php echo $property_detail->id;?>" />

              <input type="submit" value="Submit" /> 

              </form>

          </td>

</tr>

</table>

</div>



</div> 

<div class="clear"></div>



<script>

    $(document).ready(function() {

     

     $('#prop_review').validate({

            rules: {

                reviews: "required",

            },

            messages: {

                reviews: "Please write review",

            }

        });

     

        $('.ratings_stars').hover(

            function() {

                $(this).prevAll().andSelf().addClass('ratings_over');

                $(this).nextAll().removeClass('ratings_vote'); 

            },

            function() {

                $(this).prevAll().andSelf().removeClass('ratings_over');

//                set_votes($(this).parent());

            }

        );

        

        

        $('.ratings_stars').bind('click', function() {

            var star = this;

            var widget = $(this).parent();

            var clicked_data = {

                clicked_on : $(star).attr('class'),

                widget_id : $(star).parent().attr('id'),

                property_id : '<?php echo $property_detail->id;?>'

            };

           $.ajax({

                        

                      type: 'POST',

                      url: "<?php echo base_url();?>ajax/ratings",

                      data: clicked_data,

                        success: function(data){

                        var obj = $.parseJSON(data);

                        if(obj.is_rated == 'yes')

                            {

                                alert('You have already rated for this category!')

                                return false;

                            }

                            else if(obj.is_rated == 'no')

                            {

                                $(widget).find('.star_' + obj.rate).prevAll().andSelf().addClass('ratings_vote');

                                $(widget).find('.star_' + obj.rate).nextAll().removeClass('ratings_vote');

                            }

                      }

                });

        });

        

        

        

    });



    

    

    </script>

    

    




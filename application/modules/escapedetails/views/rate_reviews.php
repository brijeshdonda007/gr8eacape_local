

<h4>Guest Reviews</h4>

        <div class="triangleArrow top"></div>

        <div id="all-rates-reviews">

        <div class="Block guestReview clearfix">

          <div class="row-fluid clearfix">

            <table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td colspan="5">&nbsp;</td>

    </tr>

<?php
		$str = $this->uri->segment(2);
		preg_match_all('!\d+!', $str, $matches);
		$prop_id = intval($matches[0][0]);
?>

     <tr>

         

        <td>

            <div class="total-reviews" style="display:none;">

            <?php

            $total_avg = 0;

            foreach($ratings_cat as $rc)

            {

             $eachcat_avg_rate = $this->escapedetails_model->avgRateByCatID($rc->id, $prop_id);   

             $total_avg +=  $eachcat_avg_rate->avgr;

             }

            $ovarall_ratings = ($total_avg/count($ratings_cat));

            ?>

            <div class="stars-overall"><?php echo $ovarall_ratings;?></div>

            <span class="total_reviewst"><?php if(count($total_reviews) > 0){?>(<?php echo count($total_reviews); ?> reviews)<?php } else { echo 'No reviews'; }?></span>

            </div>

        </td>

        <td>

            <div class="each-cat-stars">

                   <?php

            foreach($ratings_cat as $rc)

            {

             $eachcat_avg_rate = $this->escapedetails_model->avgRateByCatID($rc->id, $prop_id);   

            ?>

            <div class="each-rates">

            <strong><?php echo $rc->title;?></strong>

                <span class="stars"><?php echo ($eachcat_avg_rate->avgr)?$eachcat_avg_rate->avgr:'0';?></span>

            </div>

            <?php

            }

            ?>

            </div>

        </td>

     </tr>

            </table>

              <?php

              if(count($total_reviews) > 0)

              {

                  foreach($total_reviews as $ear)

                  {

                      if($ear->upic)

                      {

                         $imgsrc =  base_url() . "images/profile_img/medium/" . $ear->upic;

                      }

                      else

                      {

                         $imgsrc = base_url() . "assets/frontend/images/no-image.png";

                      }

              ?>

            <div class="media">

              <a class="pull-left" href="#">

                <img class="media-object" src="<?php echo $imgsrc;?>" width="40%" alt="64x64">

              </a>

              <div class="media-body">

                <h4 class="media-heading"><a href="<?php echo site_url('owner/detail/'.$ear->uid);?>"><?php echo $ear->ufname?></a> <div class="date"><?php echo date('d/m/Y', strtotime($ear->created_date));?></div></h4>

             <?php echo $ear->reviews; ?>

              </div>

            </div>

              <?php

                  }

              }

              ?>

          </div>

        </div>

</div>

        

        <?php

        

        if((@$has_booked_by_user == 1))

        {

        if($this->session->userdata('user_id') && ($this->session->userdata('user_id') != $property_detail->owner_id))

        {

       if(($has_rated_allcats == 0) or ($has_review == 0))

       {

        ?>

        <div id="rate-review-form">

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

$israted = $this->escapedetails_model->isRatedByUsr($this->uri->segment(2), $rc->id);

if($israted == 0)

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

}

$i++;

}

       

?>

<?php

if($has_review == 0)

{

?>

<tr>

              <td>

              Write Review

              </td>

              <td>

              <form name="prop_review" id="prop_review" method="post" action="<?php echo site_url('escapedetails/rateReviews');?>">

                  

                  <textarea name="limitedtextarea" onKeyDown="limitText(this.form.limitedtextarea,this.form.countdown,150);" 

                onKeyUp="limitText(this.form.limitedtextarea,this.form.countdown,150);" class="reviewtext">

                </textarea>

                    <br>

                <font size="1">(Maximum characters: 150)<br>

                You have <input readonly type="text" name="countdown" size="3" value="150" class="reviewhidden"> characters left.</font>

              <input type="hidden" name="property_id" value="<?php echo $property_detail->id;?>" /><br />

              <input type="submit" value="Submit" class="btn buttonBlue reviewbtn" /><br /> 

              </form>

          </td>

</tr>

<?php

}

?>

</table>

</div>



</div>

    </div>

        

    



        <?php

       } }

        

        }

        ?>

      <div class="clear"></div>

      

      <script>

    $(document).ready(function() {

     

     $('#prop_review').validate({

            rules: {

                limitedtextarea: "required"

            },

            messages: {

                limitedtextarea: "Please write review"

            }

        });

     

        $('.ratings_stars').hover(

            function() {

                $(this).prevAll().andSelf().addClass('ratings_over');

                $(this).nextAll().removeClass('ratings_vote'); 

            },

            function() {

                $(this).prevAll().andSelf().removeClass('ratings_over');

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

                        $(widget).find('.star_' + obj.rate).prevAll().andSelf().addClass('ratings_vote');

                        $(widget).find('.star_' + obj.rate).nextAll().removeClass('ratings_vote');

                      }

                });

        });

        

        

        

    });



    

   

function showHide(shID) {

	if (document.getElementById(shID)) {

		if (document.getElementById(shID).style.display != 'none') {

//			document.getElementById(shID).style.display = 'none';

			document.getElementById(shID).style.display = 'block';

		}

		else {

			document.getElementById(shID).style.display = 'inline';

			document.getElementById(shID).style.display = 'none';

		}

	}

}

$(function() {

    $('span.stars').stars();

});



$.fn.stars = function() {

    return $(this).each(function() {

        var val = parseFloat($(this).html());

        var size = Math.max(0, (Math.min(5, val))) * 16;

        var $span = $('<span />').width(size);

        $(this).html($span);

    });

}



$(function() {

    $('div.stars-overall').starsOverall();

});



$.fn.starsOverall = function() {

    return $(this).each(function() {

        var val = parseFloat($(this).html());

        var size = Math.max(0, (Math.min(5, val))) * 20;

        var $span = $('<span />').width(size);

        $(this).html($span);

    });

}

    </script>

    <script language="javascript" type="text/javascript">

function limitText(limitField, limitCount, limitNum) {

	if (limitField.value.length > limitNum) {

		limitField.value = limitField.value.substring(0, limitNum);

	} else {

		limitCount.value = limitNum - limitField.value.length;

	}

}

</script>

      

    

<style>



</style>

      

      

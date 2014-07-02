<?php

if(count($booking_requests) > 0)

{



?>



<div class="Block clearfix"> 

    <!--<a href="<?php echo site_url('user/allbookings');?>" class="pull-right"><strong>VIEW ALL</strong></a>-->

          <h4>All Booking Requests</h4>

          <table class="table table-striped latest-r">

            <thead>

              <tr>

                <th>S.N.</th>

                <th>Property Name</th>

                <th>Guest Name</th>

                <th>Check In</th>

                <th>Check Out</th>

                <th>Days</th>

                <th>Status</th>

                <th>Action</th>

              </tr>

            </thead>

            <tbody>

                <?php

                $i=1;

                foreach($booking_requests as $br)

                {

                    $starting_date = new DateTime($br->start_date);
					$start_date = $starting_date->format('d/m/y');

				    $ending_date = new DateTime($br->end_date);
                    $ending_date->modify('+1 day');
                    $end_date = $ending_date->format('d/m/y');

                    $usrx = $this->user_model->getUserInfo($br->user_id);

                ?>

              <tr>

                <td><?php echo $i;?></td>

                <td><a href="<?php echo site_url('escapedetails/index/'.$br->property_id);?>"><?php echo $br->prop_name;?></a></td>

                <td><a href="<?php echo site_url('buyer/detail/'.$usrx->id)?>"><?php echo $usrx->first_name.' '.$usrx->last_name;?></a></td>

                <td><?php echo $start_date;?></td>

                <td><?php echo $end_date;?></td>

                <td><?php echo $br->booked_days;?></td>

                <td>

                    <?php

                    $array_status = unserialize($br->status);

                    

                    if(($array_status['bb'] == 0) && ($array_status['oo'] == 0))

                    {

                    ?>

                Pending

                    <?php

                    }

                    elseif(($array_status['bb'] == 1) && ($array_status['oo'] == 0))

                    {

                     ?>

                Canceled

                <?php

                    }

                    elseif(($array_status['oo'] == 1) && ($array_status['bb'] == 0))

                    {

                     ?>

                Declined

                <?php

                    }

                    elseif(($array_status['bb'] == 2) && ($array_status['oo'] == 2))

                    {

                    ?>  

                Confirmed

                    <?php 

                    

                    }?>

                    

                </td>

                <td>

                    <?php

                    $array_status = unserialize($br->status);

                    

                    if(($array_status['bb'] == 0) && ($array_status['oo'] == 0))

                    {

                    ?>

                    <div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/cross.png" alt="cross" class="pull-left" /> <a href="<?php echo site_url('user/cancelBookingByOwner/'.$br->id);?>">Cancel Booking</a></div>

                    <div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/tick.png" alt="cross" class="pull-left" /> <a href="<?php echo site_url('user/confirmBookingByOwner/'.$br->id);?>">Confirm Booking</a></div>

                    <?php

                    }

                     elseif(($array_status['bb'] == 1) && ($array_status['oo'] == 0) || ($array_status['bb'] == 0) && ($array_status['oo'] == 1))

                    {

                     ?>

                <div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/cross.png" alt="cross" class="pull-left" /> <a href="<?php echo site_url('user/deleteBookingOwner/'.$br->id);?>">Delete</a></div>

                <?php

                    }

                

                 ?>

                    

                   </td>

              </tr>

              <?php

              $i++;

              }

              ?>

            </tbody>

          </table>

          <div class="pagination"><?php echo $links; ?></div>

        </div>

<?php

}

?>
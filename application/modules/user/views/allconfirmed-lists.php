<div class="Block clearfix"> 

          <h4>All Booking Requests</h4>

          <table class="table table-striped latest-c">

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
                    
					$date = new DateTime($br->end_date);
                    $date->modify('+1 day');
                    $end_date = $date->format('d/m/y');

                    $usrx = $this->user_model->getUserInfo($br->user_id);

                ?>

              <tr>

                <td><?php echo $i;?></td>

                <td><a href="<?php echo site_url('escapedetails/'.$br->custom_url);?>"><?php echo $br->prop_name;?></a></td>

                <td><a href="<?php echo site_url('buyer/detail/'.$usrx->id)?>"><?php echo $usrx->first_name.' '.$usrx->last_name;?></a></td>

                <td><?php echo $start_date ;?></td>

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

                    elseif(($array_status['bb'] == 0) && ($array_status['oo'] == 1))

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

                    

                    }

                    elseif(($array_status['bb'] == 5) && ($array_status['oo'] == 5))

                    {

                    ?>  

                Booked

                    <?php 

                    

                    }

                    ?>

                    

                </td>

                <td>

                    <?php

                    $array_status = unserialize($br->status);

                    

                    if(($array_status['bb'] == 0) && ($array_status['oo'] == 0))

                    {

                    ?>

                    <div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/cross.png" alt="cross" class="pull-left" /> <a href="<?php echo site_url('user/cancelBookingByOwner/'.$br->id);?>">Cancel Booking</a></div>

                    <div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/cross.png" alt="cross" class="pull-left" /> <a href="<?php echo site_url('user/confirmBookingByOwner/'.$br->id);?>">Confirm Booking</a></div>

                    <?php

                    }

                    elseif(($array_status['bb'] == 1) && ($array_status['oo'] == 0))

                    {

                     ?>

                <div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/cross.png" alt="cross" class="pull-left" /> <a href="<?php echo site_url('user/cancelBookingByBuyer/'.$br->id);?>">Delete</a></div>

                <?php

                    }

                    elseif(($array_status['bb'] == 0) && ($array_status['oo'] == 1))

                    {

                        ?>

                   <div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/cross.png" alt="cross" class="pull-left" /> <a href="<?php echo site_url('user/cancelBookingByBuyer/'.$br->id);?>">Delete</a></div>     

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
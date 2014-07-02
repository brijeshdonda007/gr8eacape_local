<?php
if(count($booking_requests_buyer) > 0)
{
?>

<div class="Block clearfix"> <a href="<?php echo site_url('user/allrequestBuyer');?>" class="pull-right"><strong>VIEW ALL</strong></a>
          <h4>Booking Requests</h4>
          <table class="table table-striped latest-c">
            <thead>
              <tr>
                <th>S.N.</th>
                <th>Property Name</th>
                <th>Owner Name</th>
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
                foreach($booking_requests_buyer as $br)
                {
                    
                    $propx = $this->user_model->getPropertyInfobyID($br->property_id);
					
					$starting_date = new DateTime($br->start_date);
                    $start_date = $starting_date->format('d/m/Y');
					
				    $date = new DateTime($br->end_date);

                    $date->modify('+1 day');
                    $end_date = $date->format('d/m/Y');
                    $ownerx = $this->user_model->getUserInfo($propx->owner_id);
                ?>
              <tr>
                <td><?php echo $i;?></td>
                <td><a href="<?php echo site_url('escapedetails/index/'.$br->property_id);?>"><?php echo $br->prop_name;?></a></td>
                <td><a href="<?php echo site_url('owner/detail/'.$ownerx->id)?>"><?php echo $ownerx->first_name.' '.$ownerx->last_name;?></a></td>
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
                <div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/cross.png" alt="cross" class="pull-left" /> <a href="<?php echo site_url('user/cancelBookingByBuyer/'.$br->id);?>">Cancel Booking</a></div>
                 <?php
                    }
                    elseif(($array_status['bb'] == 1) && ($array_status['oo'] == 0) || ($array_status['bb'] == 0) && ($array_status['oo'] == 1))
                    {
                     ?>
                <div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/cross.png" alt="cross" class="pull-left" /> <a href="<?php echo site_url('user/deleteBookingBuyer/'.$br->id);?>">Delete</a></div>
                <?php
                    }
                    elseif(($array_status['bb'] == 2) && ($array_status['oo'] == 2))
                    {
                 ?>
                <div class="hyperlink"> <img src="<?php echo base_url(); ?>assets/frontend/images/tick.png" alt="cross" class="pull-left" /> <a href="<?php echo site_url('booking/paynow/'.$br->id);?>">Pay Now</a> </div>
                
                <?php
                    }
                    elseif(($array_status['bb'] == 5) && ($array_status['oo'] == 5))
                    {
                        ?>
                <div class="hyperlink"> <img src="<?php echo base_url(); ?>assets/frontend/images/tick.png" alt="cross" class="pull-left" /> <a href="<?php echo site_url('escapedetails/index/'.$br->property_id);?>">Rate</a> </div>
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
        </div>
<?php
}
?>
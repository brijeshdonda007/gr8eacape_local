<?php
if(count($confirmed_booking) > 0)
{
?>
	<div class="Block clearfix"> <a href="<?php echo site_url('user/confirmedBookings');?>" class="pull-right"><strong>VIEW ALL</strong></a>
          <h4>Latest Confirmed Requests</h4>
          <table class="table table-striped latest-c">
            <thead>
              <tr>
                <th>ID</th>
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
                foreach($confirmed_booking as $br)
                {
                    $starting_date = new DateTime($br->start_date);
					$start_date = $starting_date->format('d/m/y');
					$date = new DateTime($br->end_date);
                    $date->modify('+1 day');
                    $end_date = $date->format('d/m/Y');
					$user_id = $br->user_id;
                    $usrx = $this->user_model->getUserInfo($user_id);
					@$uid = $usrx->id;
                ?>
              <tr>
                <td><?php echo $br->url;?></td>
                <td><a href="<?php echo site_url('escapedetails/'.$br->url);?>"><?php echo $br->prop_name;?></a></td>
                <td><a href="<?php echo site_url('buyer/detail/'.$uid); ?>"><?php echo @$usrx->first_name.' '.@$usrx->last_name;?></a></td>
                <td><?php echo $start_date;?></td>
                <td><?php echo $end_date;?></td>
                <td><?php echo $br->booked_days;?></td>
                <td>
                    <?php
                    $array_status = unserialize($br->status);
                    if(($array_status['bb'] == 5) && ($array_status['oo'] == 5))
                    {
                    ?>  
                Booked
                    <?php 
                    
                    }
                    elseif(($array_status['bb'] == 2) && ($array_status['oo'] == 2))
                    {
                    ?>
                    Confirmed
                    <?php
                    }
                    ?>
                </td>
                <td>
                   
                <!--<div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/cross.png" alt="cross" class="pull-left" /> <a href="<?php echo site_url('booking/');?>">Cancel Booking</a></div>-->
                    
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
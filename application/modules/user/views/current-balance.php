<?php

if(count($previous_month_booking) > 0)

{

?>



<div class="Block clearfix"> <a href="<?php echo site_url('user/allbookings');?>" class="pull-right"><strong>VIEW ALL</strong></a>

          <h4>Previous Month Transactions</h4>

          This Month Earnings: $ 120

          <table class="table table-striped latest-r">

            <thead>

              <tr>

                <th>S.N.</th>

                <th>Property</th>

                <th>Guest</th>

                <th>Check In</th>

                <th>Check Out</th>

                <th>Days</th>

                <th>Total Price</th>

                <th>Action</th>

              </tr>

            </thead>

            <tbody>

                

              <tr>

                <td></td>

                <td><a href="">asdasdasd</a></td>

                <td><a href="asdasd">asdasdasd</a></td>

                <td>asdasd</td>

                <td>asdasd</td>

                <td>asdasd</td>

                <td>asdasd</td>

                <td>

                    <div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/tick.png" alt="cross" class="pull-left" /> <a href="<?php echo site_url('user/confirmBookingByOwner/'.$br->id);?>">Download</a></div>

                </td>

              </tr>

              <tr>

                <td></td>

                <td><a href="">asdasdasd</a></td>

                <td><a href="asdasd">asdasdasd</a></td>

                <td>asdasd</td>

                <td>asdasd</td>

                <td>asdasd</td>

                <td>asdasd</td>

                <td>

                    <div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/tick.png" alt="cross" class="pull-left" /> <a href="<?php echo site_url('user/confirmBookingByOwner/'.$br->id);?>">Download</a></div>

                </td>

              </tr>

              <tr>

                <td></td>

                <td><a href="">asdasdasd</a></td>

                <td><a href="asdasd">asdasdasd</a></td>

                <td>asdasd</td>

                <td>asdasd</td>

                <td>asdasd</td>

                <td>asdasd</td>

                <td>

                    <div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/tick.png" alt="cross" class="pull-left" /> <a href="<?php echo site_url('user/confirmBookingByOwner/'.$br->id);?>">Download</a></div>

                </td>

              </tr>

             

            </tbody>

          </table>

        </div>

<?php

}

?>



<?php

if(count($current_month_booking) > 0)

{

?>



<div class="Block clearfix"> <a href="<?php echo site_url('user/allTransCurrMnth');?>" class="pull-right"><strong>VIEW ALL</strong></a>

          <h4>Current Month Transactions</h4>

          This Month Earnings: $ <?php echo $current_balance->grand_total;?> NZ

          <table class="table table-striped latest-r">

            <thead>

              <tr>

                <th>S.N.</th>

                <th>Property</th>

                <th>Guest</th>

                <th>Check In</th>

                <th>Check Out</th>

                <th>Days</th>

                <th>Total Price</th>

                <th>Action</th>

              </tr>

            </thead>

            <tbody>

                <?php

                $i=1;

                foreach($current_month_booking as $br)

                {

                    $starting_date = new DateTime($br->start_date);
					$start_date = $starting_date->format('d/m/Y');
					
					$date = new DateTime($br->end_date);
                    $date->modify('+1 day');
                    $end_date = $date->format('d/m/Y');

                    $usrx = $this->user_model->getUserInfo($br->user_id);

                ?>

              <tr>

                <td><?php echo $i;?></td>

                <td><a href="<?php echo site_url('escapedetails/index/'.$br->property_id);?>"><?php echo $br->prop_name;?></a></td>

                <td><a href="<?php echo site_url('owner/detail/'.$usrx->id)?>"><?php echo $usrx->first_name.' '.$usrx->last_name;?></a></td>

                <td><?php echo $start_date;?></td>

                <td><?php echo $end_date;?></td>

                <td><?php echo $br->booked_days;?></td>

                <td><?php echo $br->total_price;?></td>

                <td>

                    <div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/tick.png" alt="cross" class="pull-left" /> <a href="<?php echo site_url('user/downloadEachTrnsx/'.$br->id);?>">Download</a></div>

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



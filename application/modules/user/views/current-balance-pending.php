<?php

if(count($pending_balance_all) > 0)

{

?>



<div class="Block clearfix"> <a href="<?php echo site_url('user/allPendingTransCurrMnth');?>" class="pull-right"><strong>VIEW ALL</strong></a>

          <h4>This Month Transactions</h4>

          <?php

          $pending_tot = $pending_balance_all->grand_total;

          $deductx = (10/100) * $pending_tot;

          $actual_pending_earn = $pending_tot - $deductx;

          ?>

          This Month Earnings: $ <?php echo $actual_pending_earn;?> NZ

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

                foreach($pending_balance as $br)

                {

                    


					$starting_date = new DateTime($br->start_date);
                    $start_date = $starting_dateate->format('d/m/Y');
					
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




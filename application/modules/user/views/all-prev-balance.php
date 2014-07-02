<div class="filter-by-month">

    <form name="filter_by_month" id="filter_by_month" action="<?php echo site_url('user/allPendingTransCurrMnth'); ?>" method="post">

        <select name="month" onchange="this.form.submit()">

            <option value="">-Select Month-</option>

            <?php for($i=1;$i<=12;$i++)

            {?>

            <option value="<?php echo $i;?>" <?php echo ($this->input->post('month') == $i)?'selected':''?>><?php echo $this->user_model->month_name($i);?></option>

            <?php

            }

            ?>

        </select>

        <input type="hidden" name="filter_month" value="1" />

    </form>

</div>

<?php

if(count($prev_balance) > 0)

{

?>

&nbsp;&nbsp;<a href="<?php echo site_url('user/exportphpexcel/'.$month);?>">Export in MS Excel</a>

<?php }?>

<div class="Block clearfix">

          <h4>Last Month Transactions</h4>

          <?php

          $total_earn = $prev_balance->grand_total;

          $deduct = (10/100) * $total_earn;

          $actual_earn = $total_earn - $deduct;

          ?>

          Last Month Earnings: $ <?php echo ($actual_earn)?$actual_earn:'0';?> NZ

          <?php

            if(count($prev_balance) > 0)

            {

            ?>

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

                foreach($prev_mnth_trnsx as $br)

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

                <td><a href="<?php echo site_url('buyer/detail/'.$usrx->id)?>"><?php echo $usrx->first_name.' '.$usrx->last_name;?></a></td>

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

          <?php }?>

        </div>




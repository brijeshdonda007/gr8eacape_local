    <div class="bodytop">
    <h1>Current Month Transactions</h1>
   
    	<table class="tabulardata" cellpadding="0" cellspacing="0">
        	<tr>
            	<th>SN</th>
                <th>Property</th>
                <th>Owner</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Days</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
            <?php
            $sn=1;
            foreach($pending_balance as $br)
            {
            $date = new DateTime($br->end_date);

                    $date->modify('+1 day');
                    $end_date = $date->format('Y-m-d');
                    $usrx = $this->admin_model->getUserInfo($br->bowner_id);
                ?>
              <tr <?php if($sn%2 == 0) {  echo 'class="tablealternate"'; }?>>
                <td><?php echo $sn;?></td>
                <td><a href="<?php echo site_url('escapedetails/'.$br->property_id);?>"><?php echo $br->prop_name;?></a></td>
                <td><a href="<?php echo site_url('owner/detail/'.$usrx->id)?>"><?php echo $usrx->first_name.' '.$usrx->last_name;?></a></td>
                <td><?php echo $br->start_date;?></td>
                <td><?php echo $end_date;?></td>
                <td><?php echo $br->booked_days;?></td>
                <td><?php echo $br->total_price;?></td>
                <td>
                    <div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/tick.png" alt="cross" class="pull-left" /> <a href="<?php echo site_url('user/confirmBookingByOwner/'.$br->id);?>">Download</a></div>
                </td>
              </tr>
              <?php
            $sn++; }?>
        </table>
    <div class="pagination"><?php echo $links; ?></div>
    </div>

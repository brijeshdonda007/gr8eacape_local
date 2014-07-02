	<div class="bodytop">

    <h1>Latest Bookings</h1>

    <a class="pull-right" href="<?php echo site_url('order/lists');?>">View All</a>

    <?php

    if(count($latest_booking) > 0)

    {

    

    ?>

    	<table class="tabulardata" cellpadding="0" cellspacing="0">

            <tr>

            	<th>Property</th>

                <th>Owner</th>

                <th>Guest Name</th>

                <th>Check-In</th>

                <th>Check-Out</th>

                <th>Status</th>

            </tr>

            <?php

            $i=1;

            foreach($latest_booking as $lb)

            {

                $date = new DateTime($lb->end_date);



                $date->modify('+1 day');

                $end_date = $date->format('Y-m-d');

                $ownerx = $this->dashboard_model->getUserInfo($lb->owner_id);

            ?>

            <tr class="<?php echo ($i%2 == 0)?'tablealternate':''; ?>">

            	<td><?php echo $lb->prop_name;?></td>

                <td><?php echo $ownerx->first_name.' '.$ownerx->last_name;?></td>

                <td><?php echo $lb->fname.' '.$lb->lname;?></td>

                <td><?php echo $lb->start_date;?></td>

                <td><?php echo $end_date;?></td>

                <td>Booked</td>

            </tr>

            <?php

            $i++;}

            ?>

        </table>

    <?php

    }

    else

    {

        echo 'No Booking';

    }

    ?>

    </div>

    
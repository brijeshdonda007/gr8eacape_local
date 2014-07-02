	<div class="bodytop">

    <h1>All Bookings</h1>

    <?php

    if(($total_count) > 0)

    {

    

    ?>

    	<table class="tabulardata" cellpadding="0" cellspacing="0">

            <tr>
                <th>SN</th>
            	<th>Property</th>

                <th>Owner</th>

                <th>Guest Name</th>

                <th>Check-In</th>

                <th>Check-Out</th>

                <th>Status</th>

            </tr>

            <?php

            $i=1;

            foreach($all_bookings as $lb)

            {

                $date = new DateTime($lb->end_date);



                $date->modify('+1 day');

                $end_date = $date->format('Y-m-d');

                $ownerx = $this->order_model->getUserInfo($lb->owner_id);

            ?>

            <tr class="<?php echo ($i%2 == 0)?'tablealternate':''; ?>">
                <td><?php echo $i;?></td>
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

    <div class="pagination"><?php echo $links; ?></div>

    <?php

    }

    else

    {

        echo 'No Booking';

    }

    ?>

    </div>

    
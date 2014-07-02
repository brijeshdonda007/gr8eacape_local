    	<div class="bodyfloatleft">

        <h1>Latest Users</h1>

        <a class="pull-right" href="<?php echo site_url('users/lists');?>">View All</a>

        <table class="tabulardata" cellpadding="0" cellspacing="0">

        	<tr>

            	<th>Name</th>

                <th>Created Date</th>

                <th>Status</th>

                <th>Type</th>

            </tr>

            <?php

            $i=1;

            foreach($latest_users as $lu)

            {

            ?>

            <tr class="<?php if($i%2 == 0){ echo 'tablealternate';}?>">

            	<td><?php echo $lu->first_name.' '.$lu->last_name; ?></td>

                <td><?php echo $lu->user_created_date;?></td>

                <td><?php if($lu->user_status == 1){ echo 'Active'; } else { echo 'Inactive'; }?></td>

                <td><?php if($lu->user_type == 1){ echo 'Guest';} else{ echo 'Buyer';}?></td>

            </tr>

            <?php

            }

            ?>

        </table>

        </div>

        
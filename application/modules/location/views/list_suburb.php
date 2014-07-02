    <div class="bodytop">

    <h1>List Suburb</h1>

   

    <a href="<?php echo base_url();?>location/newsuburb" class="add-new pull-right">Add New Suburb</a>

    	<table class="tabulardata" cellpadding="0" cellspacing="0">

        	<tr>

                <th>Suburb Name</th>

            	<th>City Name</th>

                <th>Country Name</th>

                <th>Region Name</th>

                <th>Featured Image</th>

                <th>Status</th>

                <th>Action</th>

            </tr>

            <?php

            $sn=1;

            foreach($all_suburb as $als):

            ?>

            <tr <?php if($sn%2 == 0) {  echo 'class="tablealternate"'; }?>>

                <td><?php echo $als->suburb_name;?></td>

                <td><?php echo $als->city_name;?></td>

                <td><?php echo $als->country_name;?></td>

            	<td><?php echo $als->region_name;?></td>

                <td><img width="50" src="<?php echo base_url();?>images/suburb/thumb/<?php echo $als->featured_image;?>" /></td>

                <td><?php if($als->status == '1') { echo 'Active'; } else { echo 'Inactive';}?></td>

                <td colspan="2"><a href="<?php echo base_url();?>location/editsuburb/<?php echo $als->id;?>">Edit</a> <a href="<?php echo base_url();?>location/deletesuburb/<?php echo $als->id;?>" onclick="return confirm('Are you sure to delete?')">Delete</a></td>

          

            	

            </tr>

             <?php $sn++; endforeach; ?>

        </table>

    <div class="pagination"><?php echo $links; ?></div>

    </div>


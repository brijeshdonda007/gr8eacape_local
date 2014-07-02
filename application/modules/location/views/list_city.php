    <div class="bodytop">

    <h1>List City</h1>

   

    <a href="<?php echo base_url();?>location/newCity" class="add-new pull-right">Add New City</a>

    	<table class="tabulardata" cellpadding="0" cellspacing="0">

        	<tr>

            	<th>City Name</th>

                <th>Country Name</th>

                <th>Region Name</th>

                <th>Featured Image</th>

                <th>Status</th>

                <th>Action</th>

            </tr>

            <?php

            $sn=1;

            foreach($all_city as $alc):

            ?>

            <tr <?php if($sn%2 == 0) {  echo 'class="tablealternate"'; }?>>

                <td><?php echo $alc->city_name;?></td>

                <td><?php echo $alc->country_name;?></td>

            	<td><?php echo $alc->region_name;?></td>

                <td><img width="50" src="<?php echo base_url();?>images/city/thumb/<?php echo $alc->featured_image;?>" /></td>

                <td><?php if($alc->city_status == '1') { echo 'Active'; } else { echo 'Inactive';}?></td>

                <td colspan="2"><a href="<?php echo base_url();?>location/editCity/<?php echo $alc->id;?>">Edit</a> <a href="<?php echo base_url();?>location/deleteCity/<?php echo $alc->id;?>" onclick="return confirm('Are you sure to delete?')">Delete</a></td>

          

            	

            </tr>

             <?php $sn++; endforeach; ?>

        </table>

    <div class="pagination"><?php echo $links; ?></div>

    </div>


    <div class="bodytop">

    <h1>List Country</h1>

   

    <a href="<?php echo base_url();?>location/newCountry" class="add-new pull-right">Add New Country</a>

    	<table class="tabulardata" cellpadding="0" cellspacing="0">

        	<tr>

            	<th>Country Name</th>

                <th>Status</th>

                <th>Action</th>

            </tr>

            <?php

            $sn=1;

            foreach($all_country as $alc):

            ?>

            <tr <?php if($sn%2 == 0) {  echo 'class="tablealternate"'; }?>>

            	<td><?php echo $alc['country_name'];?></td>

                <td><?php if($alc['status'] == '1') { echo 'Active'; } else { echo 'Inactive';}?></td>

                <td colspan="2"><a href="<?php echo base_url();?>location/editCountry/<?php echo $alc['id'];?>">Edit</a> <a href="<?php echo base_url();?>location/deleteCountry/<?php echo $alc['id'];?>" onclick="return confirm('Are you sure to delete?')">Delete</a></td>

          

            	

            </tr>

             <?php $sn++; endforeach; ?>

            

        </table>

    <div class="pagination"><?php echo $links; ?></div>

    </div>


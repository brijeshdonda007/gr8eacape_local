<div class="bodytop">

        

    <h1>List Subscriber</h1>

    <a class="pull-right" href="<?php echo site_url('subscriber/export');?>">Export</a>

    	<table class="tabulardata" cellpadding="0" cellspacing="0">

            <tr>
                <th>SN</th>
                <th>Subscriber Full Name</th>
            	<th>Subscriber Email</th>

            </tr>

            <?php

            $sn=1;

            foreach($subscribers as $sb):

            ?>

            <tr <?php if($sn%2 == 0) {  echo 'class="tablealternate"'; }?>>
                
                <td><?php echo $sn ;?></td>
                
                <td><?php echo $sb->full_name ;?></td>

            	<td><?php echo $sb->email_subscriber ;?></td>

                

            </tr>

             <?php $sn++; endforeach; ?>

            

        </table>

    </div>


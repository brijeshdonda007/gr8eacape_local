<?php

if(count($all_notifications) > 0)

{

?>



<div class="Block clearfix"> 

          <h4>All Notifications</h4>

          <table class="table table-striped latest-r">

            <thead>

              <tr>

                <th>S.N.</th>

                <th>Title</th>

                <th>Action</th>

              </tr>

            </thead>

            <tbody>

                <?php

                $i=1;

                foreach($all_notifications as $br)

                {

                    

                ?>

              <tr>

                <td><?php echo $i;?></td>

                <td><a href="<?php echo site_url('user/notifdetails/'.$br->id);?>"><?php if($br->status == 0) { ?><strong><?php echo $br->title;?></strong><?php } else { echo $br->title; }?></a></td>

                <td>

                    

                <div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/cross.png" alt="cross" class="pull-left" /> <a href="<?php echo site_url('user/deleteNotif/'.$br->id);?>">Delete</a></div>

                    

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

else

{

    ?>



<div class="Block clearfix"> 

<h4>Sorry you do not have any notifications</h4>

</div>    

<?php

}

?>
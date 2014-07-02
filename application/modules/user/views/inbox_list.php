<div class="Block clearfix"> <a href="#" class="pull-right"><strong>VIEW ALL</strong></a>

    

        <h4>Unread Messages(<?php echo count($inbox_unread_items);?>)</h4>

          <table class="table table-striped">

            <thead>

              <tr>

                <th>S.N</th>

                <th>Title</th>

                <th>Nb. Replies</th>

                <th>From</th>

                <th>Date of Creation</th>

                

                

              </tr>

            </thead>

            <tbody>

               <?php

               $unrd_i = 1;

               foreach($inbox_unread_items as $unread)

               {

               ?>

              <tr>

                <td><?php echo $unrd_i;?></td>

                <td><a href="<?php echo site_url('user/readmsg/'.$unread->id);?>"><?php echo $unread->id;?><?php echo $unread->title;?></a></td>

                <td><?php echo $unread->reps-1?></td>

                <td><a href="<?php echo site_url('owner/detail/'.$unread->userid);?>"><?php echo $unread->first_name.' '.$unread->last_name;?></a></td>

                <td><?php echo date('Y/m/d H:i:s' ,$unread->timestamp); ?></td>

              </tr>

              <?php

               $unrd_i++; }

               //If there is no unread message we notice it

            if(count($inbox_unread_items)==0)

            {

            ?>

                <tr>

                    <td colspan="6" class="center">You have no unread message.</td>

                </tr>

            <?php

            }

            ?>

              

            </tbody>

          </table>

        

          <h4>Read Messages(<?php echo count($inbox_read_items);?>)</h4>

          <table class="table table-striped">

            <thead>

              <tr>

                <th>S.N</th>

                <th>Title</th>

                <th>Nb. Replies</th>

                <th>From</th>

                <th>Date of Creation</th>

                

                

              </tr>

            </thead>

            <tbody>

               <?php

               $rd_i = 1;

               foreach($inbox_read_items as $rd)

               {

               ?>

              <tr>

                <td><?php echo $rd_i;?></td>

                <td><a href="<?php echo site_url('user/readmsg/'.$rd->id);?>"><?php echo $rd->title;?></a></td>

                <td><?php echo $rd->reps-1?></td>

                <td><a href="<?php echo site_url('owner/detail/'.$rd->userid);?>"><?php echo $rd->first_name.' '.$rd->last_name;?></a></td>

                <td><?php echo date('Y/m/d H:i:s' ,$rd->timestamp); ?></td>

              </tr>

              <?php

               $rd_i++; }

               //If there is no unread message we notice it

            if(count($inbox_read_items)==0)

            {

            ?>

                <tr>

                    <td colspan="6" class="center">You have no read message.</td>

                </tr>

            <?php

            }

            ?>

              

            </tbody>

          </table>

        </div>
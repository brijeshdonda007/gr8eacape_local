<div class="Block clearfix">

          <h4>My Escapes</h4>

          <table class="table table-striped">

            <thead>

              <tr>

                <th>ID</th>

                <th>Escape Name</th>

                <th>Status</th>

                <th>Action</th>

              </tr>

            </thead>

            <tbody>

                <?php

                $i=1;

                foreach($all_properties as $lp)

                {

                ?>

              <tr>

                <td><?php echo $i;?></td>

                <td><?php echo $lp->title;?></td>

                <td><?php

                if($lp->admin_action == 'pending'){ echo 'Pending';}

                elseif($lp->admin_action == 'approved'){ echo 'Approved';}

                elseif($lp->admin_action == 'verified'){ echo 'Verified';}

                elseif($lp->admin_action == 'declined'){ echo 'Declined';}

                ?></td>

                <td>
                    <div class="hyperlink"> <img src="<?php echo base_url(); ?>assets/frontend/images/edit.png" alt="cross" class="pull-left" /> <a href="<?php echo site_url('addescape/' . $lp->private_code);?>">Edit</a> </div>
                    <div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/cross.png" alt="cross" class="pull-left" /> <a href="<?php echo site_url('user/stopResume/' . $lp->private_code);?>"><?php if($lp->property_status == 0) { echo 'Resume';} else { echo 'On Hold';}?></a></div>
                    <div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/cross.png" alt="cross" class="pull-left" /> <a href="<?php echo site_url('addescape/delete?id=' . $lp->private_code);?>">Delete</a></div>
                  </td>

              </tr>

              <?php

              $i++;

              }

              ?>

            </tbody>

          </table>

          <div class="pagination"><?php echo $links; ?></div>

        </div>

  









        

        

       
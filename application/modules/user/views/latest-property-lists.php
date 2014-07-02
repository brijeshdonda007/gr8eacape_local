<div class="Block clearfix"> <a href="<?php echo site_url('user/escapeList');?>" class="pull-right"><strong>VIEW ALL</strong></a>

          <h4>Latest Escapes</h4>

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

                foreach($latest_escapes as $le)

                {

                ?>

              <tr>

                <td><?php echo $le->custom_url?></td>

                <td><a href="<?php echo site_url('escapedetails/'.$le->custom_url);?>"><?php echo $le->title;?></a></td>

                <td><?php 

                if($le->admin_action == 'pending'){ echo 'Pending';}

                elseif($le->admin_action == 'approved'){ echo 'Approved';}

                elseif($le->admin_action == 'verified'){ echo 'Verified';}

                elseif($le->admin_action == 'declined'){ echo 'Declined';}

                ?></td>

                <td><div class="hyperlink"> <img src="<?php echo base_url(); ?>assets/frontend/images/edit.png" alt="cross" class="pull-left" /> <a href="<?php echo site_url('addescape/' . $le->private_code);?>">Edit</a> </div>

                    <div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/cross.png" alt="cross" class="pull-left" /> <a href="<?php echo site_url('user/stopResume/' . $le->private_code);?>"><?php if($le->property_status == 0) { echo 'Resume';} else { echo 'Stop';}?></a></div>

                  </td>

              </tr>

              <?php

              $i++;

              }

              ?>

            </tbody>

          </table>

        </div>
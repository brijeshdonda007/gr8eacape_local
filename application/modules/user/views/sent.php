<div class="Block clearfix"> <a href="#" class="pull-right"><strong>VIEW ALL</strong></a>

          <h4>Sent</h4>

          <table class="table table-striped">

            <thead>

              <tr>

                <th>S.N</th>

                <th>Subject</th>

                <th>To</th>

                <th>Action</th>

              </tr>

            </thead>

            <tbody>

                <?php

                

                $sn = 0;

                

                foreach($sent_items as $sent);{

                $sn++;

                if(@$sent != '' || @$sent != 0){

                ?>

              <tr>

                <td><?php echo @$sn; ?></td>

                <td><a href="<?php echo site_url('user/viewMessage/'.@$sent->m_id); ?>"><?php echo @$sent->message; ?></a></td>

                <td><a href="<?php echo site_url('owner/detail/'.@$sent->to); ?>"><?php echo @$sent->username; ?></a></td>

                <td><div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/cross.png" alt="cross" class="pull-left" /> <a href="<?php echo site_url('user/trashMessage/'.@$sent->m_id); ?>">Delete</a></div>

              </tr>

              <?php

                }

                else{

                    ?>

              <tr>

                  <td colspan="4">Oooppss! No message to list!</td>

              </tr>

              <?php

                }

                }

              ?>

            </tbody>

          </table>

        </div>
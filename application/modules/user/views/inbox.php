

    <?php if(!$this->session->flashdata('sucess_msg') == '') {

        ?>

    <div id="flash-msg">

    <?php

        echo $this->session->flashdata('success_msg'); 

        $this->session->unset_flashdata('success_msg'); 



        

        ?>

        </div>

        <?php

                }

        ?>





<div class="Block clearfix"> <a href="#" class="pull-right"><strong>VIEW ALL</strong></a>

          <h4>Inbox</h4>

          <table class="table table-striped">

            <thead>

              <tr>

                <th>S.N</th>

                <th>Subject</th>

                <th>From</th>

                <th>Action</th>

              </tr>

            </thead>

            <tbody>

                <?php

                

                $sn = 0;

                

                foreach($inbox_items as $inbox);{

                $sn++;

                if(@$inbox != '' || @$inbox != 0){

                ?>

              <tr>

                <td><?php echo @$sn; ?></td>

                <td><a href="<?php echo site_url('user/viewMessage/'.@$inbox->m_id); ?>">Booking request for <?php echo @$inbox->message; ?></a></td>

                <td><a href="<?php echo site_url('owner/detail/'.@$inbox->from); ?>"><?php echo @$inbox->username; ?></a></td>

                <td><div class="hyperlink"><img src="<?php echo base_url(); ?>assets/frontend/images/cross.png" alt="cross" class="pull-left" /> <a href="<?php echo site_url('user/trashMessage/'.@$inbox->m_id); ?>">Delete</a></div>

                <div class="hyperlink"> <img src="<?php echo base_url(); ?>assets/frontend/images/email.png" alt="cross" class="pull-left" /> <a href="<?php echo site_url('user/replyMessage/'.@$inbox->m_id); ?>">Reply</a> </div></td>

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
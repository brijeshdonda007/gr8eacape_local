<div class="Block clearfix">
    <h4>Outbox</h4>
    <table class="table table-striped">

        <thead>
          <tr>
            <th>Subject</th>
            <th>To</th>
            <th>Sent</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
           <?php foreach($messages as $unread): ?>

          <tr>
            <td><a href="<?php echo site_url('mail/message/read?mgs_id='.$unread->id. '&type=to_user');?>"><?php echo $unread->subject;?></a></td>
            <td><a href="<?php echo site_url('owner/detail/'. $unread->to_user);?>"><?php echo $unread->first_name.' '.$unread->last_name ?></a></td>
            <td><?php echo date('d-F-Y H:i:s', $unread->timestamp) ?></td>
             <td><a href="<?php echo site_url('mail/message/delete?mgs_id='.$unread->id.'&type=outbox');?>" onclick="confirm('Are you sure?')"> Delete </a></td>
          </tr>
          <?php endforeach; if(count($messages) == 0) : ?>
           <tr>
               <td colspan="6" class="center">You have no sent message.</td>
            </tr>
        <?php endif; ?>
        </tbody>
      </table>
</div>
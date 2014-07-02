<?php if(!empty($ajax)): ?>

<h4 class="pull-left">&nbsp;</h4>
<table class="table table-bordered" id="datatable" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Property Title</th>
            <th>Owner</th>
            <th>Added On</th>
            <th>Status</th>
        </tr>	
    </thead>										
    <tbody>
    <?php if($data_report): $i=0; ?>
        <?php foreach($data_report as $dt): ?>
        <tr>
            <td><?php echo ++$i ?></td>
            <td><?php echo $dt['title'] ?></td>
            <td><?php echo $dt['first_name'].' '.$dt['last_name'] ?></td>
            <td><?php echo $dt['created_date'] ?></td>
            <td><?php echo $dt['admin_action'] ?></td>
        </tr>
        <?php endforeach ?>
    <?php else: ?>
        <tr>
            <td colspan="5" class="text-center">No data found.</td>
        </tr>
    <?php endif ?>
    </tbody>
</table>
<?php $this->load->view('js') ?>

<?php else: ?>

<style>
table {border:#000 2px solid; border-collapse:collapse;}
table td {border:#000 2px solid; padding:10px}
</style>
<center><h4>Report Escapes</h4></center>
<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Property Title</th>
        <th>Owner</th>
        <th>Added On</th>
        <th>Status</th>
    </tr>											
<?php if($data_report): $i=0; ?>
    <?php foreach($data_report as $dt): ?>
    <tr>
        <td><?php echo ++$i ?></td>
        <td><?php echo $dt['title'] ?></td>
        <td><?php echo $dt['first_name'].' '.$dt['last_name'] ?></td>
        <td><?php echo $dt['created_date'] ?></td>
        <td><?php echo $dt['admin_action'] ?></td>
    </tr>
    <?php endforeach ?>
<?php else: ?>
    <tr>
        <td colspan="5" class="text-center">No data found.</td>
    </tr>
<?php endif ?>
</table>	

<?php endif; ?>				
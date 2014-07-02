<?php if(!empty($ajax)): ?>

<h4 class="pull-left">Total Income : <?php echo number_format($total_income['total_price'],2) ?></h4> 
<table class="table table-bordered" id="datatable" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Property Title</th>
            <th>Owner</th>
            <th>Guest Name</th>
            <th>Check In</th>
            <th>Check Out</th>
            <th>Price</th>
        </tr>	
    </thead>
    <tbody>					
    <?php if($data_report): $i = 0; ?>
        <?php foreach($data_report as $dt): ?>
        <tr>
            <td><?php echo ++$i ?></td>
            <td><?php echo $dt['title'] ?></td>
            <td><?php echo $dt['first_name'].' '.$dt['last_name'] ?></td>
            <td><?php echo $dt['first_gname'].' '.$dt['last_gname'] ?></td>
            <td><?php echo $dt['start_date'] ?></td>
            <td><?php echo $dt['end_date'] ?></td>
            <td class="text-right"><?php echo number_format($dt['total_price'],2) ?></td>
        </tr>
        <?php endforeach ?>
    <?php else: ?>
        <tr>
            <td colspan="7" class="text-center">No data found.</td>
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
<center><h4>Report Income</h4></center>
<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Property Title</th>
        <th>Owner</th>
        <th>Guest Name</th>
        <th>Check In</th>
        <th>Check Out</th>
        <th>Price</th>
    </tr>						
<?php if($data_report): $i=0; $total = 0; ?>
    <?php foreach($data_report as $dt): ?>
    <?php $total = $total + $dt['total_price'] ?>
    <tr>
        <td><?php echo ++$i ?></td>
        <td><?php echo $dt['title'] ?></td>
        <td><?php echo $dt['first_name'].' '.$dt['last_name'] ?></td>
        <td><?php echo $dt['first_gname'].' '.$dt['last_gname'] ?></td>
        <td><?php echo $dt['start_date'] ?></td>
        <td><?php echo $dt['end_date'] ?></td>
        <td class="text-right"><?php echo number_format($dt['total_price'],2) ?></td>
    </tr>
    <?php endforeach ?>
    <tr class="success">
        <td colspan="6" class="text-right">Total</td>
        <td colspan="1" class="text-right"><?php echo number_format($total,2) ?></td>
    </tr>
<?php else: ?>
    <tr>
        <td colspan="7" class="text-center">No data found.</td>
    </tr>
<?php endif ?>
</table>

<?php endif ?>
					
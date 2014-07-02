<div class="bodytop">
	<h1>Users</h1>
	<a class="pull-right" href="/users/adduser">Add New User</a>
	<?php
	if(($total_count) > 0)
	{
	?>
	<table class="tabulardata" cellpadding="0" cellspacing="0">
		<tr>
			<th>User Name</th>
			<th>User Type</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
		<?php
		$i=1;
		foreach($all_users as $au)
		{
		?>
		<tr class="<?php echo ($i%2 == 0)?'tablealternate':''; ?>">
			<td><?php echo $au->first_name.' '.$au->last_name;?></td>
			<td><?php echo $au->group_name;?></td>
			<td><?php echo ($au->user_status == 1)?'Active':'Inactive';?></td>
			<td><a href="/users/editUser/<?php echo $au->id?>">Edit</a>
				<a onclick="return confirm('Are you sure to delete?')" href="/users/deleteUser/<?php echo $au->id?>">Delete</a></td>
		</tr>
		<?php
		$i++;}
		?>
	</table>
	<div class="pagination"><?php echo $links; ?></div>
	<?php
	}
	else
	{
		echo 'No Booking';
	}
	?>
</div>

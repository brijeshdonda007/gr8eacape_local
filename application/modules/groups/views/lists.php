<div class="bodytop">
	<h1>Groups</h1>
	<a class="pull-right" href="/groups/addgroup">Add New Group</a>
	<?php
	if(($total_count) > 0)
	{
	?>
	<table class="tabulardata" cellpadding="0" cellspacing="0">
		<tr>
			<th>Group Name</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
		<?php
		$i=1;
		foreach($all_groups as $ag)
		{
		?>
		<tr class="<?php echo ($i%2 == 0)?'tablealternate':''; ?>">
			<td><?php echo $ag->name?></td>
			<td><?php echo ($ag->status == 1)?'Active':'Inactive';?></td>
			<td><a href="/groups/editGroup/<?php echo $ag->id?>">Edit</a>
				<a onclick="return confirm('Are you sure to delete?')" href="/groups/deleteGroup/<?php echo $ag->id?>">Delete</a></td>
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

    	<div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title"> Latest Users </div>
                    <a class="pull-right" href="<?php echo site_url('admin/users/list');?>">View All</a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>Name</th>
                                <th>Created Date</th>
                                <th>Status</th>
                                <th>Type</th>
                            </tr>
                            <?php
                            $i=1;
                            foreach($latest_users as $lu)
                            {
                            $date = new DateTime($lu->user_created_date);
							$created_date = $date->format('d/m/Y H:m:s');
							?>
                            <tr class="<?php if($i%2 == 0){ echo 'tablealternate';}?>">
                            <td><?php echo $lu->first_name.' '.$lu->last_name; ?></td>
                            <td><?php echo $created_date;?></td>
                            <td><?php if($lu->user_status == 1){ echo 'Active'; } else { echo 'Inactive'; }?></td>
                            <td><?php if($lu->user_type == 1){ echo 'Guest';} else{ echo 'Buyer';}?></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
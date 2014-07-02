	<div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title"> Latest Bookings </div>
                    <a class="pull-right" href="<?php echo site_url('admin/booking/list');?>">View All</a>
                </div>
                <div class="panel-body">
                <?php
                if(count($latest_booking) > 0)
                {
                ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                            	<th>Property</th>
                                <th>Owner</th>
                                <th>Guest Name</th>
                                <th>Check-In</th>
                                <th>Check-Out</th>
                                <th>Status</th>
                            </tr>
                            <?php
                            $i=1;
							if ($latest_booking){
                            foreach($latest_booking as $lb)
                            {
                                $date = new DateTime($lb->end_date);
                                $date->modify('+1 day');
								$date1 = new DateTime($lb->start_date);
								$start_date = $date1->format('d/m/Y');
                                $end_date = $date->format('d/m/Y');
								$this->load->model('dashboard/dashboard_model');
                                $ownerx = $this->dashboard_model->getUserInfo($lb->owner_id);
                            ?>
                            <tr class="<?php echo ($i%2 == 0)?'tablealternate':''; ?>">
                            	<td><?php echo $lb->prop_name;?></td>
                                <td><?php echo $ownerx->first_name.' '.$ownerx->last_name;?></td>
                                <td><?php echo $lb->fname.' '.$lb->lname;?></td>
                                <td><?php echo $start_date;?></td>
                                <td><?php echo $end_date;?></td>
                                <td>Booked</td>
                            </tr>
                            <?php
                            $i++;}}else{?>
								<tr><td colspan="6">No booking</td></tr>
							<?php } ?>
                        </table>
                    </div>
                <?php
                }
                else
                {
                    echo 'No Booking';
                }
                ?>
                </div>
            </div>
        </div>
    </div>

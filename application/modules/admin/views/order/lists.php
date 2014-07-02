    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title"> All Bookings </div>
                </div>
                <div class="panel-body">
                <?php
                if($total_count > 0)
                {
                ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>SN</th>
                                <th>Property</th>
                                <th>Owner</th>
                                <th>Guest Name</th>
                                <th>Check-In</th>
                                <th>Check-Out</th>
                                <th>Status</th>
                            </tr>
                            <?php
                            $i=1;
                            foreach($all_bookings as $lb)
                            {
							$start_date = new DateTime($lb->start_date);
                            $starting_date = $start_date->format('d/m/d');
                            $date = new DateTime($lb->end_date);
                            $date->modify('+1 day');
                            $end_date = $date->format('d/m/d');
							$this->load->model('order/order_model');
                            $ownerx = $this->order_model->getUserInfo($lb->owner_id);
                            ?>
                            <tr class="<?php echo ($i%2 == 0)?'tablealternate':''; ?>">
                                <td><?php echo $i;?></td>
                                <td><?php echo $lb->prop_name;?></td>
                                <td><?php echo $ownerx->first_name.' '.$ownerx->last_name;?></td>
                                <td><?php echo $lb->fname.' '.$lb->lname;?></td>
                                <td><?php echo $starting_date;?></td>
                                <td><?php echo $end_date;?></td>
                                <td>Booked</td>
                            </tr>
                            <?php
                            $i++;}
                            ?>
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

    
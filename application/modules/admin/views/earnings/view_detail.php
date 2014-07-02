<div class="bodytop">    
    <h1>Total financial transaction for the month of <?php echo $month . ' ' . $year; ?> of <?php echo $owner_rs->first_name . ' ' . $owner_rs->last_name; ?></h1>   
        <?php if ($count_earning > 0) { ?>   
    <a class="pull-right" href="<?php echo site_url('earnings/exportphpexcelbyowner/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$this->uri->segment(5));?>">Export in MS Excel</a>
    <table class="tabulardata" cellpadding="0" cellspacing="0">           
        <tr>            	
            <th>SN</th>                
            <th>Property Name</th>                
            <th>Guest</th>                
            <th>Check In</th>                
            <th>Check Out</th>                               
            <th>Total</th>            
        </tr>                        
    <?php $sn = 1;

    $subtotal = 0;

    $total_service_tax = 0;

    $total_price = 0;

    foreach ($current_earning as $ce) {

        $guest_rs = $this->admin_model->getUserInfo($ce->user_id);

        $date = new DateTime($ce->end_date);

        $date->modify('+1 day');

        $end_date = $date->format('Y-m-d'); ?>            
        <tr>                
            <td><?php echo $sn; ?></td>                
            <td><?php echo $ce->prop_name; ?></td>                
            <td>                <?php echo $guest_rs->first_name . ' ' . $guest_rs->last_name; ?>                </td>                
            <td><?php echo $ce->start_date; ?></td>                
            <td><?php echo $end_date; ?></td>                
            <td>                <?php $service_tax = ($service->site_service_tax) * ($ce->total_price) / 100;

        $total_price_withour_st = ($ce->total_price) - $service_tax;

        $total_service_tax += $service_tax;

        $subtotal += $total_price_withour_st;

        echo number_format($total_price_withour_st, 2, '.', '');

        $total_price += $ce->total_price; ?>                
            </td>            
        </tr>            <?php $sn++;

    } ?>            
        <tr>                
            <td>                                    </td>                
            <td>                                    </td>                
            <td>                                    </td>                
            <td>                                    </td>                
            <td>                    Sub Total                </td>                
            <td>                    <?php echo number_format($subtotal, 2, '.', ''); ?>                
            </td>            </tr>            
        <tr>                <td>                                    </td>                
            <td>                                    </td>                
            <td>                                    </td>                
            <td>                                    </td>                
            <td>                    Service Charge( <?php echo $service->site_service_tax; ?> % )                </td>                
            <td>                    <?php echo number_format($total_service_tax, 2, '.', ''); ?>                </td>            
        </tr>            
        <tr>                
            <td>                                    </td>                
            <td>                                    </td>                
            <td>                                    </td>                
            <td>                                    </td>                
            <td>                    Grand Total                </td>                
            <td>                    <?php echo number_format($total_price, 2, '.', ''); ?>                </td>            
        </tr>        
    </table>    <?php } ?>    
    <div class="pagination"><?php echo $links; ?></div>    
</div>
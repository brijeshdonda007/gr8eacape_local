<div class="bodytop">

    <h1>Total financial transaction for the month of <?php if($_POST) { echo date("F", mktime(0, 0, 0, @$month, 10)) . ' ' . @$year; } else { echo date('F').' '.date('Y');}?></h1>

    <div class="filter-by-month">
            <?php

if(($count_earning) > 0)
{
?>
&nbsp;&nbsp;<a href="<?php echo site_url('earnings/exportphpexcel/'.@$month.'/'.@$year);?>">Export in MS Excel</a>
<?php 
}?>
    <form name="filter_by_month" id="filter_by_month" action="<?php echo site_url('admin/earning_filter'); ?>" method="post">

        <select name="month" onchange="this.form.submit()">

            <!--<option value="0">-Select Month-</option>-->

            <?php for($i=1;$i<=12;$i++)

            {?>

            <option value="<?php echo $i;?>" <?php if($_POST) { echo ($this->input->post('month') == $i)?'selected':''; } else { echo (date('m') == $i)?'selected':'' ;}?>><?php echo $this->admin_model->month_name($i);?></option>

            <?php

            }

            ?>

        </select>



        <select name="year" onchange="this.form.submit()">

            <!--<option value="0">-Select Year-</option>-->

            

            <option value="2012" <?php echo ($this->input->post('year') == '2012')?'selected':'';?>>2012</option>

            <option value="2013" <?php if(($this->input->post('year') == '2013') or !($_POST)){ echo 'selected'; }?>>2013</option>

            

        </select>

        <input type="hidden" name="filter_transaction" value="1" />

    </form>

</div>


    <?php if ($count_earning > 0) { ?>    	
    <table class="tabulardata" cellpadding="0" cellspacing="0">

         <tr>

             <th>SN</th>

             <th>Owner</th>

             <th>Total</th>

             <th>10% Service Fee</th>

             <th>Grand Total</th>                <th></th>            </tr>            <?php

    $sn = 1;

    $total1 = 0;

    $total2 = 0;

    $total3 = 0;

    foreach ($current_earning as $ce) {

 ?>            <tr>                
             <td><?php echo $sn; ?></td>                
             <td><?php echo $ce->fname . ' ' . $ce->lname; ?></td>                
             <td><?php echo number_format($ce->sum_price, 2, '.', ''); ?></td>                                
             <td><?php $total = ($service->site_service_tax) * ($ce->sum_price) / 100;

                echo number_format($total, 2, '.', ''); ?></td>                
             <td><?php $grand_total = ($ce->sum_price) - ($total);

                echo number_format($grand_total, 2, '.', ''); ?>                
             </td>                
             <td><a href="<?php echo site_url('admin/earning_detail/'.@$month.'/'.@$year .'/'.$ce->bowner_id); ?>">View Detail</a></td>                <?php

                $total1 += $ce->sum_price;

                $total2 += $total;

                $total3 += $grand_total;

?>            </tr>            <?php $sn++;

            } ?>            <tr>                <td></td>                <td></td>                <td><?php echo number_format($total1, 2, '.', ''); ?></td>                <td><?php echo number_format($total2, 2, '.', ''); ?></td>                <td><?php echo number_format($total3, 2, '.', ''); ?></td>            </tr>        </table>    <?php } ?>    <div class="pagination"><?php echo $links; ?></div>    </div>
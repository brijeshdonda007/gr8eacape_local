<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Untitled Document</title>

<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>

<style>

body{width:600px; margin:0 auto; font-family: 'Abel', sans-serif; font-size:10px;}

.topdec{ width:100%;}

.header{}

.logo{float:left; margin-top:5px;}

.companyAddress{float:left; margin:45px 0 0 25px;}

.invoice{float:left; margin:35px 0 0 400px;}

.invoice span{display:block;}

.invoice span.gst{font-size:12px;}

.invoice span.invoiceNo{font-size:20px;}

.invoice span.date{font-size:12px;}

.address{ font-size:12px; margin-bottom:35px; margin-top:25px;}

.address div{float:left}

.address .to{text-align:right; margin-left:15px;}

.address .recepient{margin-left:10px;}

.tabled{width:100%; text-align:left; font-size:12px; margin-top:30px;}

.tabled table.tables{border-radius:4px;}

.tabled table tbody td{border-top:none !important;}

.tabled table td{border-top:1px solid #ed316c; border-left:1px solid #ed316c;}

.tabled table td:last-child{ border-right:1px solid #ed316c;}

.tabled table{ border-bottom:1px solid #ed316c;}

.tabled thead{background:#ed316c; border-radius:4px 4px 0 0; -moz-border-radius:4px 4px 0 0; -webkit-border-radius:4px 4px 0 0; color:#fff;}

.tabled tbody{padding-bottom:250px;}

.tabled thead th, .tabled tbody td, .tabled tfoot td{padding:10px 0 10px 10px;}

.tabled tbody tr:last-child{border-bottom:1px solid #ed316c;}

.tabled thead .bookingCode{width:15%;}

.tabled thead .summary{width:55%;}

.tabled thead .rate{width:15%;}

.tabled thead .amount{width:15%;}

.grandTotal{font-size:18px; font-weight:600;}

.note{font-size:8px; margin-top:15px; height:150px;}

.footer{ margin-top:100px;}

.footer .footleft{float:left;}

.footer .footright{float:right; opacity:0.4;}

.clear{clear:both}

</style>

</head>



<body>

<?php

$gstp = (15/100) * ($pdf_download->total_price);

$gst_amt = ($pdf_download->total_price) + $gstp;



//$ccfp = (3/100) * $gst_amt;

//$grand_total = $gst_amt + $ccfp;
$grand_total = $gst_amt;



$date = new DateTime($pdf_download->end_date);

$date->modify('+1 day');

$end_date = $date->format('Y-m-d');

?>



    <div class="topdec">

    	<table cellpadding="0" cellspacing="0" width="100%">

        	<tbody>

            	<tr><td colspan="3"><img src="<?php echo base_url();?>assets/frontend/images/headerTop-line.jpg" /></td></tr>

                <tr>

                	<td width="33%"><img width="112" height="80" src="<?php echo base_url();?>assets/frontend/images/logo-invoice.jpg" /></td>

                    <td class="companyAddress" width="33%">

                    	Gr8 Escapes Limited<br />

                        PO BOX 133338<br />

                        EASTRIDGE<br />

                        Auckland<br />

                        NZ

                    </td>

                    <td width="33%" class="invoice">

                    	<span class="gst">GST: 12-345-678</span>

                        <span class="invoiceNo">Invoice # 1234</span>

                        <span class="date">1st January 2013</span>

                    </td>

                </tr>

                <tr>

                    <td class="address" colspan="3">

                    	To,<br />

                    	Mark Bower<br />

                        1 Driveway Avenue<br />

                        Along the Road,<br />

                        Auckland, NZ 90210<br />

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

    <div class="tabled">

    	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="tables">

        <thead>

            <tr>

            	<th class="bookingCode">Booking Reference No.</th>

                <th class="summary">Summary</th>

                <th class="rate">Rate</th>

                <th class="amount">Amount</th>

            </tr>

        </thead>

        

        <tbody>

            <tr>

            	<td><?php echo $pdf_download->reference ?></td>

                <td><?php echo $pdf_download->prop_name ?></td>

                <td><?php echo number_format($pdf_download->total_price, 2, '.', '') ?></td>

                <td><?php echo number_format($pdf_download->total_price, 2, '.', '') ?></td>

            </tr>

            

            <tr style="height:200px !important;">

            	<td></td>

                <td></td>

                <td></td>

                <td></td>

            </tr>

        </tbody>

            <tfoot>

        	<tr>

            	<td colspan="2"></td>

            	<td>Sub Total</td>

                <td><?php echo number_format($pdf_download->total_price, 2, '.', '');?></td>

            </tr>

            <tr>

            	<td colspan="2"></td>

            	<td>15% GST</td>

                <td>NZ <?php echo number_format($gstp, 2, '.', '');?></td>

            </tr>

            <!--<tr>

            	<td colspan="2"></td>

            	<td>3% C.C Charge</td>

                <td>NZ <?php echo number_format($ccfp, 2, '.', '');?></td>

            </tr>-->

            <tr class="grandTotal">

            	<td colspan="2"></td>

            	<td>Grand Total</td>

                <td>NZ <?php echo number_format($grand_total, 2, '.', '');?></td>

            </tr>

        </tfoot>

        </table>

        <span class="note">NOTE : Please make the payment within X days from invoice date.</span>

    </div>

    <div class="footer">

    	<div class="footleft">Thank you for using GR8 Escapes.<br />Gr8 Escapes Limited, PO BOX 133338, EASTRIDGE, Auckland NZ</div>

        <div class="footright"><img src="<?php echo base_url();?>assets/frontend/images/logo-invoice-small.jpg" /></div>

    </div>

</div>

</body>

</html>




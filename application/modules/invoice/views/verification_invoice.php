<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Gr8escapes</title>
    </head>

    <body style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px;">
        <table width="532" border="0" cellspacing="0" cellpadding="0" align="center">
            <tr>
                <td  colspan="4" style="padding:0 30px; height:81px; background:url("<?php echo base_url() ?>assets/frontend/images/header_bg.png") center no-repeat; " valign="top";>
                    <table width="595%" border="0" cellspacing="0" cellpadding="0">
                        <tr >
                            <td width="78%">&nbsp;</td>
                            <td width="22%">&nbsp;</td>
                        </tr>
                        <tr>
                            <td height="54"><h2>Invoice</h2></td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <th >Booking Code</th>
                <th >Summary</th>
                <th >Rate</th>
                <th >Amount</th>
            </tr>
            <tr>
                <td>123-456</td>
                <td><?php echo $pdf_download->prop_name;?></td>
                <td><?php echo number_format($pdf_download->total_amount, 2, '.', '');?></td>
                <td><?php echo number_format($pdf_download->total_amount, 2, '.', '');?></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td>Grand Total</td>
                <td>NZ <?php echo number_format($grand_total, 2, '.', '');?></td>
            </tr>
            <tr>
                <td align="center"  style="padding:0 30px;"><img src="<?php echo base_url() ?>assets/frontend/images/footer.png" width="532" height="53" /></td>
            </tr>
        </table>
    </body>
</html>
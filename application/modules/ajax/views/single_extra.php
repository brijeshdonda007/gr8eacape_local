<!--<option value="0">Select</option>-->
<?php
$a = 0;
while ($a <= 10) {
?>
	<option value="<?php echo $a;?>" <?php echo ($fieldx == $a)?'selected':'';?>><?php echo ($a==0)?'None':$a;?></option>
<?php
$a++; }
?>
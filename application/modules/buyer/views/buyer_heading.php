<div class="userBanner">

<div class="wrapper clearfix">

<div class="pull-left span6">

	<div class="userprofileName"> <span>Welcome</span><br />

        <?php echo $buyer_detail->first_name . ' ' . $buyer_detail->last_name;?><br />

        <a href="#">Member Since: <?php echo date('d-m-Y', strtotime($buyer_detail->user_created_date));?></a> </div>

</div>

</div>

</div>
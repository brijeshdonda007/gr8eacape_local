<div class="bodytop">
    <h1>Property Detail</h1>
   <?php if (empty($detail)){ ?>
   <h3>No detail to display.</h3>
	<?php } else { ?>
	<table class="tabulardata" cellpadding="0" cellspacing="0">
        <tr>
            <td>Title:</td>
            <td><?php echo $detail->title;?></td>
        </tr>
        <tr>
            <td>Featured Image:</td>
            <td><img src="<?php echo base_url();?>images/property_img/featured/thumb/<?php echo $detail->featured_image;?>" /></td>
        </tr>
        <tr>
            <td>Country</td>
            <td><?php echo $detail->country_name;?></td>
        </tr>
        <tr>
            <td>Region</td>
            <td><?php echo $detail->region_name;?></td>
        </tr>
        <tr>
            <td>City</td>
            <td><?php echo $detail->city_name;?></td>
        </tr>
        <tr>
            <td>Suburb</td>
            <td><?php echo $detail->suburb_name;?></td>
        </tr>
        <tr>
            <td>Status</td>
            <td>
                <?php //echo $detail->admin_action;?>
                <?php echo $detail->admin_action;?>
            </td>
        </tr>
        <tr>
            <td>Owner Name</td>
            <td><a href="<?php echo site_url('owner/detail/'.$detail->user_id);?>" ><?php echo $detail->first_name;?></a></td>
        </tr>
        <tr>
            <td>Owner Profile</td>
            <td><a href="<?php echo site_url('owner/detail/'.$detail->user_id);?>" ><img src="<?php echo base_url();?>images/profile_img/thumb/<?php echo $detail->profile_picture;?>" /></a></td>
        </tr>
        <tr>
            <td>Detail</td>
            <td><?php echo $detail->detail;?></td>
        </tr>
        <tr>
            <td>amenities</td>
            <td><?php echo $detail->amenities;?></td>
        </tr>
        <tr>
            <td>Terms and conditions</td>
            <td><?php echo $detail->termsncondition;?></td>
        </tr>
        <tr>
            <td>Price per night</td>
            <td><?php echo $detail->price_night;?></td>
        </tr>
        <tr>
            <td>Price per week</td>
            <td><?php echo $detail->price_week;?></td>
        </tr>
        <tr>
            <td>Price per month</td>
            <td><?php echo $detail->price_month;?></td>
        </tr>
        <tr>
            <td>Added On</td>
            <td><?php echo $detail->created_date;?></td>
        </tr>
        <tr>
            <td>Guest Capacity</td>
            <td><?php echo $detail->guest_capacity;?></td>
        </tr>
        <tr>
            <td>Bedroom</td>
            <td><?php echo $detail->bedroom;?></td>
        </tr>
        <tr>
            <td>Bathroom</td>
            <td><?php echo $detail->bathroom;?></td>
        </tr>
        <tr>
            <td>Adult</td>
            <td><?php echo $detail->adult;?></td>
        </tr>
        <tr>
            <td>Children</td>
            <td><?php echo $detail->children;?></td>
        </tr>
    </table>
    <?php } ?>
</div>
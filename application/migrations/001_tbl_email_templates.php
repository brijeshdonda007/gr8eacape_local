<?php
/**
 * Class Migration_Tbl_email_templates
 *
 * This is two add two new vars to email templates $bond and $cleaning
 *
 * @author Sajjad Saleem <sajjad.saleem@hotmail.com>
 */
class Migration_Tbl_email_templates extends CI_Migration
{

	public function up()
	{
            //booking_email_to_buyer
            $migrationQuery = "UPDATE `dev_website`.`tbl_email_template` SET `content` = '<p>
            &nbsp;</p>
            <h2>
             Dear $buyer_name,</h2>
            <p>
             &nbsp;</p>
            <p>
             You have requested for $title. The details are as following</p>
            <p>
             Property: $title</p>
            <p>
             Check In: $start_date</p>
            <p>
             Check Out: $end_date</p>
            <p>
             Total Booked Days: $booked_days</p>
            <p>
             No. of Guests: $no_of_guests</p>
            <p>
             Bond: $bond</p>
            <p>
             Cleaning: $cleaning</p>
            <p>
             Total Price: $total_price</p>
            <p>
             &nbsp;</p>
            <h2 class=\"italic\">
             The team at Gr8 Escapes</h2>
            ' WHERE `tbl_email_template`.`id` = 3;
            ";

            //Run the query
            mysql_query($migrationQuery);
            
            //booking_direct_email_to_buyer
            $migrationQuery = "UPDATE `dev_website`.`tbl_email_template` SET `content` = '<p>
                &nbsp;</p>
               <h2>
                Dear $buyer_name,</h2>
               <p>
                &nbsp;</p>
               <p>
                You have booked for $title. The details are as following</p>
               <p>
                Property: $title</p>
               <p>
                Check In: $start_date</p>
               <p>
                Check Out: $end_date</p>
               <p>
                Total Booked Days: $booked_days</p>
               <p>
                No. of Guests: $no_of_guests</p>
               <p>
                Bond: $bond</p>
               <p>
                Cleaning: $cleaning</p>
               <p>
                Total Price: $total_price</p>
               <p>
                &nbsp;</p>
               <h2 class=\"italic\">
                The team at Gr8 Escapes</h2>
               ' WHERE `tbl_email_template`.`id` = 4
            ";

            //Run the query
            mysql_query($migrationQuery);
            
            //booking_email_to_owner
            $migrationQuery = "UPDATE `dev_website`.`tbl_email_template` SET `content` = '<p>
                    &nbsp;</p>
                   <h2>
                    Dear $owner_name,</h2>
                   <p>
                    &nbsp;</p>
                   <p>
                    You have got the booking request for $title. The details are as following</p>
                   <p>
                    Property: $title</p>
                   <p>
                    Check In: $start_date</p>
                   <p>
                    Check Out: $end_date</p>
                   <p>
                    Total Booked Days: $booked_days</p>
                   <p>
                    No. of Guests: $no_of_guests</p>
                   <p>
                    Bond: $bond</p>
                   <p>
                    Cleaning: $cleaning</p>
                   <p>
                    Total Price: $total_price</p>
                   <p>
                    &nbsp;</p>
                   <h2 class=\"italic\">
                    The team at Gr8 Escapes</h2>
                   ' WHERE `tbl_email_template`.`id` = 5;
            ";

            //Run the query
            mysql_query($migrationQuery);
            
            
            //booking_direct_email_to_owner
            $migrationQuery = "UPDATE `dev_website`.`tbl_email_template` SET `content` = '<p>
                    &nbsp;</p>
                   <h2>
                    Dear $owner_name,</h2>
                   <p>
                    &nbsp;</p>
                   <p>
                    You have got the booking for $title. The details are as following</p>
                   <p>
                    Property: $title</p>
                   <p>
                    Check In: $start_date</p>
                   <p>
                    Check Out: $end_date</p>
                   <p>
                    Total Booked Days: $booked_days</p>
                   <p>
                    No. of Guests: $no_of_guests</p>
                   <p>
                    Bond: $bond</p>
                   <p>
                    Cleaning: $cleaning</p>
                   <p>
                    Total Price: $total_price</p>
                   <p>
                    &nbsp;</p>
                   <h2 class=\"italic\">
                    The team at Gr8 Escapes</h2>
                   ' WHERE `tbl_email_template`.`id` = 6
            ";

            //Run the query
            mysql_query($migrationQuery);
    }

	public function down()
    {
    }
}
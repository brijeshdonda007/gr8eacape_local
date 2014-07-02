<?php
/**
 * Class Migration_Tbl_email_templates
 *
 * This is to insert a new email template, preconfirmation email
 *
 * @author Sajjad Saleem <sajjad.saleem@hotmail.com>
 */
class Migration_Tbl_email_templates_two extends CI_Migration
{

	public function up()
	{
            //pre_confirmation_email
            $migrationQuery = "INSERT INTO `dev_website`.`tbl_email_template` (`id`, `name`, `content`) VALUES (NULL, 'post_confirmation_email', '<p>
                &nbsp;</p>
                <h2>
                 Dear $buyer_name,</h2>
                <p>
                 &nbsp;</p>
                <p>
                This email is an automatic email to let you know that your booking has been confirmrd for the following:</p>
                <p>
                 Escape Owner Name: $owner_name</p>
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
                 The team at Gr8 Escapes</h2>')
            ";

            //Run the query
            mysql_query($migrationQuery);
    }

	public function down()
    {
    }
}
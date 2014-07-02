<html>
    <style>
        body,a {font-size:18px;
                margin:0;
                font-family:Arial;
        }

        a{font-weight:normal;
        }
        .italic{font-style:italic;
        }
        p{font-size:20px;font-weight:700;color:#1194B2;margin:5px 0;
        }
        .normal{font-weight:normal;
        }
        h2{color:#EF3873;margin:5px 0;
        }
        .content{background-image:url(http://gr8escapes.com/assets/frontend/images/email_template_header.png);
            background-repeat:no-repeat;
            width:900px;
            margin:0 auto;
            padding-top:200px;}
        .footer{background-image:url(http://gr8escapes.com/assets/frontend/images/email_template_footer.png);
            background-repeat:no-repeat;
            width:900px;
            margin:0 auto;                                                                                                                                                                                             height:105px;}
        .text{margin:0 70px;
        }
    </style>
    <body>
        <div>
            <div class="content">
                <div class="text">
                    <p><h2>Dear <?php echo $user_profile_info->first_name . ' ' . $user_profile_info->last_name ?>,</h2></p>
		            <p> This email is an automatic email to let you know that we have received your pre confirmed booking for the following:</p><br/>

                    <pre>
                        Reference No: <?php echo $booking_data['reference'] ?>.
                        Escape Owner Name: <a href="<?php echo base_url() . 'owner/detail/' . $owner_info->id ?>" ><?php echo $owner_info->first_name . ' ' . $owner_info->last_name ?></a>.
                        Number of Guests: <?php echo $booking_data['no_of_guests'] ?>.
                        <?php echo (empty($escapeDetails->bond_amount))? '': 'Bond Amount: ' . $escapeDetails->bond_amount ?>
                        <?php echo (empty($escapeDetails->cleaning_amount))? '': 'Cleaning Amount: ' . $escapeDetails->cleaning_amount ?>
                        Total Amount: <?php echo totalCalc($booking_data['no_of_guests'],
                                                 $escapeDetails->cleaning_amount,
                                                 $escapeDetails->bond_amount) ?>
                    </pre>

		            <p><h2 class="italic">The team at Gr8 Escapes</h2></p>
		        </div>
            </div>
		    <div class="footer" style="position:relative;">
		            <a href="http://gr8escapes.com" style="position:relative;top:50px;margin-left: 72px;color: white;">www.gr8escapes.com</a>
		            <a href="http://facebook.com/Gr8Escapes" style="position:relative;top:50px;margin-left: 110px;color: white;">www.facebook.com/Gr8Escapes</a>
		            <a href="https://twitter.com/gr8_escapes" style="position:relative;top:50px;margin-left: 125px;color: white;">Gr8_Escapes</a>
		    </div>
        </div>
    </body>
</html>

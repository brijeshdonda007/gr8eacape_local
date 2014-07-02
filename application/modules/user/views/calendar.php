	<style type="text/css">

		.calendar-owner {

			font-family: Arial; font-size: 12px;

		}

		table.calendar-owner {

			margin: auto; border-collapse: collapse;

		}

		.calendar-owner .days td {

			width: 80px; height: 80px; padding: 4px;

			border: 1px solid #999;

			vertical-align: top;

			background-color: #DEF;

		}

		.calendar-owner .days td:hover {

			background-color: #FFF;

		}

		.calendar-owner .highlight {

			font-weight: bold; color: #00F;

		}

	</style>

        <div id="ajax-calendar">

	<?php echo $calendar; ?>

        </div>

	<script type="text/javascript">

	$(document).ready(function() {



                $('#calender-prev').click(function(e) {

                e.preventDefault();



                $.ajax({

                  type: 'get',

                  url: '<?php echo base_url(); ?>usercalendar/display/'+$(this).attr('href')+'/<?php echo $this->uri->segment(3);?>',

                  dataType: 'html',

                  success: function (html) {

                 

                    $('#ajax-calendar').html(html);

                  }

                });

              });

              

               $('#calendar-next').click(function(e) {

                e.preventDefault();



                $.ajax({

                  type: 'get',

                  url: '<?php echo base_url(); ?>usercalendar/display/'+$(this).attr('href')+'/<?php echo $this->uri->segment(3);?>',

                  dataType: 'html',

                  success: function (html) {

                    $('#ajax-calendar').html(html);

                  }

                });

              });

              	});

	</script>

        

        <script type="text/javascript">

         <?php

        $year = date('Y'); 

        $month = date('m');

        $today = date('d/m/Y');

         ?>  

function reserveThisDate(day)

{
    var answer = confirm("Are you sure you want to reserve this day?")
    if (answer){

     if(day < 10)

        {

            var dayf = '0' + day;

        }

        else

        {

            var dayf =  day; 

        }

        var selected_date = dayf + '<?php echo "-".$month."-".$year;?>' ;

        var today = '<?php echo $today;?>';

        if(parseDate(selected_date) < parseDate(today))

            {

                alert('You have choosen passed dates!');

                return false;

            }

            else

            {



        

     $.ajax({

                  type: 'get',

                  url: '<?php echo base_url(); ?>usercalendar/reserveDay/<?php echo $year;?>/<?php echo $month;?>/<?php echo $this->uri->segment(3); ?>/' + day,

                  dataType: 'html',

                  success: function (html) {

                 

                    $('#click-date_' + dayf).html(html);

                  }

                });

                }
                }
                else
                {
                return false;
                }

}



function parseDate(str)

{

    var s = str.split(" "),

        d = str[0].split("-")

    return d[2] + d[1] + d[0];

}



</script>

        

   
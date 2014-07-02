	<style type="text/css">

		.calendar {

			font-family: Arial; font-size: 12px;

		}

		table.calendar {

			margin: auto; border-collapse: collapse;

		}

		.calendar .days td {

			width: 80px; height: 80px; padding: 4px;

			border: 1px solid #999;

			vertical-align: top;

			background-color: #DEF;

		}

		.calendar .days td:hover {

			background-color: #FFF;

		}

		.calendar .highlight {

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

                  url: '<?php echo base_url(); ?>mycal/display/'+$(this).attr('href')+'/<?php echo $this->uri->segment(3);?>',

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

                  url: '<?php echo base_url(); ?>mycal/display/'+$(this).attr('href')+'/<?php echo $this->uri->segment(3);?>',

                  dataType: 'html',

                  success: function (html) {

                    $('#ajax-calendar').html(html);

                  }

                });

              });

              	});

	</script>
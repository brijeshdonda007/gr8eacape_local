<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<div class="panel-title"> Escapes </div>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table-striped table-bordered table-hover" id="escape_list" >
						<thead>
						<tr>
							<th> Escape ID </th>
							<th> Escape Name </th>
							<th> Last Name </th>
							<th> First Name </th>
							<th> Status </th>
							<th> Action </th>
						</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
jQuery(document).ready(function() {   
	escapeList();  
});

function escapeList(){
  $('#escape_list').dataTable
          ({
			"aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ -1 ] }],
			"oLanguage": { "oPaginate": {"sPrevious": "", "sNext": ""} },
			"iDisplayLength": 10,
			"bFilter": false,
			"aLengthMenu": [[5, 10, 25, 50, 500], [5, 10, 25, 50, "All"]],
            'bProcessing'    : true,
            'bServerSide'    : true,
			'bDestroy'		 :true,
            'sAjaxSource'    : '<?php echo base_url(); ?>admin/getEscapeList',
            'fnServerData': function(sSource, aoData, fnCallback)
            {
			aoData.push( { "name":"add_row","value":"1" } );
              $.ajax
              ({
                'dataType': 'json',
                'type'    : 'POST',
                'url'     : sSource,
                'data'    : aoData,
                'success' : fnCallback
              });
            },
			"aoColumns": [
				{
					"fnRender": function ( oObj ) {	

						return oObj.aData[0];
					}	
				},		
				{
					"fnRender": function ( oObj ) {	

						return oObj.aData[1];
					}	
				},		
				{
					"fnRender": function ( oObj ) {	

						return oObj.aData[5];
					}	
				},		
				{
					"fnRender": function ( oObj ) {	

						return oObj.aData[4];
					}	
				},			
				{
					"fnRender": function ( oObj ) {	

						return oObj.aData[6];
					}	
				},			
				{
					"fnRender": function ( oObj ) {	
						return '<a class="btn btn-blue btn-xs" href="'+base_url+'admin/getEscapeImages/'+oObj.aData[0]+'" >View Images</a>';
					}	
				},					
			]
          });  
}
</script>
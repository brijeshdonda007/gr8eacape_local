	<div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title"> Faclilties </div>
                    <a class="pull-right btn btn-primary btn-gradient" href="#" onclick="addNewRow();"> Add New </a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table-striped table-bordered table-hover" id="property_facilities_list">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<input type="hidden" id="add_row" value="0"/>
	<input type="hidden" id="add_row_status" value="0"/>
    <script type="text/javascript">
var status = 0;
	
jQuery(document).ready(function() {  
	$('#add_row').val(0); 
	$('#add_row_status').val(0); 
	
	facilitiesDataTable();  
});

function facilitiesDataTable(){
  $('#property_facilities_list').dataTable
          ({
			"aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ -1 ] }],
			"oLanguage": { "oPaginate": {"sPrevious": "", "sNext": ""} },
			"iDisplayLength": 10,
			"aaSorting": [[2,'DESC']],
			"bFilter": false,
			"aLengthMenu": [[5, 10, 25, 50, 500], [5, 10, 25, 50, "All"]],
            'bProcessing'    : true,
            'bServerSide'    : true,
			'bDestroy'		 :true,
            'sAjaxSource'    : '<?php echo base_url(); ?>admin/getPropertiesAmenities',
            'fnServerData': function(sSource, aoData, fnCallback)
            {
			aoData.push( { "name":"add_row","value":$('#add_row').val() } );
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
					status = oObj.aData[2];
					 if(status == 7){
						return '<div><input type="text" id="new_facility_name" placeholder="Add Name" value="" ></div>';
					 }else{
						return '<div class="hide_edit edit_'+oObj.aData[3]+'" style="display:none;"><input type="text" id="facility_name_'+oObj.aData[3]+'" value="'+oObj.aData[0]+'"></div><div class="hide_show show_'+oObj.aData[3]+'">'+oObj.aData[0]+'</div>';
					}
					}
				},
				{
					"fnRender": function ( oObj ) {
			
					if(status == 7){
						return '<div><input type="text"  id="new_facility_desc" placeholder="Add Description" value="" ></div>';
					 }else{		
						return '<div class="hide_edit edit_'+oObj.aData[3]+'" style="display:none;"><input type="text" id="facility_desc_'+oObj.aData[3]+'" value="'+oObj.aData[1]+'"></div><div class="hide_show show_'+oObj.aData[3]+'">'+oObj.aData[1]+'</div>';	
					}
					}
				},
				{
					"fnRender": function ( oObj ) {	
					
					if(status == 7){
						return '<a class="btn btn-orange btn-xs" id="new_disable_status" href="javascript:;" onclick="changeStatus(1);">Disabled</a><a id="new_enable_status" class="btn hide btn-green btn-xs" href="javascript:;" onclick="changeStatus(0);">Enabled</a>';
					 }else{		
					  var category_id =  oObj.aData[3];		
					  if(oObj.aData[2] == 1){
						return '<a class="btn btn-green btn-xs" href="javascript:;" onclick="updateStatus('+category_id+',\''+'status'+'\',0,\''+'tbl_amenities'+'\',\''+'facilitiesDataTable'+'\');">Enabled</a>';
					  }else{
						return '<a class="btn btn-orange btn-xs" href="javascript:;" onclick="updateStatus('+category_id+',\''+'status'+'\',1,\''+'tbl_amenities'+'\',\''+'facilitiesDataTable'+'\');" >Disabled</a>';
					  }
					 } 
					}
				},
				{
					"fnRender": function ( oObj ) { 
					if(status == 7){
						return '<a class="btn btn-blue btn-xs" href="javascript:;" onclick="addNewFacility();" >SAVE</a><a class="btn btn-orange btn-xs" href="javascript:;" onclick="deleteNewRow();" >CANCEL</a>';
					 }else{		
						var category_id =  oObj.aData[3];
						return '<a class="btn btn-blue btn-xs edit_button_show edit_button_'+category_id+'"" href="javascript:;" onclick="showEditText(\''+category_id+'\');" >Edit</a><a class="hide btn btn-blue btn-xs save_button_show save_button_'+category_id+'" href="javascript:;" onclick="savePropertyFacility(\''+category_id+'\');" >SAVE</a> <a class="btn btn-orange btn-xs" href="#" onclick="deleteUpdate('+category_id+',\''+'status'+'\',\''+'tbl_amenities'+'\',\''+'facilitiesDataTable'+'\');">Delete</a>';
					}
					}
				},
			]
          }); 
		  $('#property_facilities_list').removeAttr('style');
}

function showEditText(id){
	$('.hide_edit').hide();
	$('.edit_button_show').removeClass('hide');
	$('.save_button_show').addClass('hide');
	$('.hide_show').show();
	
	
	$('.show_'+id).hide();
	$('.edit_button_'+id).addClass('hide');
	$('.save_button_'+id).removeClass('hide');
	$('.edit_'+id).show();
}

function addNewRow(){
	$('#add_row').val(1);
	facilitiesDataTable();
}

function deleteNewRow(){
	$('#add_row').val(0);
	facilitiesDataTable();
}

function changeStatus(value){
//alert(value);
	if(value == 1){
		$('#add_row_status').val(1);
		$('#new_disable_status').addClass('hide');
		$('#new_enable_status').removeClass('hide');
	}
	if(value == 0){
		$('#add_row_status').val(0);
		$('#new_disable_status').removeClass('hide');
		$('#new_enable_status').addClass('hide');
	}
}

//******************************************************************************//
 </script>
/**
 * Function to delete Category.
 *
 */
function deleteCategory(category_id){
	if(confirm('Are you sure to delete?')){
		$.ajax({
			url: base_url + "admin/deleteCategoryByAdmin",
			type: "post",
			data: {category_id:category_id},
			success: function(data) {
				categoryDataTable();
			}
		});
	}	
}
/**
 * Function to Edit Category Name
 *
 */
function saveEditText(id){
	/* alert(id);
	alert($('#category_name_'+id).val()); */
	var category_id = id;
	var category_title = $('#category_name_'+id).val();
	$.ajax({
		url: base_url + "admin/updateCategoryName",
		type: "post",
		data: {category_id:category_id,category_title:category_title},
		success: function(data) {
			$('#add_row').val(0); 
			$('#add_row_status').val(0); 
			categoryDataTable();
		}
	});
}
/**
 * Function to Edit Property Facilities
 *
 */
function savePropertyFacility(id){
	/*  alert(id);
	alert($('#facility_name_'+id).val()); 
	alert($('#facility_desc_'+id).val());  */
	var id = id;
	var facility_name = $('#facility_name_'+id).val();
	var facility_desc = $('#facility_desc_'+id).val();
	$.ajax({
		url: base_url + "admin/updateFacilities",
		type: "post",
		data: {id:id,facility_name:facility_name,facility_desc:facility_desc},
		success: function(data) {
			$('#add_row').val(0); 
			$('#add_row_status').val(0); 
			facilitiesDataTable();
		}
	});
}
/**
 * Function to delete Category.
 *
 */
function deleteUpdate(id,field_name,table_name,func){
/* alert(id);
alert(field_name);
alert(table_name);
window[func]('66666666'); */
var id = id;
var field_name = field_name;
var table_name = table_name;

 	if(confirm('Are you sure to delete?')){
		$.ajax({
			url: base_url + "admin/deleteUpdate",
			type: "post",
			data: {id:id,field_name:field_name,table_name:table_name},
			success: function(data) {
				window[func]();
			}
		});
	}
} 
/**
 * Function to Edit Property Facilities
 *
 */
function saveTvList(id){
	var id = id;
	var tv_name = $('#tv_name_'+id).val();
	var tv_desc = $('#tv_desc_'+id).val();
	var television_type = $('#tv_category_'+id).val();
	$.ajax({
		url: base_url + "admin/updateSkyTv",
		type: "post",
		data: {id:id,tv_name:tv_name,tv_desc:tv_desc,television_type:television_type},
		success: function(data) {
			$('#add_row').val(0); 
			$('#add_row_status').val(0); 
			skyTv_list();
		}
	});
}

/**
 * Function to UPDATE VALUES OF ANY FIELD IN ANY TABLE
 *
 */
function updateStatus(id,field_name,value,table_name,func){
/* alert(id);
alert(field_name);
alert(value);
alert(table_name); */
var id = id;
var field_name = field_name;
var table_name = table_name;
var value = value;

	$.ajax({
		url: base_url + "admin/updateStatus",
		type: "post",
		data: {id:id,field_name:field_name,table_name:table_name,value:value},
		success: function(data) {
			if(func != ''){
				window[func]();
			}
		}
	});
} 
/**
 * Function to Add New Facility
 *
 */
function addNewFacility(){
/* 
alert($('#new_facility_name').val());
alert($('#new_facility_desc').val());
alert($('#add_row_status').val()); */

var name = $('#new_facility_name').val();
var desc = $('#new_facility_desc').val();
var status = $('#add_row_status').val();
	$.ajax({
		url: base_url + "admin/insertFacilities",
		type: "post",
		data: {name:name,desc:desc,status:status},
		success: function(data) {
			$('#add_row').val(0); 
			$('#add_row_status').val(0); 
			facilitiesDataTable();
		}
	});
}  
/**
 * Function to Add New TV ENTRY
 *
 */
function addNewSkyTv(){
/* 
alert($('#new_tv_name').val());
alert($('#new_tv_desc').val());
alert($('#add_row_status').val());  */

var name = $('#new_tv_name').val();
//var desc = $('#new_tv_desc').val();
var desc = '';
var status = $('#add_row_status').val();
var television_type = $('#tv_category_new').val();
//alert(television_type);
	 $.ajax({
		url: base_url + "admin/insertTvChannel",
		type: "post",
		data: {name:name,desc:desc,status:status,television_type:television_type},
		success: function(data) {
			$('#add_row').val(0); 
			$('#add_row_status').val(0); 
			skyTv_list();
		}
	});
}  
/**
 * Function to Add New Category
 *
 */
function addNewCategory(){
 
/* alert($('#new_category_name').val());
alert($('#add_row_status').val()); */
 var category_name = $('#new_category_name').val();
 var status = $('#add_row_status').val();
	$.ajax({
		url: base_url + "admin/insertCategory",
		type: "post",
		data: {category_name:category_name,status:status},
		success: function(data) {
			$('#add_row').val(0); 
			$('#add_row_status').val(0); 
			categoryDataTable();
		}
	});
} 

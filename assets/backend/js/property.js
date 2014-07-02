// JavaScript Document
function addcategory(urlLink)
{
	 var str = $("#form_category").serialize();
		$.ajax({
				type: "POST",
				url: urlLink,
				data:str,
				success: function(msg){
					
					var deleteCategoryPath =urlpath+'/product/deleteCategory/'+msg;
					var rowCount = $('#category_list_table tr').length;
					$('#category_list_table').append('<tr id="row_'+msg+'"><td>'+rowCount+'</td> <td>'+$("#category").val()+'</td> <td>'+$("#category_descp").val()+'</td> <td><a href="#" onclick="deleteCategory(\''+deleteCategoryPath+'\');">Delete</a></td></tr>');
					$(".system_msg").html("Category added successfully.");
				
				 }
		});
	
	
}
function deleteCategory(urlLink)
{
	if(confirm("Do you want to Delete this Category?"))
	{
		$.ajax({
				type: "POST",
				url: urlLink,
				success: function(msg){
					$('#row_'+msg).remove();
					$(".system_msg").html("Category is Deleted Successfully");
				
				 }
		});
	}
}
function editCategory(urlLink)
{
$.ajax({
				type: "POST",
				url: urlLink,
				success: function(msg){
						var obj = jQuery.parseJSON(msg);
						$("#categoryid").val(obj.id);
						$("#category_title").val(obj.category_title);
						$("#category_status").val(obj.category_status);
						$("#category_description").val(obj.category_description);
				
				 }
		});	
	
}
function deleteProduct(urlLink)
{
	if(confirm("Do you want to Delete this Product?"))
	{
		$.ajax({
				type: "POST",
				url: urlLink,
				success: function(msg){
					$('#row_'+msg).remove();
					$(".system_msg").html("Product Id "+msg+" is Deleted Successfully");
				
				 }
		});
	}
}

function approveByAdmin(urlLink)
{
            $.ajax({
                    type: "POST",
                    url: urlLink,
                    success: function(msg){
                                    var obj = jQuery.parseJSON(msg);
                                    
                                    $('#propid_'+obj.id).text('Approved');
                                    $(".system_msg").html("Property Id "+obj.id+" is approved");

                     }
		});	 
}


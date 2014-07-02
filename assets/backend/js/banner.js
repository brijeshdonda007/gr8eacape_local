// JavaScript Document

function deletebanner(urlLink)
{
	if(confirm("Do you want to Delete this Banner?"))
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


		
function editbannerData(urlLink,path){
		$.ajax({
				type: "POST",
				url: urlLink,
				success: function(msg){
						var obj = jQuery.parseJSON(msg);
						$("#bannerid").val(obj.id);
						$("#title").val(obj.title);
						$(".nicEdit-main").html(obj.detail);
						$("#price").val(obj.price);
						$("#link").val(obj.link);
						$("#upload_product_image").val(obj.Image);						
						$("#banner_img").val(obj.image);											
						$("#upload_image").html("<img src='"+path+"images/banner_img/"+obj.image+"' width='462px' height='125px' />");
						
				 }
		});
	
	
}

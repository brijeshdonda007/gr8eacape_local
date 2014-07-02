function deletePage(urlLink)
{
	if(confirm("Do you want to Delete?"))
	{
		$.ajax({
				type: "POST",
				url: urlLink,
				success: function(msg){
					$('#row_'+msg).remove();
					$(".system_msg").html("Page "+msg+" is Deleted Successfully");
				
				 }
		});
	}
}
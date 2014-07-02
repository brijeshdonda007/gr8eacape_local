<div class="row">
  <div class="col-md-7">
    <div class="panel">
      <div class="panel-heading">
        <div class="panel-title"> <i class="fa fa-pencil"></i> <?php echo @$form_title;?> </div>
      </div>
      <div class="panel-body">
		<div class="col-md-11">
	        <form class="form-horizontal formholder" method="post" id ="formholder" name="formholder" enctype="multipart/form-data" action="<?php echo site_url('admin/updateMenu');?>">
			<input type="hidden" id="menu_id" name="menu_id" value="<?php echo $menu_id;?>" />
	          <div class="form-group">
				<ul class="panel-group accordion margin-top-lg" id="accordion1">
				<?php if (@$menu){ ?>
				<?php foreach ($menu as $mn){ ?>
	                <li class="panel">
					  <input type="hidden" class="item_id" id="item_<?php echo $mn->id;?>" name="item_id[]" value="<?php echo $mn->id;?>" />
	                  <div class="panel-heading">
						<div class="col-md-10">
						<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accord1_<?php echo $mn->id; ?>">
		                    <div class="accordion-toggle-icon"> <i class="fa fa-minus-square-o"></i> <i class="fa fa-plus-square-o"></i> </div>
		                    <div><?php echo $mn->name;?></div>
						</a>
						</div>
						<div class="col-md-2">
							<a href="javascript:void(0);" class="btn btn-danger btn-xs remove_item">Delete</a>
						</div>
					  </div>
	                  <div id="accord1_<?php echo $mn->id; ?>" class="panel-collapse collapse">
	                    <div class="panel-body">
							<div class="form-group">
								<label class="col-md-3 control-label">Menu Name</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="name_<?php echo $mn->id;?>" name="name[]" value="<?php echo $mn->name;?>" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">URL</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="link_<?php echo $mn->id;?>" name="link[]" value="<?php echo $mn->link;?>" />
								</div>
							</div>
						</div>
	                  </div>
	                </li>
				<?php } ?>
				<?php } ?>
				</ul>
	          </div>
	          <div class="form-group">
	            <div class="col-md-1">
	            </div>
	            <div class="col-md-4">
	              <button class="btn btn-success" type="button" id="form_submit">Submit</button>
	            </div>
	          </div>
	        </form>
		</div>
      </div>
    </div>
  </div>
  <div class="col-md-5">
    <div class="panel">
      <div class="panel-heading">
        <div class="panel-title"> <i class="fa fa-pencil"></i> Add new item </div>
      </div>
      <div class="panel-body form-horizontal">
		<div class="form-group">
			<label class="col-md-3 control-label">Name</label>
			<div class="col-md-8">
				<input type="text" class="form-control" id="new_name" value="" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">URL</label>
			<div class="col-md-8">
				<input type="text" class="form-control" id="new_url" value="" />
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-1"></div>
			<div class="col-md-5"><a href="javascript:void(0);" id="add_new_item" class="btn btn-primary">Add to Menu</a></div>
		</div>
	  </div>
	</div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('#accordion1').sortable();
	$('#form_submit').click(function(){
		var order = 1;
		$('#accordion1 li').each(function(){
			$(this).find('.item_sort_num').val(order);
			order ++;
		});
		$('#formholder').submit();
	});
	$('.remove_item').click(function(){
		var parent = $(this).parent().parent().parent();
		parent.remove();
		var item_id = parent.find('.item_id').val();
		/*$.ajax({
			type:'POST',
			url:"<?php echo base_url();?>admin/disable_menu_item",
			data:{item_id:item_id},
			success:function(data){
				parent.remove();
			}
		});*/
	});
	$('#add_new_item').click(function(){
		var new_name = $('#new_name').val();
		var new_url = $('#new_url').val();
		var menu_id = $('#menu_id').val();
		$.ajax({
			type:'POST',
			url:"<?php echo base_url();?>admin/add_new_menu_item",
			data:{menu_id:menu_id, name:new_name, link:new_url},
			success:function(data){
				var html = '<li class="panel">';
					html +=' <input type="hidden" id="item_'+data+'" class="item_id" name="item_id[]" value="'+data+'" />';
	                html +=' <div class="panel-heading">';
					html +='	<div class="col-md-10">';
					html +='	<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accord1_'+data+'">';
		            html +='        <div class="accordion-toggle-icon"> <i class="fa fa-minus-square-o"></i> <i class="fa fa-plus-square-o"></i> </div>';
		            html +='        <div>'+new_name+'</div>';
					html +='	</a>';
					html +='	</div>';
					html +='	<div class="col-md-2">';
					html +='		<a href="javascript:void(0);" class="btn btn-danger btn-xs remove_item">Delete</a>';
					html +='	</div>';
					html +='  </div>';
	                html +='  <div id="accord1_'+data+'" class="panel-collapse collapse">';
	                html +='    <div class="panel-body">';
					html +='		<div class="form-group">';
					html +='			<label class="col-md-3 control-label">Menu Name</label>';
					html +='			<div class="col-md-4">';
					html +='				<input type="text" class="form-control" id="name_'+data+'" name="name[]" value="'+new_name+'" />';
					html +='			</div>';
					html +='		</div>';
					html +='		<div class="form-group">';
					html +='			<label class="col-md-3 control-label">URL</label>';
					html +='			<div class="col-md-8">';
					html +='				<input type="text" class="form-control" id="link_'+data+'" name="link[]" value="'+new_url+'" />';
					html +='			</div>';
					html +='		</div>';
					html +='	</div>';
	                html +='  </div>';
	                html +='</li>';
					$('#accordion1').append(html);
			}
		});
	});
});
</script>
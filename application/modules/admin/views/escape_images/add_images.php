<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<div class="panel-title"> Add Images </div>
				<a class="pull-right btn btn-primary btn-gradient" href="<?php echo $base_url.'admin/getEscapeImages/'.$escape_id; ?>" > Back To Images </a>
			</div>
			<div class="panel-body">			
				<form action="<?php echo $base_url.'admin/uploadEscapeImages' ?>" class="dropzone" id="my-awesome-dropzone">
								<input type="hidden"  name="escape_id" value="<?php echo $escape_id; ?>"/>
				</form>	
			</div>
		</div>
	</div>
</div>

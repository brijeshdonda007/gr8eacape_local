<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <div class="panel-title"> Report Escapes </div>                
            </div>
            <div class="panel-body">
                <form role="form" id="formfilter" action="<?php echo site_url('admin/reports_escapes/filter') ?>" method="post">                  
                	<div class="row">             						
						<div class="form-group col-md-3">
							<label>Country</label>
							<select name='country' id='country' class='form-control'>
								<option value=''>All Countries</option>
								<?php foreach($country as $c): ?>
								<option value='<?php echo $c->id ?>'><?php echo $c->country_name ?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="form-group col-md-3">
							<label>Region</label>
							<div id="ajax-region">
							<select name='region_id' class='form-control' disabled="disabled">
								<option value=''>All Regions</option>
							</select>
							</div>
						</div>
						<div class="form-group col-md-3">
							<label>City</label>
							<div id="ajax-city">
							<select name='city_id' class='form-control' disabled="disabled">
								<option value=''>All Cities</option>
							</select>
							</div>
						</div>
                        <div class="form-group col-md-3">
							<label>Suburb</label>
							<div id="ajax-suburb">
							<select name='suburb_id' class='form-control' disabled="disabled">
								<option value=''>All Suburbs</option>
							</select>
							</div>
						</div>
                 	</div>     
                    <div class="row">      						
						<div class="form-group col-md-3">
							<label>Categories</label>
							<select name='category' class='form-control'>
								<option value=''>All Categories</option>
								<?php foreach($category as $c): ?>
								<option value='<?php echo $c->id ?>'><?php echo $c->country_name ?></option>
								<?php endforeach ?>
							</select>
						</div>
                        <div class="form-group col-md-3">
							<label>Status</label>							
							<select name='status' class='form-control'>
                            <option value=''>All Statuses</option>
							<option value='verified'>Verified</option>
                            <option value='approved'>Approved</option>
                            <option value='pending'>Pending</option>
							</select>
						</div>				
                	</div>	
                    <div class="row"> 
                        <div class="form-group col-md-3">
							<input type="submit" class="btn btn-success" value="Search" />
						</div>	
                    </div>
                </form>
                <hr />                
                <div class="col-md-12 table-responsive">
                    <div class="pull-right">
                    	<a href="<?php echo site_url('admin/reports_escapes/export_csv') ?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-list-alt"></span> .CSV</a>
                    	<a href="<?php echo site_url('admin/reports_escapes/export_pdf') ?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-file"></span> .PDF</a>
                    </div>
                    <div id="datanya">
                	<h4 class="pull-left">&nbsp;</h4>
					<table class="table table-bordered" id="datatable" cellpadding="0" cellspacing="0">
                    	<thead>
                            <tr>
                                <th>No</th>
                                <th>Property Title</th>
                                <th>Owner</th>
                                <th>Added On</th>
                                <th>Status</th>
                            </tr>	
                        </thead>										
                        <tbody>
						<?php if($data_report): $i=0; ?>
                            <?php foreach($data_report as $dt): ?>
                            <tr>
                                <td><?php echo ++$i ?></td>
                                <td><?php echo $dt['title'] ?></td>
                                <td><?php echo $dt['first_name'].' '.$dt['last_name'] ?></td>
                                <td><?php echo $dt['created_date'] ?></td>
                                <td><?php echo $dt['admin_action'] ?></td>
                            </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">No data found.</td>
                            </tr>
                        <?php endif ?>
                        </tbody>
					</table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php $this->load->view('js') ?>

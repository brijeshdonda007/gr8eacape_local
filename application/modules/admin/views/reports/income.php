<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <div class="panel-title"> Report Income </div>                
            </div>
            <div class="panel-body">
                <form role="form" id="formfilter" action="<?php echo site_url('admin/reports_income/filter') ?>" method="post">                  
                	<div class="row">                      						
                        <div class="form-group col-md-3">
							<label>Time Period</label>
							<select name='timetype' class='form-control' onchange="TimeType(this.value)">
								<option value=''>All</option>
								<option value='daily'>Daily</option>
                                <option value='weekly'>Weekly</option>
                                <option value='monthly'>Monthly</option>
                                <option value='yearly'>Yearly</option>
							</select>
						</div>
                        <div class="form-group col-md-3 showdatepick" style="display:none"> 
                        	<style>
							div.monthpick table, div.yearpick table, div.yearpick select.ui-datepicker-month  {display:none;}
							</style>
                            <label>Time Detail</label>
                            <input type="text" name="time" value="" class="form-control datepick" />
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
                    	<a href="<?php echo site_url('admin/reports_income/export_csv') ?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-list-alt"></span> .CSV</a>
                    	<a href="<?php echo site_url('admin/reports_income/export_pdf') ?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-file"></span> .PDF</a>
                    </div>       
                    <div id="datanya">        
                	<h4 class="pull-left">Total Income : <?php echo number_format($total_income['total_price'],2) ?></h4>     
					<table class="table table-bordered" id="datatable" cellpadding="0" cellspacing="0">
                    	<thead>
                            <tr>
                                <th>No</th>
                                <th>Property Title</th>
                                <th>Owner</th>
                                <th>Guest Name</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Price</th>
                            </tr>	
                        </thead>
                        <tbody>					
						<?php if($data_report): $i=0; ?>
                            <?php foreach($data_report as $dt): ?>
                            <tr>
                                <td><?php echo ++$i ?></td>
                                <td><?php echo $dt['title'] ?></td>
                                <td><?php echo $dt['first_name'].' '.$dt['last_name'] ?></td>
                                <td><?php echo $dt['first_gname'].' '.$dt['last_gname'] ?></td>
                                <td><?php echo $dt['start_date'] ?></td>
                                <td><?php echo $dt['end_date'] ?></td>
                                <td class="text-right"><?php echo number_format($dt['total_price'],2) ?></td>
                            </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">No data found.</td>
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
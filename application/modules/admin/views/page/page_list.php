    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title"> Pages List </div>
                    <a class="pull-right btn btn-primary btn-gradient" href="<?php echo site_url('admin/pages/add'); ?>">Add New Page</a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table-striped table-bordered table-hover" id="datatable">
                            <thead>
                            <tr>
                                <!--<th class="sn">S.N</th>-->
                                <th>Page Title</th>
                                <!--<th>Content</th>-->
                                <!--<th>Featured Image</th>-->
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $sn=1; ?>
                                <?php foreach($pages as $page): ?>
                                <tr class="tablealternate" id="row_<?php echo $page->id;?>">
                                    <!--<td>&nbsp;<?php echo @$sn++; ?></td>-->
                                    <td>&nbsp;<?php echo @$page->page_name; ?></td>
                                    <!--<td>&nbsp;<?php echo short_text(@$page->page_description, 80); ?></td>-->
                                    <!--<td>&nbsp;<img src="<?php echo base_url().'images/page_img/'.@$page->page_image; ?>" alt="<?php echo @$page->page_name; ?>" width="60" height="40" /></td>-->
                                    <td>&nbsp;<?php echo $page->status == 1 ? 'Displayed':'Hidden';?></td>
                                    <td><a class="btn btn-blue btn-xs" href="<?php echo site_url('admin/pages/edit');?>/<?php echo $page->id;?>">Edit</a>&nbsp;<a class="btn btn-orange btn-xs" href="#" onclick="deletePage('<?php echo site_url('admin/deletePage');?>/<?php echo $page->id;?>');">Delete</a></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
jQuery(document).ready(function() {    
  $('#datatable').dataTable( {
    "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ -1 ] }],
    "oLanguage": { "oPaginate": {"sPrevious": "", "sNext": ""} },
    "iDisplayLength": 10,
    "aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
  });   
});
</script>
<script language="javascript" src="<?php echo base_url ();?>assets/backend/js/page.js"></script>
<?php 
function short_text($text, $length, $after = ' ..') {
		$content = $text;
		if ( strlen($content) > $length ) {
		$content = substr($content,0,$length);
		$content = strip_tags($content);
		return  $content . $after;
		} else {
		return $content;
		}
	}
?>
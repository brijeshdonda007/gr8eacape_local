<script language="javascript"	src="<?php echo base_url ();?>assets/admin/js/page.js"></script>

<div class="bodytop">

	<h1>Pages List</h1>

    

    <a class="pull-right" href="<?php echo site_url('page/loadform'); ?>">Add New Page</a>

    

    <table class="tabulardata" cellpadding="0" cellspacing="0">

        	<tr>

            	<th class="sn">S.N</th>

                <th>Page Title</th>

                <th>Content</th>

                <th>Featured Image</th>

                <th>Status</th>

                <th>Action</th>

            </tr>

          	<?php $sn=1; ?>

            <?php foreach($pages as $page): ?>

            

            <tr class="tablealternate">

            	<td>&nbsp;<?php echo @$sn++; ?></td>

                <td>&nbsp;<?php echo @$page->page_name; ?></td>

                <td>&nbsp;<?php echo short_text(@$page->page_description, 80); ?></td>

                <td>&nbsp;<img src="<?php echo base_url().'images/page_img/'.@$page->page_image; ?>" alt="<?php echo @$page->page_name; ?>" width="60" height="40" /></td>

                <td>&nbsp;<?php echo $page->status == 1 ? 'Displayed':'Hidden';?></td>

                <td><a href="<?php echo site_url('page/editpage');?>/<?php echo $page->id;?>">Edit</a>&nbsp; | &nbsp;<a href="#" onclick="deletePage('<?php echo site_url('page/deletePage');?>/<?php echo $page->id;?>');">Delete</a></td>

            </tr>

            <?php endforeach; ?>

           

        </table>

</div>



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
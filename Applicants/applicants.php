<?php 
    /*
    Plugin Name: Applicants
    Plugin URI: #
    Description: Plugin for displaying all new applicants
    Author: Katherine Petalio
    Version: 1.0
    Author URI: #
    */
function applicants_admin_actions() {
    //add_menu_page("Applicants", "Applicants", 5, "Applicants", "applicants_admin");
	add_menu_page( 'Applicants', 'Applicants', 'manage_options', 'applicants', 'applicants_admin', '', 27 );
}
add_action('admin_menu', 'applicants_admin_actions');
function applicants_admin(){
	$errMsg = "";
	$getCurrPage = $_GET["paged"];
	if(empty($getCurrPage) || $getCurrPage == 1){
		$start = 0;
		$limit = 10;
	}else{
		$start = ($getCurrPage - 1) * 10;
		$limit = $getCurrPage * 10;
	}
	
	if($_GET["action"] == "delete" &&  $_REQUEST['message'] != ""){
		$name = $_REQUEST['message'];
		foreach ($name as $message){
			//$delete = mysql_query("DELETE FROM `wpf_cf7dbplugin_submits` WHERE `submit_time` = '".$message."'");
			$delete = mysql_query("DELETE FROM `wpf_cf7dbplugin_submits` WHERE `form_name` = 'Application'");
			$errMsg = "<div id=\"message\" class=\"updated below-h2\"><p>Successfully deleted.</p></div>";
		}
	}
	else if($_GET["action"] == "download"){
		//ob_start();
		$getResume = mysql_query("SELECT file, field_value FROM `wpf_cf7dbplugin_submits` WHERE `field_value` = '".$_GET["file"]."' AND `submit_time` = '".$_GET['submit']."' ");
		$fetchResume = mysql_fetch_assoc($getResume);
		
		$filename = $fetchResume['field_value'];
		$filedata = $fetchResume['file'];
		//echo $filename."Filename";
		include "download.php";
		// header("Content-length:". strlen($filedata));
// 		header("Content-disposition: download; filename=".$filename);
        //echo $filedata; 
	}
?>
<style>
a.info 
{ 
    position:relative; 
    z-index:9999; 
	background-color:#ddd; 
    color:#000; 
    text-decoration:none 
} 

a.info:hover {z-index:25; background-color:#ff0} 

a.info span{display: none}

a.info:hover span 
{ 
    display:block; 
    position:absolute; 
    top:2em; left:2em; width:10em; 
    border:1px solid #0cf; 
    background-color:#555; color:#fff; 
} 
.black_overlay{
        display: none;
        position: absolute;
        top: 0%;
        left: 0%;
        width: 100%;
        height: 100%;
        z-index:1001;
        -moz-opacity: 0.8;
        opacity:.80;
        filter: alpha(opacity=80);
    }
    .white_content {
        display: none;
        position: absolute;
        top: 25%;
        left: 25%;
        width: 50%;
        height: 50%;
        padding: 16px;
        border: 5px solid #333;
        background-color: white;
        z-index:1002;
        overflow: auto;
    }
</style>    
<div class="wrap">
	<h2>List of Applicants</h2>
	<?php
		echo $errMsg;
	?>
	<form id="posts-filter" method="POST" action="admin.php?page=applicants&action=delete" style="margin-top:10px;">
	<input id="delete" class="button action" type="submit" value="Delete Selected" name="" style="margin-bottom:10px;">
	<table class="wp-list-table widefat fixed pages">
		<thead>
			<tr>
				<th scope='col' id='cb' class='manage-column column-cb check-column' >
					<label class="screen-reader-text" for="cb-select-all-1">Select All</label>
					<input class="delete-select" type="checkbox" />
				</th>
				<th scope='col' id='name' class='manage-column'  style="">Name</th>
				<th scope='col' id='message' class='manage-column'  style="">Nickname</th>
				<th scope='col' id='email' class='manage-column'  style="">Email</th>
				<th scope='col' id='resume' class='manage-column column-date'  style="">Form</th>
				<th scope='col' id='resume' class='manage-column column-date'  style="">Image</th>
				<th scope='col' id='date' class='manage-column column-date'  style="">Date</th>	
			</tr>
		</thead>
		<tbody id="the-list">
		<?php
			$getCount = mysql_query("SELECT count(*) as num FROM `wpf_cf7dbplugin_submits` WHERE `form_name` = 'Application' AND `field_name`= 'Name'");
			$count = mysql_fetch_assoc($getCount);
			$find = mysql_query("SELECT * FROM `wpf_cf7dbplugin_submits` WHERE `form_name` = 'Application' GROUP BY submit_time LIMIT ".$start.", ".$limit." ");
			while($row = mysql_fetch_assoc($find)){
				$ctr++;
				$getName = mysql_query("SELECT field_value FROM `wpf_cf7dbplugin_submits` WHERE `field_name` = 'Name' AND `submit_time` = '".$row['submit_time']."' ");
				$fetchName = mysql_fetch_assoc($getName);
				$name = $fetchName['field_value'];
				
				$getEmail = mysql_query("SELECT field_value FROM `wpf_cf7dbplugin_submits` WHERE `field_name` = 'Email' AND `submit_time` = '".$row['submit_time']."' ");
				$fetchEmail = mysql_fetch_assoc($getEmail);
				$email = $fetchEmail['field_value'];
				
				$getNickname = mysql_query("SELECT field_value FROM `wpf_cf7dbplugin_submits` WHERE `field_name` = 'Nickname' AND `submit_time` = '".$row['submit_time']."' ");
				$fetchNickname = mysql_fetch_assoc($getNickname);
				$nickname = $fetchNickname['field_value'];
				
				$getResume = mysql_query("SELECT file, field_value FROM `wpf_cf7dbplugin_submits` WHERE `field_name` = 'Resume' AND `submit_time` = '".$row['submit_time']."' ");
				$fetchResume = mysql_fetch_assoc($getResume);
				$resume = $fetchResume['field_value'];
				
				$submit_time = $row['submit_time'];
				$date = date('Y/m/d', $submit_time);
				if($ctr%2 != 0){
					$alternate = "alternate";
				}else{
					$alternate = "";
				}
				$countMsg = strlen($message);
				if($countMsg > 102){
					$message = substr($message, 0, 102)."<a href = \"javascript:void(0)\" onclick = \"document.getElementById('light-".$submit_time."').style.display='block';document.getElementById('fade').style.display='block'\"> View </a> <div id=\"light-".$submit_time."\" class=\"white_content\"><span style=\"font-size:20px\"> Message </span> <div style=\"float:right;\"><a href = \"javascript:void(0)\" onclick = \"document.getElementById('light-".$submit_time."').style.display='none';document.getElementById('fade').style.display='none'\">Close</a></div>
				<div style=\"padding:25px 10px;\">".$message."</div>
				</div>";
				}
				
		?>
			<tr class="type-page status-publish hentry <?php echo $alternate; ?> iedit author-self level-0">
				<td class="check-column" scope="row" style='padding: 5px 10px;'>
					<label class="screen-reader-text" for="cb-select-<?php echo $submit_time; ?>">Select Application</label>
					<input id="cb-select-<?php echo $submit_time; ?>" type="checkbox" value="<?php echo $submit_time; ?>" name="message[]">
				</td>
				<td scope='col' id='name' class=''  style=""><?php echo $name; ?></td>
				<td scope='col' id='message' class=''  style=""><?php echo $nickname; ?></td>
				<td scope='col' id='email' class=''  style=""><?php echo $email; ?></td>
				<td scope='col' id='resume' class=''  style="">
					<!-- <a href="admin.php?page=applicants&action=download&file=<?php echo $resume; ?>&submit=<?php echo $submit_time; ?>"> <?php echo $resume; ?> </a> -->
					<a href="http://flairbureau.com/axa_flair/flairFormPDF.php?email=<?php echo $email; ?>"> View </a>
				</td>
				<td scope='col' id='resume' class=''  style="">
					<a href="admin.php?page=applicants&action=download&file=<?php echo $resume; ?>&submit=<?php echo $submit_time; ?>"> <?php echo $resume; ?> </a>
				</td>
				<td scope='col' id='date' class=''  style=""><?php echo $date; ?></td>	
			</tr>
		<?php
			}
		?>
		</tbody>
		<tfoot>
			<tr>
				<th scope='col' id='cb' class='manage-column column-cb check-column'  style="">
					<label class="screen-reader-text" for="cb-select-all-1">Select All</label>
					<input class="delete-select" type="checkbox" />
				</th>
				<th scope='col' id='name' class='manage-column'  style="">Name</th>
				<th scope='col' id='message' class='manage-column'  style="">Nickname</th>
				<th scope='col' id='email' class='manage-column'  style="">Email</th>
				<th scope='col' id='resume' class='manage-column column-date'  style="">Form</th>
				<th scope='col' id='date' class='manage-column column-date'  style="">Date</th>	
			</tr>
		</tfoot>
	</table>
	</form>
	<div class="tablenav bottom">
		<?php if($count['num'] > 10){?> 
		<div class="tablenav-pages">
			<span class="displaying-num"><?php echo $count['num']; ?> items</span>
			<span class="pagination-links">
				<?php
					$value = $count['num'] / 10;
				
					if ( strpos( $value, "." ) !== false ) {
						$page = floor($count['num'] / 10) + 1;
					}else{
						$page = $count['num'] / 10;
					}
					
					$currPage = $_GET["paged"];
					if($currPage == 1 || empty($currPage)){
						$prev = 1;
						$next = 2;
						$currPage = 1;
					}
					else if($currPage < $page && $currPage != $page){
						$prev = $currPage - 1;
						$next = $currPage + 1;
					}
					else if($currPage == $page){
						$prev = $page - 1;
						$next = $page;
					}
					
					
				?>
				<a class="first-page <?php if($currPage == 1 || empty($currPage)) { echo "disabled"; }?>" href="admin.php?page=applicants" title="Go to the first page">«</a>
				<a class="prev-page <?php if($currPage <= $prev || $currPage == 1 || empty($currPage)){ echo "disabled"; } ?>" href="admin.php?page=applicants&paged=<?php echo $prev; ?>" title="Go to the previous page">‹</a>
				<span class="paging-input">
					<?php echo $currPage; ?> of <span class="total-pages"><?php echo $page; ?> </span>
				</span>
				<a class="next-page  <?php if($currPage >= $next || $currPage == $page ){ echo "disabled"; }?>" href="admin.php?page=applicants&paged=<?php echo $next; ?>" title="Go to the next page">›</a>
				<a class="last-page <?php if($currPage == $page){ echo "disabled"; }?>" href="admin.php?page=applicants&paged=<?php echo $page; ?>" title="Go to the last page">»</a>
			</span>
		</div>
		<?php } ?>
	</div>
</div>
<?php
	//echo $this->scripts();
}

function scripts(){
	?>
	<script>
	// $(".delete-select").click(function(event){
// 		if(this.checked) {
// 		      // Iterate each checkbox
// 		   $(':checkbox').each(function() {
// 		       this.checked = true;
// 		   });
// 		}
// 		else {
// 		   $(':checkbox').each(function() {
// 		       this.checked = false;
// 		   });
// 		}
// 	});
	</script>
	<?php
	
}
?>
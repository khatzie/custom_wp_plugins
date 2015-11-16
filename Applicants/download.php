<?php
// session_start();
// include('../../include/connect.php');
// $file = $_GET['download'];
// $filename = $_GET['path'];
	// header("Content-Type: text/html; charset=iso-8859-1");
// 	header("Pragma: public");
// 	header("Expires: 0"); // set expiration time
// 	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
// 	header("Content-Type: application/force-download");
// 	header("Content-Type: application/octet-stream");
// 	header("Content-Type: application/download");
// 	header("Content-Disposition: attachment; filename=".$filename);
// 	header("Content-Transfer-Encoding: binary");
// 	header("Content-Length: ".strlen($filedata));
// 	readfile("$filedata");
	// exit();
	
	// $filename = "test.docx";
// 	//$mimetype = $row["imageType"];
// 	$filedata = $row["imageData"];
	ob_start();
	header("Content-length:". strlen($filedata));
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");
	header("Content-disposition: download; filename=".$filename);
	echo $filedata;

?>
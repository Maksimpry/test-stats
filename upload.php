<?php
session_start();

require_once 'inc/config.php';
require_once 'inc/functions.php';
include 'inc/class-test.php';
require_once 'inc/connect-db.php';
require_once 'inc/class-user-menager.php';

$um = new TSUserManager($conn);
$loggedIn = $um->isLoggedIn();

$pagetitle = 'Upload';
$error = array('name'=>'', 'file'=>'');

if (!empty($_POST)) {
	$name = $_POST['name'];
	$test = new TSTest($conn);
	$testId = $test->addTest($name, $_SESSION['id']);
	//check file type and extension
	$file = $_FILES['data']['tmp_name'];
	$type = filetype($file);
	$filename = $_FILES['data']['name'];
	$allowed =  array('xls','xlsx');
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	
	if(empty($name) ) {
		$error['name'] = 'Enter test name';
	}
	if(!in_array($ext,$allowed) ) {
		$error['file'] = 'Wrong file extension';
	}
	if ($type != 'file') {
		$error['file'] = 'Wrong file type';
	}
	if (empty($_FILES)) {
		$error['file'] = 'Choose file';
	}
	if (!empty($_FILES['data']['tmp_name']) && empty($error['file']) && empty($error['name'])) {
		require_once 'inc/PHPExcel.php';
		$objPHPExcel = PHPExcel_IOFactory::load($_FILES['data']['tmp_name']);
		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		$test->saveTestResults($sheetData, $testId);
	}
}

include 'view/upload-view.php';

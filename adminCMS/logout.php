<?php 

    $_LEVEL ='../';
    file_exists('config/config.php')?include_once('config/config.php'):die('config/config.php khong ton tai');

    $Session = new Session();
	$Session->finish();
	header ('location:'._ROOT_PATH_ADMIN.'login.php');
	exit();
?>
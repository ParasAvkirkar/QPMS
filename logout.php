<?php

	$session = 'qpms';
    /*session_name($session);*/
    session_set_cookie_params(0);
    session_start();


	session_unset();
	session_destroy();


	header("Location: loginPHPB.php");
	exit();

?>
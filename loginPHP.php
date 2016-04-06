<?php

	/*require_once __DIR__ . '/globals.php';*/

	$session = 'qpms';
	/*session_name($session);*/
	session_set_cookie_params(0);
	session_start();

	$_SESSION["favcolor"] = "green";

	echo "user id = ".$_SESSION["userSession"];

/*	echo "Favorite color is " . $_SESSION["favcolor"] . ".<br>";*/

	/*unregister_GLOBALS();*/


	require_once __DIR__ . '/db_connect.php';

	if(isset($_POST['submit'])){

		$user_name = $_POST['name'];
		$user_pass = $_POST['pass'];

		if($user_name == '' || $user_pass == ''){
			echo "<script>alert('All the fields are mandatory')</script>";
			exit();
		}
		/*$db = new DB_CONNECT();
		$con = $db->connect();*/
		/*$sql = "INSERT INTO users VALUES ('', '".$user_name."', '".$user_college."', '".$user_sem."', '".$user_pass."', '".$user_email."', '".$user_branch."')";*/
		/*echo $sql;*/
		/*$con->query($sql);*/

		$link = mysql_connect("localhost", "root", "");

		$result = mysql_select_db("qpms", $link);

		if(!$result){
			echo mysql_errno($link) . ": " . mysql_error($link). "\n";
		}

		mysql_select_db("qpms", $link);
		$result = mysql_query("SELECT * FROM papers", $link);
		if(!$result){
			echo mysql_errno($link) . ": " . mysql_error($link) . "\n";
		}

		$sql = "SELECT * FROM users WHERE name = '".$user_name."' and password = '".$user_pass."'";
		$result = mysql_query($sql, $link);
		$id = '';
		if($result)
		{
			/*echo "Successful login";*/
			$row = mysql_fetch_assoc($result);
			
			$id = $row['user_id'];
			$_SESSION["userSession"] = $id;
			/*echo "session set ".$_SESSION["userSession"];*/
			header('Location: homePHPB.php');
			exit();
		}
		else{
			echo "<script> alert('Sorry, username and password does not match'); </script>";
			echo "<script>setTimeout(\"location.href = 'login.html';\",1500);</script>";
			exit();
		}
	}
?>
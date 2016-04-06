<?php
	
	$session = 'qpms';
	/*session_name($session);*/
	session_set_cookie_params(0);
	session_start();

	echo "user id = ".$_SESSION["userSession"];
	require_once __DIR__ . '/db_connect.php';
	/*echo $_SESSION["favcolor"]." hie";
	echo $_SESSION["userSession"]." hello";
   */
?> 	
<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript">
	
		
	</script>
	<title>
	</title>
</head>
<body>
	<div >
		<a href="push.php" style"display: box; box-sizing: border-box"><h3>Push</h3></a>
		<a href="browse.php" style"display: box; box-sizing: border-box"><h3>Browse</h3></a>
		<form action="logout.php" method="post" enctype="multipart/form-data">
			<input type="submit" value="Logout" name="logout">
		</form>
	</div>


</body>
</html>

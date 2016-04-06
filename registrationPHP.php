<?php
	require_once __DIR__ . '/db_connect.php';

	if(isset($_POST['submit'])){

		/*echo "submit ";*/

		$user_name = $_POST['name'];
		$user_college = $_POST['collegeOption'];
		$user_branch = $_POST['branchOption'];
		$user_sem = $_POST['curr_sem'];
		$user_email = $_POST['email'];
		$user_pass = $_POST['pass'];

		if($user_name == '' || $user_pass == '' || $user_college == '' || $user_branch == '' || $user_sem == '' || $user_email == ''){
			echo "<script>alert('All the fields are mandatory')</script>";
			header("Location: registrationPHP.php");
			exit();
		}
		$db = new DB_CONNECT();
		$con = $db->connect();
		$sql = "INSERT INTO users VALUES ('', '".$user_name."', '".$user_college."', '".$user_sem."', '".$user_pass."', '".$user_email."', '".$user_branch."')";
		/*echo $sql;*/
		$result = $con->query($sql);
		if(!$result)
		{
			$sql = "SELECT name FROM users WHERE name = '$user_name'";
			$result = $con->query($sql);
			if($result){
				echo "<script> alert('Sorry, choose another User name'); </script>";
				echo "<script>setTimeout(\"location.href = 'registration.html';\",1500);</script>";
				exit();
			}
			$sql = "SELECT email_id FROM users WHERE email_id = '$user_email'";
			$result = $con->query($sql);
			if($result){
				echo "<script> alert('Sorry, choose another Email Id'); </script>";
				echo "<script>setTimeout(\"location.href = 'registration.html';\",1500);</script>";
				exit();
			}
			echo "<script> alert('Sorry, an error occured. Please register again'); </script>";
			echo "<script>setTimeout(\"location.href = 'registration.html';\",1500);</script>";
			exit();
		}

		header("Location: loginPHPB.php");
		exit();


	}
?>

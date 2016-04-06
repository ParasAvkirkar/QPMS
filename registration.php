<html>
	<head>
		<title>Registration Form</title>

	</head>

	<body>
		<form method="post" action="registrationPHP.php">
			<table width="400" border="5" align="center">
				<tr>
					<td colspan="2"><h1>Registration Form</h1></td>
				</tr>
				<tr>
					<td>User Name: </td>
					<td><input type='text' name='name'/></td>
				</tr>
				<tr>
					<td>College Name: </td>
					<!-- <td><input type='text' name='college'/></td> -->
					<td>
						<select name="collegeOption">
							<option value = "Veermata Jijabai Technological Institute">Veermata Jijabai Technological Institute</option>
							<option value = "Sardar Vallabhai Patel Institute">Sardar Vallabhai Patel Institute</option>
							<option value = "College of Engineering Pune">College of Engineering Pune</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Branch Name: </td>
					<!-- <td><input type='text' name='branch'/></td> -->
					<td>
						<select name="branchOption">
							<option value = "Computer Engineering">Computer Engineering</option>
							<option value = "Electronics Engineering">Electronics Engineering</option>
							<option value = "Electronics and Telecommunications Engineering">Electronics and Telecommunications Engineering</option>
							<option value = "Electrical Engineering">Electrical Engineering</option>
							<option value = "Mechanical Engineering">Mechanical Engineering</option>
							<option value = "Civil Engineering">Civil Engineering</option>
							<option value = "Textile Engineering">Textile Engineering</option>
							<option value = "Production Engineering">Production Engineering</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Current Semester: </td>
					<td><input type='text' name='curr_sem'/></td>
				</tr>
				<tr>
					<td>E-mail: </td>
					<td><input type='text' name='email'/></td>
				</tr>
				<tr>
					<td>Password: </td>
					<td><input type='password' name='pass'/></td>
				</tr>

				<tr>
					<td colspan='2' align='center'><input type='submit' name='submit' value='Sign Up'/></td>
				</tr>
			</table>
		</form>
	</body>
</html>
<?php
	require_once __DIR__ . '/db_connect.php';

	if(isset($_POST['submit'])){

		$user_name = $_POST['name'];
		$user_college = $_POST['collegeOption'];
		$user_branch = $_POST['branchOption'];
		$user_sem = $_POST['curr_sem'];
		$user_email = $_POST['email'];
		$user_pass = $_POST['pass'];

		if($user_name == '' || $user_pass == '' || $user_college == '' || $user_branch == '' || $user_sem == '' || $user_email == ''){
			echo "<script>alert('All the fields are mandatory')</script>";
			exit();
		}
		$db = new DB_CONNECT();
		$con = $db->connect();
		$sql = "INSERT INTO users VALUES ('', '".$user_name."', '".$user_college."', '".$user_sem."', '".$user_pass."', '".$user_email."', '".$user_branch."')";
		/*echo $sql;*/
		$result = $con->query($sql);
		if(!$result)
		{
			echo "<script> alert('Sorry, an error occured please register again') </script>";
			exit();
		}

		header("Location: login.php");
		exit();


	}
?>

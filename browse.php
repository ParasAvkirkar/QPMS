<?php
	$session = 'qpms';
	/*session_name($session);*/
	session_set_cookie_params(0);
	session_start();
	  
	echo "user id = ".$_SESSION["userSession"];  
	  
	  require_once __DIR__ . '/db_connect.php';

      if(isset($_POST['submit'])){
            /*echo "lucky";*/
            $user_college = $_POST['collegeOption'];
            $user_branch = $_POST['branchOption'];
            $user_year = $_POST['yearOption'];
            $user_subject = $_POST['subjectOption'];
            $user_examType = $_POST['examOption'];

            /*echo "$user_year date";*/
            
            /*echo "$user_college $user_branch $user_year $user_subject $user_examType";*/


            if($user_branch== '' || $user_subject == '' || $user_college == '' || $user_year == '' || $user_examType == ''){
               echo "<script> alert('All the fields are mandatory') </script>";
               exit();
            }


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
			
			$fetchPaper = "SELECT image_name FROM papers WHERE college_name = '$user_college' AND branch = '$user_branch' AND subject = '$user_subject' AND exam_type = '$user_examType' AND year = $user_year";
			$result = mysql_query($fetchPaper, $link);
			if(!$result){
				echo mysql_errno($link) . ": " . mysql_error($link) . "\n";
			}
          	else{
          		$displayImageNames[] = array();
          		while($row = mysql_fetch_assoc($result)){
          			/*echo $row["image_name"]."<br>";*/
          			$displayImageNames[] = $row["image_name"];
          		}
          		$_SESSION["displayImageNames"] = $displayImageNames;

          		header("Location: display.php");
          		exit();
          	}
            mysql_close($link);

            /*header("Location: browse.php");
            exit();*/

		}else{
               
        }
      
         

   
?>
<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="subjects.js"></script>
	<script type="text/javascript">
	
		function branchChange(){

			/*console.log('branchChange called');*/
			var branchToSubject = getSubjects();
			var elementBranchDropDown = document.getElementById("branchId");
			var elementSubjectDropDown = document.getElementById("subjectId");
			while(elementSubjectDropDown.firstChild){
				elementSubjectDropDown.removeChild(elementSubjectDropDown.firstChild);
			}

			var i = elementBranchDropDown.options[elementBranchDropDown.selectedIndex].value;
			for(var j in branchToSubject[i]){
				var optionTag = document.createElement('option');
				optionTag.value = branchToSubject[i][j];
				optionTag.innerHTML = branchToSubject[i][j];
				elementSubjectDropDown.appendChild(optionTag);
			}
		}

	</script>
	<title>
	</title>
</head>
<body>
	<div>
		<a href="home.php"><h3>Home</h3></a>
		<form action="logout.php" method="post" enctype="multipart/form-data">
			<input type="submit" value="Logout" name="logout">
		</form>
	</div>
<form action="browse.php" method="post" enctype="multipart/form-data">
	<table width="400" border="5" align="center">
		<tr>
			<td colspan="3"><h1>Upload Form</h1></td>
		</tr>
		<tr>
			<td>College: </td>
			<td>
				<select name="collegeOption">
					<option value = "Veermata Jijabai Technological Institute">Veermata Jijabai Technological Institute</option>
					<option value = "Sardar Vallabhai Patel Institute">Sardar Vallabhai Patel Institute</option>
					<option value = "College of Engineering Pune">College of Engineering Pune</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Branch: </td>
			<td>
				<select name="branchOption" onchange="branchChange();" id="branchId">
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
			<td>Subject: </td>
			<td>
				<select name="subjectOption" id="subjectId" onclick="branchChange();">
					<script type="text/javascript">

					</script>
				</select>				
			</td>	
		</tr>
		<tr>
			<td>Year: </td>
			<td>
				<select name="yearOption" id="yearId">
					<script type="text/javascript">
						var elementYearDropDown = document.getElementById("yearId");
						var currentYear = (new Date().getFullYear());
						for(var j = currentYear; j >= 1990; j--){
							var optionTag = document.createElement('option');
							optionTag.value = j;
							optionTag.innerHTML = j;
							elementYearDropDown.appendChild(optionTag);
						}
					</script>
				</select>
			</td>
		</tr>
		<tr>
			<td>Type of exam: </td>
			<td>
				<select name="examOption" id="examTypeId">
					<option value = "In Semester">In Semester</option>
					<option value = "End Semester">End Semester</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Browse:</td>
	    	<td><input type="submit" value="Browse" name="submit"></td>
	    	<?php foreach( $_POST as $key => $val ): ?>
                <input type="hidden" name="<?= htmlspecialchars($key, ENT_COMPAT, 'UTF-8') ?>" value="<?= htmlspecialchars($val, ENT_COMPAT, 'UTF-8') ?>">
        	<?php endforeach; ?>
		</tr>
	</table>
    
</form>

</body>
</html>

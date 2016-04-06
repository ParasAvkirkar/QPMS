<?php
	$session = 'qpms';
	/*session_name($session);*/
	session_set_cookie_params(0);
	session_start();

	echo "user id = ".$_SESSION["userSession"];
	  
	  require_once __DIR__ . '/db_connect.php';
   
     /* function __autoload($Project){
      require_once "projectClass.php";
       }*/

      if(isset($_FILES['f']) && isset($_POST['submit'])){
            /*echo "lucky";*/
            $user_college = $_POST['collegeOption'];
            $user_branch = $_POST['branchOption'];
            $user_year = $_POST['yearOption'];
            $user_subject = $_POST['subjectOption'];
            $user_examType = $_POST['examOption'];
            $user_id = $_SESSION['userSession'];
            
            
            $errors= array();
            $file_name = $_FILES['f']['name'];
            $file_size =$_FILES['f']['size'];
            $file_tmp =$_FILES['f']['tmp_name'];
            $file_type=$_FILES['f']['type'];


            /*echo "$user_branch $user_subject $user_college $user_year $file_name";*/


            if($user_branch== '' || $user_subject == '' || $user_college == '' || $user_year == '' || $user_examType == '' || $user_id == ''){
               echo "<script> alert('All the fields are mandatory') </script>";
               exit();
            }

            if($file_name == ''){
            	echo "<script> alert('Please choose the file') </script>";
            	exit();
            }


            $link = mysql_connect("localhost", "root", "");
			$result = mysql_select_db("qpms", $link);
			if(!$result){
				echo "<script> alert('Sorry an error occured please try later')</script>";
				echo mysql_errno($link) . ": " . mysql_error($link). "\n";
			}

			mysql_select_db("qpms", $link);
			$result = mysql_query("SELECT * FROM papers", $link);
			if(!$result){
				echo "<script> alert('Sorry an error occured please try later')</script>";
				echo mysql_errno($link) . ": " . mysql_error($link) . "\n";
			}

            $insertSql = "INSERT INTO papers VALUES ('', '$user_college', '$user_branch', '$user_subject', '', $user_id, '$user_year', '$user_examType')";

            $result = mysql_query($insertSql, $link);
            if(!$result){
               		
               		echo "<script> alert('Sorry an error occured'); </script>";
            		echo mysql_errno($link) . ": " . mysql_error($link) . "\n";
               		exit();
            }

            $file_ext=strtolower(end(explode('.',$_FILES['f']['name'])));
            $expensions= array("jpeg","jpg","png","pdf");
            if($file_size > 1024*1024*100){
               $errors[]='File size must be less than 100 MB';
            }

            if(empty($errors)==true){

	            $accessIdQuery = "SELECT MAX(paper_id) as paper_id FROM papers";
	            /*$result = $con->query($accessIdQuery);*/
	            $result = mysql_query($accessIdQuery, $link);
	            if(!$result){
		            echo "<script> alert('Sorry an error occured'); </script>";
		            echo mysql_errno($link) . ": " . mysql_error($link) . "\n";
		            exit();
	            }
	            while($row = mysql_fetch_assoc($result)){
		            $id = $row["paper_id"];
		            /*echo $file_name;*/
		            break;
	            }
	             
	            $pos = strrpos($file_name, '.', -2);
	            $image_name = $id.substr($file_name, $pos);
	            /*echo $image_name." imagename";*/
	            /*echo $image_name;*/
	            $updateSql = "UPDATE papers SET image_name = '$image_name' WHERE paper_id = $id";
	            /*echo "id ".$id;*/
	            $result = mysql_query($updateSql, $link);
	            if(!$result){
		            echo "<script> alert('Sorry an error occured please try later')</script>";
					echo mysql_errno($link) . ": " . mysql_error($link) . "\n";
				}

	            move_uploaded_file($file_tmp,'C:\xamm\htdocs\qpms\corlate-free-responsive-business-html-template\uploads\\'.$image_name);
	            mysql_close($link);

	               /*header("Location: push.php");*/
	            exit();
            }else{
               print_r($errors);
            }
      }
      else{
      	
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
<form action="push.php" method="post" enctype="multipart/form-data">
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
			<td>Select image to upload:</td>
	    	<td><input type="file" name="f" id="f"></td>
	    	<td><input type="submit" value="Upload Image" name="submit"></td>
	    	<?php foreach( $_POST as $key => $val ): ?>
                <input type="hidden" name="<?= htmlspecialchars($key, ENT_COMPAT, 'UTF-8') ?>" value="<?= htmlspecialchars($val, ENT_COMPAT, 'UTF-8') ?>">
        	<?php endforeach; ?>
		</tr>

    
</form>

</body>
</html>

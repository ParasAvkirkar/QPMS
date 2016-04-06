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
               echo "<script>setTimeout(\"location.href = 'browse.html';\",1500);</script>";
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

          		header("Location: showPHPB.php");
          		exit();
          	}
            mysql_close($link);

            /*header("Location: browse.php");
            exit();*/

		}else{
               
        }
      
         

   
?>
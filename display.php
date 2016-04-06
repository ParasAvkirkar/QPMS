<?php
	
	session_set_cookie_params(0);
	session_start();

	echo "user id = ".$_SESSION["userSession"];
?>
<!DOCTYPE HTML>
<html>
<head>
	<title></title>
</head>
<body>
	<div>
		<a href="home.php"><h3>Home</h3></a>
		<form action="logout.php" method="post" enctype="multipart/form-data">
			<input type="submit" value="Logout" name="logout">
		</form>
	</div>
	<table align="center" width="1000">
		<?php
			$dir = "uploads/";
			$printTr = 0;
			$isTrBal = 0;
			$displayImageNames = $_SESSION["displayImageNames"];
			/*foreach($displayImageNames as &$i){
				echo $i."<br>";
			}*/
			if($opendir = opendir($dir)){
				$ignoreFirstElementOfArray = TRUE;
				echo "<tr>";
				/*while(($file = readdir($opendir)) !== FALSE){*/
				foreach($displayImageNames as &$i){
					if($ignoreFirstElementOfArray){
						$ignoreFirstElementOfArray = FALSE;
						continue;
					}
					$file = $i;	
					/*echo "file is ".$file;*/
					if($file != "." && $file != ".."){
						echo "<td><a href='$dir/$file' download='$file'><img src = '$dir/$file' width='300' height='300' /></a></td>";
						if($printTr == 0){
							/*echo "<tr>";*/
							$isTrBal = 1;
						}
						if($printTr == 2){
							echo "</tr><tr>";
							$printTr = -1;
							$isTrBal = 0;
						}
						$printTr = $printTr + 1;

					}
				}
				if($isTrBal == 1)
					echo "</tr>";

			}
		?>
	</table>
</body>
</html>
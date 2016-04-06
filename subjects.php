<?php
	function getBranchToSubject(){
		//$branchTosubject = array();
		/*$branchTosubject[0] = array("TCP/IP", "COAM", "DSA");
		$branchTosubject[1] = array("E-CAD", "PMS", "DD");
		$branchTosubject[2] = array("P.COM", "EWT", "SS");
		$branchTosubject[3] = array("EM", "N.A", "S.P.D");
		$branchTosubject[4] = array("THERMO", "FM", "M.P");
		$branchTosubject[5] = array("HYDRAULICS", "SOIL MECHANICS", "STRUCTURAL ANALYSIS");
		$branchTosubject[6] = array("YARN MANUFACTURE", "FABRIC MANUFACTURE", "TEXTILE PHYSICS");
		$branchTosubject[7] = array("TOM", "ELECTRICAL MACHINES", "THERMO AND HEAT ENGINES");
*/

		$branchTosubject = array(

				"Computer Engineering" => array("TCP/IP", "COAM", "DSA"),
				"Electronics Engineering" => array("E-CAD", "PMS", "DD"),
				"Electronics and Telecommunications Engineering" => array("P.COM", "EWT", "SS"),
				"Electrical Engineering" => array("EM", "N.A", "S.P.D"),
				"Mechanical Engineering" => array("THERMO", "FM", "M.P"),
				"Civil Engineering" => array("HYDRAULICS", "SOIL MECHANICS", "STRUCTURAL ANALYSIS"),
				"Textile Engineering" => array("YARN MANUFACTURE", "FABRIC MANUFACTURE", "TEXTILE PHYSICS"),
				"Production Engineering" => array("TOM", "ELECTRICAL MACHINES", "THERMO AND HEAT ENGINES")
			);

		//for($i = 0; $i < count($branchTosubject); $i++){
			echo "<br>";
			
			for($j = 0; $j < count($branchTosubject["Computer Engineering"]); $j++)
				echo $branchTosubject["Computer Engineering"][$j]." <br>";
		//}

		return $branchTosubject;
	}
	getBranchToSubject();
?>
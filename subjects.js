	function getSubjects(){
		var branchToSubject = new Object();
		branchToSubject["Computer Engineering"] = ["TCP/IP", "COAM", "DSA"];
		branchToSubject["Electronics Engineering"] = ["E-CAD", "PMS", "DD"];
		branchToSubject["Electronics and Telecommunications Engineering"] = ["P.COM", "EWT", "SS"];
		branchToSubject["Electrical Engineering"] = ["EM", "N.A", "S.P.D"];
		branchToSubject["Mechanical Engineering"] = ["THERMO", "FM", "M.P"];
		branchToSubject["Civil Engineering"] = ["HYDRAULICS", "SOIL MECHANICS", "STRUCTURAL ANALYSIS"];
		branchToSubject["Textile Engineering"] = ["YARN MANUFACTURE", "FABRIC MANUFACTURE", "TEXTILE PHYSICS"];
		branchToSubject["Production Engineering"] = ["TOM", "ELECTRICAL MACHINES", "THERMO AND HEAT ENGINES"];


		return branchToSubject;
	}

/*	var branchToSubject = getSubjects();
	for(var i in branchToSubject){
		for(var j in branchToSubject[i]){
			console.log('' + branchToSubject[i][j]);
		}
	}

*/
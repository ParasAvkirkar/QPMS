<?php
    $session = 'qpms';
    /*session_name($session);*/
    session_set_cookie_params(0);
    session_start();

    if(isset($_SESSION["userSession"])){
       /* echo "<script> alert('User is logged in') </script>";*/
    }
    else{
        echo "<script> alert('User is not logged in') </script>";
        header("Location: loginPHPB.php");
        exit();
    }
   /* echo "user id = ".$_SESSION["userSession"];*/
      
      require_once __DIR__ . '/db_connect.php';
   
     /* function __autoload($Project){
      require_once "projectClass.php";
       }*/

       /*if(!isset($_FILES['f'])){
            echo "<script> alert('file not set')</script>";
       }

       if(!isset($_POST['submit'])){
            echo "<script> alert('submit not set')</script>";
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

                echo "<script> alert('successful entry');</script>";
                move_uploaded_file($file_tmp,'C:\xamm\htdocs\qpmsGamma\uploads\\'.$image_name);
                
                mysql_close($link);

                /*header("Location: pushPHPB.php");*/
                /*exit();*/
            }else{
               print_r($errors);
            }
      }
      else{
            /*echo "<script> alert('parameters not set');</script>";*/
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Push</title>
    
    <!-- core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
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

</head>

<body>

    <header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-4">
                        <div class="top-number"><p><i class="fa fa-phone-square"></i>  +917506055572</p></div>
                    </div>
                    <div class="col-sm-6 col-xs-8">
                       <div class="social">
                            <ul class="social-share">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li> 
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-skype"></i></a></li>
                            </ul>
                            <div class="search">
                                <form role="form">
                                    <input type="text" class="search-form" autocomplete="off" placeholder="Search">
                                    <i class="fa fa-search"></i>
                                </form>
                           </div>
                       </div>
                    </div>
                </div>
            </div><!--/.container-->
        </div><!--/.top-bar-->

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="homePHPB.php"><img src="images/questionpaper_logo.png" alt="logo"></a>
                </div>
                
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="homePHPB.php">Home</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Services <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="pushPHPB.php">Push</a></li>
                                <li><a href="browsePHPB.php">Browse</a></li>
                            </ul>
                        </li>
                        <li><a href="about-usPHPB.php">About Us</a></li>
                        <li><a href="contact-usPHPB.php">Contact</a></li>                        
                        <li><a href="logout.php">Log Out</a></li> 
                    </ul>
                </div>

                <!--  -->
            </div><!--/.container-->
        </nav><!--/nav-->
    </header><!--/header-->

    
    <section id="contact-page">
        <div class="container">
            <div class="center">        
                <h2>Push</h2>
                <p class="lead">Be a member of learning community.</p>
            </div> 
            <div class="row contact-wrap"> 
                <div class="status alert alert-success" style="display: none"></div>
                <form id="main-contact-form" enctype="multipart/form-data" class="contact-form" name="contact-form" method="post" action="pushPHPB.php">
                    
                    <div class="col-sm-5 col-sm-offset-1">
                        <div class="form-group">
                            <label>College Name </label>
                            <select name="collegeOption" required="required">
                                <option value = "Veermata Jijabai Technological Institute">Veermata Jijabai Technological Institute</option>
                                <option value = "Sardar Vallabhai Patel Institute">Sardar Vallabhai Patel Institute</option>
                                <option value = "College of Engineering Pune">College of Engineering Pune</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Branch Name </label>
                            <select name="branchOption" id="branchId" onclick="branchChange();" onchange="branchChange();" required="required">
                                <option value = "Computer Engineering">Computer Engineering</option>
                                <option value = "Electronics Engineering">Electronics Engineering</option>
                                <option value = "Electronics and Telecommunications Engineering">Electronics and Telecommunications Engineering</option>
                                <option value = "Electrical Engineering">Electrical Engineering</option>
                                <option value = "Mechanical Engineering">Mechanical Engineering</option>
                                <option value = "Civil Engineering">Civil Engineering</option>
                                <option value = "Textile Engineering">Textile Engineering</option>
                                <option value = "Production Engineering">Production Engineering</option>
                        </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Subject Name </label>
                            <select name="subjectOption" id="subjectId" required="required">
                                
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Year </label>
                            <select name="yearOption" id="yearId" required="required">
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
                        </div>

                        <div class="form-group">
                            <label>Exam Type </label>
                            <select name="examOption" id="examTypeId" required="required">
                                <option value = "In Semester">In Semester</option>
                                <option value = "End Semester">End Semester</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label>Select an image to upload </label>
                            <input type="file" name="f" id="f" required="required">
                            <input type="submit" value="Upload Image" name="submit" class="btn btn-primary btn-lg">
                            <?php foreach( $_POST as $key => $val ): ?>
                                <input type="hidden" name="<?= htmlspecialchars($key, ENT_COMPAT, 'UTF-8') ?>" value="<?= htmlspecialchars($val, ENT_COMPAT, 'UTF-8') ?>">
                            <?php endforeach; ?>
                        </div>
                        

                    </div>
                </form> 
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#contact-page-->

    <section id="bottom">
        <div class="container wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Organisation</h3>
                        <ul>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Copyright</a></li>
                            <li><a href="#">Terms of use</a></li>
                            <li><a href="#">Privacy policy</a></li>
                            <li><a href="#">Contact us</a></li>
                        </ul>
                    </div>    
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Support</h3>
                        <ul>
                            <li><a href="#">Faq</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Forum</a></li>
                            <li><a href="#">Documentation</a></li>
                        </ul>
                    </div>    
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Developers</h3>
                        <ul>
                            <li><a href="#">Paras Avkirkar</a></li>
                        </ul>
                    </div>    
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Our Partners</h3>
                        <ul>
                            <li><a href="#">Veermata Jijabai Technological Institute</a></li>
                            <li><a href="#">College of Engineering Pune</a></li>
                            <li><a href="#">Sardar Vallabhai Patel Institute of Technology</a></li>
                        </ul>
                    </div>    
                </div><!--/.col-md-3-->
            </div>
        </div>
    </section><!--/#bottom-->

    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2013 <a target="_blank" href="http://shapebootstrap.net/" title="Free Twitter Bootstrap WordPress Themes and HTML templates">ShapeBootstrap</a>. All Rights Reserved.
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Faq</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->

    
</body>
</html>
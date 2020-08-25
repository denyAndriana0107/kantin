<?php
session_start();
include("../function/connection.php");
extract($_REQUEST);
  if(isset($login))
  {
	$sql=mysqli_query($con,"select * from tbadmin where fld_username='$username' && fld_password='$pswd' ");
    if(mysqli_num_rows($sql))
	{
	 $_SESSION['admin']=$username;
	 
	header('location:dashboard.php');
    	
	}
	else
	{
	$admin_login_error="Invalid Username or Password";	
	}
  }
   
?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
    <title>Admin</title>
		 <link rel="stylesheet" href="../css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="css/animate.css">
		<!-- owl carousel CSS -->
		<link rel="stylesheet" href="../css/owl.carousel.min.css">
		<!-- themify CSS -->
		<link rel="stylesheet" href="../css/themify-icons.css">
		<!-- flaticon CSS -->
		<link rel="stylesheet" href="../css/flaticon.css">
		<!-- font awesome CSS -->
		<link rel="stylesheet" href="../css/magnific-popup.css">
		<!-- swiper CSS -->
		<link rel="stylesheet" href="../css/slick.css">
		<link rel="stylesheet" href="../css/gijgo.min.css">
		<link rel="stylesheet" href="../css/nice-select.css">
		<link rel="stylesheet" href="../css/all.css">
		<!-- style CSS -->
		<link rel="stylesheet" href="../css/style.css">
       
        
		<style>
		ul li{list-style:none;}
		ul li a {color:black; text-decoration:none;}
		ul li a:hover {color:black; text-decoration:none;}
		</style>
</head>
<body>

 <!--::header part start::-->
    <header class="main_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="../index.php"> <img src="../img/logo.png" alt="logo"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item justify-content-end"
                            id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="../index.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="../food_menu.php">Menu</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="../about.php">About</a>
                                </li>
                                
                                
                     
                            </ul>
                        </div>
                       
                    </nav>
                </div>
            </div>
        </div>
    </header>
<br>
<div class="middle" style="  padding:40px; border:1px solid rgba(146,236,184,1.00); margin:0px auto; width:400px;">
       <ul class="nav nav-tabs nabbar_inverse" id="myTab" style="background-color:rgba(146,236,184,1.00);border-radius:10px 10px 10px 10px;" role="tablist">
          <li class="nav-item">
             <a class="nav-link active" id="home-tab" data-toggle="tab" href="#login" role="tab" aria-controls="home" aria-selected="true">Home</a>
          </li>
         
              <a class="nav-link" id="profile-tab" style="color:white;"    aria-controls="profile" aria-selected="false">Welcome Admin</a>
          
       </ul>
	   <br><br>
	   <div class="tab-content" id="myTabContent">
	   <!--login Section-- starts-->
            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="home-tab">
			    <div class="footer" style="color:rgba(146,236,184,1.00);"><?php if(isset($loginmsg)){ echo $loginmsg;}?></div>
			  <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="email">Email address:</label>
                      <input type="text" class="form-control" name="username" id="email" required/>
                    </div>
                   <div class="form-group">
                      <label for="pwd">Password:</label>
                     <input type="password" name="pswd" class="form-control" id="pwd" required/>
                   </div>
 
                  <button type="submit" name="login" style="background-color:rgba(146,236,184,1.00); border:1px solid rgba(146,236,184,1.00);" class="btn btn-primary">LogIn</button>
                  <div class="footer" style="color:red;"><?php if(isset($admin_login_error)) { echo $admin_login_error; }?></div>
                  <div class="footer" style="color:green;"><?php if(isset($_SESSION['pas_update_success'])) { echo $_SESSION['pas_update_success']; }?></div>
			 </form>
			</div>
			<!--login Section-- ends-->
			
			
            
      </div>
	  </div>
	
 		<script src="../js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="../js/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="../js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>


<?php
session_start();
include("../function/connection.php");
extract($_REQUEST);
if(!isset($_SESSION['admin']))
{
	header("location:admin.php");
	
}
else
{
	$admin_username=$_SESSION['admin'];
}
if(isset($logout))
{
	unset ($_SESSION['admin']);
	setcookie('logout','loggedout successfully',time() +5);
	header("location:admin.php");
}
if(isset($delete))
{
	header("location:deletefood.php?id=$delete");
}
if(isset($deleteVendor))
{
	header("location:deleteVendor.php?Vendorid=$deleteVendor");
}
$admin_info=mysqli_query($con,"select * from tbadmin where fld_username='$admin_username'");
$row_admin=mysqli_fetch_array($admin_info);
$user= $row_admin['fld_username'];
$pass= $row_admin['fld_password'];

//update
if(isset($update))
{
if(mysqli_query($con,"update tbadmin set fld_password='$password'"))
{
	//$_SESSION['pas_update_success']="Password Updated Successfully Login with New Password";
    unset ($_SESSION['admin']);
	header("location:admin_info_update.php");
}
else
{
	echo "failed";
}

}
?>
<html>
  <head>
     <title>Admin control panel</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="../js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="../js/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="../js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
	  	</script>
	

		 
	 <script>
			function delRecord(id)
			{
				//alert(id);
				
				var x=confirm("You want to delete this record? All Food Items Of that Vendor Will Also Be Deleted");
				if(x== true)
				{
					
					//document.getElementById("#result").innerHTML="success";
				  window.location.href='deleteVendor.php?Vendorid=' +id;		
				}
				else
				{
					window.location.href='#';
				}
				
			}
		</script>
  
  </head>
  
    
	<body>

	
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  
     <a class="navbar-brand" href="../index.php"> <img src="../img/logo.png" alt="logo"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
    <?php
	if(!empty($admin_username))
	{
	?>
	<a class="navbar-brand" style="color:black; text-decoratio:none;"><i class="far fa-user">Admin</i></a>
	<?php
	}
	?>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
	
      <ul class="navbar-nav ml-auto">
       
		<?php
		if(isset($_SESSION['admin']))
		{
			?>
			<li class="nav-item">
            <a class="nav-link" href="">
		      <form method="post">
			    <button type="submit" name="logout" class="btn btn-outline-success">Log Out</button>
			  </form>
		    </a>
            </li>
			<?php
		}
		
		?>
		
      </ul>
	  
    </div>
	
</nav>
<!--navbar ends-->
<br>
<!--details section-->
 
<div class="container">
       <!--tab heading-->
	<nav class="navbar navbar-expand-lg navbar-light">
<!--		style="background:rgba(146,236,184,1.00);border-radius:10px 10px 10px 10px;"-->
		<div class="col-lg-12 rounded navbar-light">
			<ul class="nav nav-tabs navbar-dark" id="myTab"  role="tablist">
          <li class="nav-item">
             <a class="nav-link active"  id="viewitem-tab" data-toggle="tab" href="#viewitem" role="tab" aria-controls="viewitem" aria-selected="true">View Food Items</a>
          </li>
          <li class="nav-item">
              <a class="nav-link"  id="manageaccount-tab" data-toggle="tab" href="#manageaccount" role="tab" aria-controls="manageaccount" aria-selected="false">Account Settings</a>
          </li>
		  <li class="nav-item">
              <a class="nav-link"   id="ManageVendors-tab" data-toggle="tab" href="#ManageVendors" role="tab" aria-controls="ManageVendors" aria-selected="false">Manage Food Stand</a>
          </li>
		  <li class="nav-item">
              <a class="nav-link"  id="orderstatus-tab" data-toggle="tab" href="#orderstatus" role="tab" aria-controls="orderstatus" aria-selected="false">Order status</a>
          </li>
			
       </ul>
		</div>
		 <style>
			 .container ul{
				 background: rgba(146,236,184,1.00);
				 border-radius:10px 10px 10px 10px;
			 }
			 .nav-link{
				 color:darkblue;
				 font-family: arizonia;
			 }
			 a:hover{
				 font: bold;
				 color: aliceblue;
			 }
			 
		</style>
	</nav>
	  
	   <br><br>
	<!--tab 1 starts-->   
	   <div class="tab-content" id="myTabContent">
	   
            <div class="tab-pane fade show active" id="viewitem" role="tabpanel" aria-labelledby="viewitem-tab">
                 <div class="container">
	               <table class="table">
                 <thead>
                    <tr>
                        <th scope="col">FoodStand_Id</th>
                            <th scope="col">Food View</th>
                            <th scope="col">Food Cuisines</th>
                            <th scope="col">FoodStand Name</th>
                            <th scope="col">Food Id</th>
                            
                            <th scope="col">Remove FoodStand</th>
                     </tr>
                 </thead>
				 <tbody>
	       </table>
	 
	 </div>   	
		  
		   <span style="color:green; text-align:centre;"><?php if(isset($success)) { echo $success; }?></span>
			
		
      	    </div>	 
	  
<!--tab 1 ends-->	   
			
			
			<!--tab 2 starts-->
            <div class="tab-pane fade" id="manageaccount" role="tabpanel" aria-labelledby="manageaccount-tab">
			    <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" id="username" value="<?php if(isset($user)){ echo $user;}?>" class="form-control" name="name" readonly="readonly"/>
                    </div>
					
					
					
                   <div class="form-group">
                      <label for="pwd">Password:</label>
                     <input type="password" name="password" class="form-control" value="<?php if(isset($pass)){ echo $pass;}?>" id="pwd" required/>
                   </div>
				   
				   
 
                  <button type="submit" name="update" style="background:green; border:1px solid green;" class="btn btn-primary">Update</button>
                  <div class="footer" style="color:red;"><?php if(isset($ermsg)) { echo $ermsg; }?><?php if(isset($ermsg2)) { echo $ermsg2; }?></div>
			 </form>
			</div>
			<!--tab 2 ends-->
			 
			 <div class="tab-pane fade show" id="ManageVendors" role="tabpanel" aria-labelledby="ManageVendors-tab">
			    <div class="container">
	               <table class="table">
                 <thead>
                    <tr>
                        <th scope="col"></th>
                            <th scope="col">FoodStand Id</th>
                            <th scope="col">Name</th>
                            
                            
                            <th scope="col">Address</th>
                            <th scope="col">Remove FoodStandr</th>
                     </tr>
                 </thead>
				 <tbody>
	
           </table>
	 
	 </div>   	
			 </div>
			 
			 <!--tab 4-->
			 <div class="tab-pane fade" id="orderstatus" role="tabpanel" aria-labelledby="orderstatus-tab">
               <table class="table">
			   <th>Order Id</th>
			   <th>Food Id</th>
			   <th>Customer Email Id</th>
			   <th>order Status</th>
			   <tbody>
			   
			   </table>
			</div>
			 
      
	  </div>
	</div>	 
</body>
	
</html>	
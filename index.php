<?php
 require_once './assets/connection.php';

 if(!$conn)
 die("Oh Shoot!! Connection Failed");

 
 if(isset($_POST['login'])) 
 {
     $msg = "";
     
     // fetching name and password from textbox
     $username=mysqli_real_escape_string($conn,$_POST['username']);  
     $password=mysqli_real_escape_string($conn,$_POST['password']);
    // $password = md5($password);
     // fetching username and password from database 
     $query=mysqli_query($conn,"select * FROM `users` WHERE `user_name` = '$username' && `password` = '$password'");  
     
     $num=mysqli_num_rows($query);  
     if ($num>0) {  
         
          //Data Found
          session_start();
          $row=mysqli_fetch_assoc($query);  
          $_SESSION["loggedIn"] = true;
          $id = $_SESSION['user_id']=$row['user_id'];  
          if($row['role']=='admin')
          {
            header("location:admin.php?id=$id"); 
            exit;
          }
          if($row['role']=='manager')
          {
            header("location:admin.php?id=$id"); 
            exit;
          }
          else
          {
            header("location:index.php?error=User Type is not Valid!");
          }
           
     }else{ 

        header("location:index.php?error=Incorrect username and password!"); 
     }  
 
 }

?>
<html>
    <head> 
	    <title>Web Dev TO</title>
		<link rel="stylesheet" href="loginstyle.css">
	 </head>
	  <body>
	    <div class="banner">
             <div class="banner">
                <div class="navbar">
                            <img src="Logo.jpg" class="logo">
                                <ul>
                                <li><a href="home.php">Home</a></li>
                                <li><a href="index.php">Login</a></li>
                                <li><a href="aboutus.php">About us</a></li>
                                <li><a href="help.php">Help</a></li>   
                                </ul>
                        </div>
                    <div class="loginbox">
                            <h1>LOGIN HERE</h1>
                            <?php if (isset($_GET['error'])) { ?>
                            <span>&nbsp;<?php echo $_GET['error']; ?><br>&nbsp;</span>

                          <?php } ?>
                            <form method="post" action="">
                            <p>USERNAME</p>
                            <input type="text" name="username" placeholder="Enter Username">
                            <p>PASSWORD</p>
                            <input type="password" name="password" placeholder="Enter Password">
                            <input type="submit" value="LOGIN" name="login">
                            <a href="#">Forgot your password?</a><br>
                            <a href="#">Don't have an account yet?</a>
                            </form>
                    </div>
            </div>
        </div>
	  </body>
</html>

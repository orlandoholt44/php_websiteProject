<?php
   require_once("connection.php"); //connection to the database

   $firstnameErr = "";   //Variable fields that will be validated currently set empty
   $lastnameErr ="";
   $emailErr = "";  
   $genderErr = "";  
   $addressErr = "";
   $usernameErr = "";
   $passwordErr = "";
   if (isset($_POST['submit'])) {  
    
    if(isset($_POST['firstname']) &&  isset($_POST['lastname']) &&  isset($_POST['email']) &&  isset($_POST['gender'])
    &&  isset($_POST['address']) &&  isset($_POST['username']) &&  isset($_POST['password'])){
       include("create.php"); //processing to save the record
       exit();
    } 
  }
   if ($_SERVER["REQUEST_METHOD"] == "POST"){
     //Validation Messages
           //First Name Validation
            if (empty($_POST["firstname"])) {  
               $firstnameErr = "Please enter your first name";  
            } 
            else if (!preg_match("/^[a-zA-Z- ]*$/", $_POST["firstname"])) 
               {  
                $firstnameErr = "Only letters and white space are allowed"; 
            }
            else {  
               $firstname = check($_POST["firstname"]);
            }  
            
            //Last Name Validation
            if (empty($_POST["lastname"])) {  
                $lastnameErr = "Please enter your last name";  
             } 
             else if (!preg_match("/^[a-zA-Z- ]*$/", $_POST["lastname"])) 
                {  
                 $lastnameErr = "Only letters and white space allowed"; 
             }
             else {  
                $lastname = check($_POST["lastname"]);
             }

             //Gender Validation
            if (empty($_POST["gender"])) {  
               $genderErr = "Please select a gender";  
            } else {  
               $gender = check($_POST["gender"]);  
            } 

            //Date of Birth Validation
            if (empty($_POST["address"])) {  
                $addressErr = "Please enter your address";  
             } else {  
                $address = check($_POST["address"]);  
             } 
            
             //Username Validation
             if (empty($_POST["username"])) {  
                $usernameErr = "Please enter a username";  
             } 
             else if($_POST["username"] <= 5){
                $usernameErr = "Username must be greater than 5 characters!!";  
             }
            else {  
                $username = check($_POST["username"]);  
             } 
             
             //Email Validation
             if (empty($_POST["email"])) {  
               $emailErr = "Email is required";  
             } else {  
               $email = check($_POST["email"]);  
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  
                  $emailErr = "Invalid email format";   
               }  
             }  
          
             //Password Validation
             if (empty($_POST["password"])) {  
               $passwordErr = "Please supply a password";  
             } 
             else if($_POST["password"] <= 7){
                $passwordErr = "Please supply a valid password greater than 7 characters!!"; 
             }
             else {  
               $password = check($_POST["password"]);  
             }  
             

             //checking if the email address already exist
        $query = mysqli_query($con, "SELECT * FROM `subscriber` WHERE email = '".$email."'");
        if(mysqli_num_rows($query) >0){
          $emailErr = "This email address already exist, try using a different one"; 
        }
         
        } 
        function check($data) 
         {  
          $data = trim($data);  
          $data = stripslashes($data);  
          $data = htmlspecialchars($data);  
          return $data;  
         } 
?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="style.css"/>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Registration Website</title>
  </head>
  <body>
    <div class="nav_bar">
    <h3><a href="index.php" class ="logo"><img src="image/logo2.png"></a></h3><strong>BROADLEAF UNITY CLUB</strong> 
            <ul>
              <li id="home" name="home"><a href="index.php">Home</a></li>
              <li id="registration" name="registration"><a href="registration.php">Registration</a></li>
              <li id="gallery" name="gallery"><a href="gallery.php">Gallery</a></li>
              <li id="about" name="about"><a href="about.php">About</a></li>
              <li id="contact" name="contact"><a href="contact.php">Contact</a></li>
            
                    <li><a href="login.php">User</a></li>
                    <li><a href="admin.php">Admin</a></li>
                
            </ul>
            <hr>
    </div> 

    <div class ="jumbotron">
        <h1 class="text-center"style="color: purple;background: white;">
            Registration Form
        </h1>
    </div>
    <div class="container"style="color: purple; background: white; width: 75%; opacity: 0.95;">
        <div class="row">
            <div class="col-md-6 offset-md-3 col-sm-12">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data"> 
                    <div class="form-group"><br>
                    <strong><label for="name">FIRST NAME</label></strong> <br>
                        <input type="text" class="form-control" name="firstname" id="firstname" autofocus="true"> 
                        <span class = "error"><?php if(isset($firstnameErr)){echo $firstnameErr;}?> </span><br>
                    </div>
                    <div class="form-group">
                    <strong> <label for="name">LAST NAME</label></strong> <br>
                        <input type="text" class="form-control" name="lastname" id="lastname">
                        <span class = "error"><?php if(isset($lastnameErr)){echo $lastnameErr;}?> </span> <br>
                    </div>
                    <div class="form-group">
                    <strong><label for="name">EMAIL</label></strong><br>
                        <input type="text" class="form-control" name="email" id="email">
                        <span class = "error"><?php if(isset($emailErr)){echo $emailErr;}?> </span><br>
                    </div>
                    
                    <strong>  <label for="gender">GENDER</label></strong>
                    <div class="form-check">
                        <label class="form-check-label" for="male"> MALE
                            <input class="form-check-input" type="radio" name="gender" id="male" value="Male">
                        </label><br>
                        <label class="form-check-label" for="female">FEMALE
                            <input class="form-check-input" type="radio" name="gender" id="female" value="Female"><br><br>
                        </label>
                    </div>

                    <div class="form-group">
                    <strong>  <label for="name">ADDRESS</label> </strong><br>
                        <input type="text" class="form-control" name="address" id="address">
                        <span class = "error"><?php if(isset($addressErr)){echo $addressErr;}?> </span><br>
                    </div>
                    
                    <div class="form-group">
                        <strong><label for="formFile"> PROFILE PICTURE</label> </strong> <br>
                        <input class="form-control" type="file" name="profile" value="" id="formFile"><br>
                    </div>

                    <div class="form-group">
                        <strong><label for="name">USERNAME</label></strong> <br>
                        <input type="text" class="form-control" name="username" id="username">
                        <span class = "error"><?php if(isset($usernameErr)){echo $usernameErr;}?> </span><br>
                    </div>
                    <div class="form-group">
                    <strong>  <label for="name">PASSWORD</label></strong> <br>
                        <input type="password" class="form-control" name="password" id="password">
                        <span class = "error"><?php if(isset($passwordErr)){echo $passwordErr;}?> </span><br>
                    </div>
                    <div class="d-grid gap-2">
                    <input type="submit" name="submit" value="Submit" class="btn btn-primary block"> 
                     
                    </div>
                    <p class="link"><a href="login.php">Click to Login</a></p>
                    <p class="link"><a href="index.php">Home</a></p><br>
                </form>
            </div>
    </div>
    </div> 
    
    <img name="image1" src="image/male.jpg" hidden>
    <img name="image2" src="image/female.png" hidden>
    
  </body>
</html>


<?php
    require_once('connection.php');

    if(isset($_POST['submit'])){
        $male = isset($_POST['image1']);
        $female = isset($_POST['image2']);

        $firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];

       if(isset($_POST['gender']))
        {
            $gendertype = $_POST['gender'];

            if($gendertype == "Male"){
                $gender = $gendertype;
               
            }
            else if($gendertype == "Female"){
                $gender = $gendertype;
            }
        }
		$address = $_POST['address'];
		$username = $_POST['username'];
		$password = $_POST['password'];
        
        $msg = "";
        if(isset($_POST['profile'])){
            $profile = $_FILES["profile"]["name"];
            $tempname = $_FILES["profile"]["tmp_name"];	
            $folder = "profile/".$profile;
       }
       else{
            if(empty($_POST['profile']) && $gendertype == "Male"){
                $profile = $_FILES["profile"]["name"];
                $tempname = $_FILES["profile"]["tmp_name"];	
            $folder = "profile/".$profile;
            }
            else if(empty($_POST['profile']) && $gendertype == "Female"){
                $profile = $_FILES["profile"]["name"];
                $tempname = $_FILES["profile"]["tmp_name"];	
            $folder = "profile/".$profile;
            }
       }
        //token and status for email
        $token = md5(rand());
        
        //checking if the email address already exist
        $query = mysqli_query($con, "SELECT * FROM `subscriber` WHERE email = '".$email."'");
        if(mysqli_num_rows($query) >0){
            echo "This email address already exist, try using a different one"; 
            exit();
        }
        
          
            $sql ="INSERT INTO `subscriber`(`firstname`, `lastname`, `email`, `gender`, `address`, `image`, `username`, `password`, `token`, `status`) 
            VALUES ('$firstname','$lastname','$email','$gender','$address','$profile','$username','$password','$token','0')";

            if($con->query($sql) === TRUE)
            {
                
                // Now let's move the uploaded image into the folder: image
                echo "<h4><i>Record added successfully</i></h4><br>";
                echo "<h1>Profile Information</h1> <br>";
                echo "First Name:<input value='$firstname'> <br>
                Last Name: <input value='$lastname'> <br>
                Email: <input value='$email'> <br>
                Gender: <input value='$gender'> <br>
                Address: <input value='$address'> <br>
                Profile: <input value='$profile'> <br>
                Username: <input value='$username'> <br>
                Password: <input value='$password'> ";   
            }
            else
            {
                echo "There was an error, file was not added to the database";
            }
            
            if(move_uploaded_file($tempname, $folder)) 
            {
                $msg = "Image uploaded successfully";
            }
            else{
                $msg = "Failed to upload image";
            }
        }
        else
        {
            echo "Record was not added to the database.";
        }
    
        echo "<p class='link'><a href='index.php'>Home</a></p>";
?>

<script>
$(document).ready(function(){
    $('#submit').click(function(){
        var image_name = $('#profile').val();
        if(image_name == '' && ){
            alert("Please select an image");
            return false;
        }
        else{
            var extension = $('#profile').val().split('.').pop().toLowerCase();
            if(jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1){
                alert('Invalid Image File');
                $('#profile').val('');
                return false;
            }
        }
    });
});
</srcipt>
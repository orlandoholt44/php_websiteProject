<?php
    require_once('connection.php');

    if(isset($_POST['submit'])){
        $id = $_GET['id'];
        $firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$gender =$_POST['gender'];
        $address = $_POST['address'];
		$username = $_POST['username'];
		$password = $_POST['password'];
        
        $msg = "";
        $profile = $_FILES["profile"]["name"];
        
        $tempname = $_FILES["profile"]["tmp_name"];	
        $folder = "profile/".$profile;
        
        $sql ="UPDATE `subscriber` SET firstname='".$firstname."', lastname='".$lastname."', email='".$email."',
        gender='".$gender."', address='".$address."', image='".$profile."',
        username='".$username."', password='".$password."' WHERE id = '".$id."'";
	
        $result = mysqli_query($con, $sql);
        if($result){
            //echo "The record was Updated";
            header("Location: admin2.php");
        }
        else{
            echo "Something went wrong";
        } 
    }
    else{
            echo "Invalid";
            echo "<div class='form'><p class='link'>Click here to <a href='admin2.php'>Back</a> again.</p></div>";
        } 
?>
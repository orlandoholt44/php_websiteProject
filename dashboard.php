<?php
//include auth_session.php file on all user panel pages
include("session.php");

/*session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - User Section</title>
    <link rel="stylesheet" href="style.css" />
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
            <div class = content>  
              <li id="login" name="login" class="dropdown"><a>Login Here</a> 
                <a href="login.php">User</a>
                <a href="admin.php">Admin</a>
               </li>  
    </div>

    <div class="form">
        <?php echo "<h1>Welcome " . $_SESSION['username'] . "</h1>"; ?>
        <p>Click to <a href ="profile.php">view your profile</a></p>
        <a href="logout.php">Logout</a>  
    </div>
</body>
</html>
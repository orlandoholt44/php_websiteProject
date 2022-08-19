<?php
    // Enter your host name, database username, password, and database name.
    // If you have not set database password on localhost then set empty.
    $con = mysqli_connect("localhost","orlando","","broadleafunityclub_db");
    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    //url for login page for the email verification
    $base_url ="http://localhost/Assignment3/login.php";

    //emails will be sent from
    $my_email = "orlandoholt44@gmail.com";
?>
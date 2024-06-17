<?php
    session_start();
    include "confiq.php";

    //TODO: login as user/admin - separate details and different windows
    if(isset($_POST['email']) && isset($_POST['password'])){
        $email=$_POST['email'];
        $password=$_POST['password'];

        //look for same email
         //admin email
        $emailstmt = "SELECT email,password from admin WHERE email='$email' and password='$password'";
        $emailrslt = mysqli_query($conn,$emailstmt);
         
         //user email
        $useremailstmt = "SELECT email,password from userc WHERE email='$email' and password='$password'";
        $useremailrslt = mysqli_query($conn,$useremailstmt);

        if(mysqli_num_rows($emailrslt)>0 ){//admin
            header("Location: dashboard.php");
            exit();
        }else if(mysqli_num_rows($useremailrslt)>0){//user
            header("Location: user-dashboard.php");
            echo $_SESSION['email']=$email;
            exit();
        }else echo "<script> alert('Creditial not found');</script>";
    }
?>
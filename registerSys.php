<?php
    session_start();
    include "confiq.php";
    if(isset($_POST['email'])){
        $email=$_POST['email'];
        $pass1=$_POST['password'];
        $pass2=$_POST['cpassword'];
        $type=$_POST['user_type'];

        //Generate id
        $adminID=0;
        $userID=0;

        //look for same email
        $emailstmt = "SELECT email from admin WHERE email='$email'";
        $emailrslt = mysqli_query($conn,$emailstmt);
        $useremailstmt = "SELECT email from userc WHERE email='$email'";
        $useremailrslt = mysqli_query($conn,$useremailstmt);


        if($pass1!=$pass2) echo "<script> alert('password does not match'); </script>";
        else if(mysqli_num_rows($emailrslt)>0 or mysqli_num_rows($useremailrslt)>0) echo "<script> alert('email exist'); </script>";
        else{
            if($type=="admin"){
                //create adminID
                $getAdminID = "SELECT adminID from admin";
                $adminIDResult = mysqli_query($conn,$getAdminID);
                if(mysqli_num_rows($adminIDResult)>0){
                    while($row=mysqli_fetch_assoc($adminIDResult)){
                        if((int)$row['adminID']===$adminID)
                            $adminID=($row['adminID']+1);
                        else break;
                    }
                }

                //create adminuser
                $createAdmin="INSERT into admin values('$adminID','$email','$pass1')";
                if(!$conn->query($createAdmin)===true) echo "Error: ".$stmtloan." ".$conn->error;
                else{
                    header("Location: dashboard.php");
                    exit();
                } 
                
            }
            else if($type=="user"){
                //create userID
                $getuserID = "SELECT userID from userc";
                $userIDResult = mysqli_query($conn,$getuserID);
                if(mysqli_num_rows($userIDResult)>0){
                    while($row=mysqli_fetch_assoc($userIDResult)){
                        if((int)$row['userID']===$userID)
                            $userID=($row['userID']+1);
                        else break;
                    }
                }
                $_SESSION['userID']=$userID;

                //create user
                $createUser="INSERT into userc values('$userID','$email','$pass1')";
                if(!$conn->query($createUser)===true) echo "Error: ".$stmtloan." ".$conn->error;
                else{
                    header('Location: Loan_form.php');
                    exit();
                } 
            }
        } 
    }
?>
<?php
    include "registerSys.php";
    $customersID=0;
    $loanID=0;
    $balanceID=0;
    $createSuccess=0;
    if(isset($_POST['fname'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $gender = $_POST['gender'];
        $birthDate = $_POST['birthDate'];
        $phoneNo = $_POST['phoneNumber'];
        $email = $_POST['emailAdd'];
        $street = $_POST['streetAdd'];
        $city = $_POST['city'];
        $region = $_POST['region'];
        $postal = $_POST['postalCode'];
        $loanAmount = $_POST['loanAmount'];
        $termLength = $_POST['termLength'];
        $interestRate = $_POST['interestRate'];
        $paymentSched = $_POST['paymentSched'];

        $dateStarted=date('Y-m-d');


        $userID=$_SESSION['userID'];
        
        //TODO: here we make lending status [pending] as default;
        //if pending just save the data in the database
        //when drop/rejected delete the database
        //when accepted update the status as 

        //making customerID
        $mkstmt = "SELECT customersID from customers";
        $mkresult = mysqli_query($conn,$mkstmt);
        if(mysqli_num_rows($mkresult)>0){
            while($row=mysqli_fetch_assoc($mkresult)){
                if((int)$row['customersID']===$customersID)
                    $customersID=($row['customersID']+1);
                else break;
            }
        }

        //statement to insert customers detail
        $stmtCust = "INSERT into customers values('$userID','$customersID','$lname','$fname','$gender','$birthDate','$phoneNo','$street','$city','$region','$postal')";
        if(!$conn->query($stmtCust)===true) echo "Error: ".$stmtCust." ".$conn->error;


        //making loanID
        $mkstmtloan = "SELECT loanID from loanapplication";
        $mkresultloan = mysqli_query($conn,$mkstmtloan);
        if(mysqli_num_rows($mkresultloan)>0){
            while($row=mysqli_fetch_assoc($mkresultloan)){
                if((int)$row['loanID']===$loanID)
                    $loanID=($row['loanID']+1);
                else break;
            }
        }

        //statement to insert loanapplication
        $stmtloan = "INSERT into loanapplication values ('$customersID','$loanID','$loanAmount','$termLength','$interestRate','$paymentSched','$dateStarted','pending')";
        if(!$conn->query($stmtloan)===true) echo "Error: ".$stmtloan." ".$conn->error;
        else $createSuccess++;

        //make loanBalance
        $mkstmtloanb = "SELECT balanceID from loanbalance";
        $mkresultloanb = mysqli_query($conn,$mkstmtloanb);
        if(mysqli_num_rows($mkresultloanb)>0){
            while($row=mysqli_fetch_assoc($mkresultloanb)){
                if((int)$row['balanceID']===$balanceID)
                    $balanceID=($row['balanceID']+1);
                else break;
            }
        }

        //statement to insert loanapplication
        $balance=(int)$loanAmount+((int)$loanAmount*((int)$interestRate/100));
        $stmtloanb = "INSERT into loanbalance values ('$loanID','$balanceID','$balance')";
        if($conn->query($stmtloanb)===true) {echo "<script> alert('New Data added'); </scrip>"; $createSuccess++;}
        else echo "Error: ".$stmtloan." ".$conn->error;
    }

    if($createSuccess==2){
        header("Location: LendingSystem.php");
        session_abort();
        exit();
    }
    
    
?>


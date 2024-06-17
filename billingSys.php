<?php
    include "confiq.php";
    $paymentID=0;
    if(isset($_POST['amount'])){
        $amount=(int)$_POST['amount'];
        $date=$_POST['date'];
        $custID=$_POST['custID'];
        $loanID=$_POST['loanID'];
        $balance=(int)$_POST['balance'];
        

        if($balance<$amount){
            echo "<script> alert('Negative Amount');</script>";
            header("Location: billing.php");
            exit();
        }else{
        
            //create paymentID
            $getPaymentID = "SELECT paymentID from loanPayment";
            $paymentIDResult = mysqli_query($conn,$getPaymentID);
            if(mysqli_num_rows($paymentIDResult)>=0){
                while($row=mysqli_fetch_assoc($paymentIDResult)){
                    if((int)$row['paymentID']==$paymentID )
                        $paymentID+=(int)$row['paymentID'];
                    else $paymentID+=2;
                }
            }
            //create statment insert
            $insertData = "INSERT INTO loanpayment values('$custID','$loanID','$paymentID','$date','$amount')";
            if (!$conn->query($insertData) === TRUE) echo "Error: " . $sql . "<br>" . $conn->error;

            $newBal=(int)($balance-$amount);
            $updateBal = "UPDATE loanbalance SET currentbalance=$newBal where loanID=$loanID";
            if ($conn->query($updateBal) === TRUE) {
                header("Location: tables.php");
                exit();
            }
        }
            
    }
?>
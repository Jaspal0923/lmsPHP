<?php
    include "confiq.php";
    $paymentID=$_GET['a'];
    $amount=0;
    $loanID='';
    //get amount
    $getamount="SELECT paymentAmount,loanID from loanpayment where paymentID=$paymentID";
    $exec = mysqli_query($conn,$getamount);
    while($row=mysqli_fetch_assoc($exec)){
        $amount+=$row['paymentAmount'];
        $loanID=(int)$row['loanID'];
    }
    
    //add amount to remaining
    $selecBal="SELECT currentBalance from loanbalance where loanID=$loanID";
    $execbal = mysqli_query($conn,$selecBal);
    while($row=mysqli_fetch_assoc($execbal)){
        $amount+=$row['currentBalance'];
    }

    //update balance
    $upAmount = "UPDATE loanbalance set currentBalance=$amount where loanID=$loanID";
    if (!$conn->query($upAmount) === TRUE) echo "Error: " . $sql . "<br>" . $conn->error;

    //delete
    $delPayment = "DELETE FROM loanpayment where paymentID=$paymentID";
    if ($conn->query($delPayment) === TRUE) {
        header("Location: tables.php");
        exit();
    }
?>
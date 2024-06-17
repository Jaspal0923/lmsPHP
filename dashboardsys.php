<?php
    include "confiq.php";
    $currentDate = date("Y-m-d");
    $currentBalance="";
    $currentYear = date("Y");

    $countcustomers='';

    $newcustomerCount='';

    $saleThisYear=0;
    
    $total=0;

    //TODO: get the todays money amount and compare to the total

    //getCurrent balance by current date
    $gettotal="SELECT paymentAmount from loanpayment where paymentDate='$currentDate'";
    $getstmt = mysqli_query($conn,$gettotal);

    while($row=mysqli_fetch_assoc($getstmt)){
        $total=(int)$total+(int)$row['paymentAmount'];
    }

    $totalMoneyID=0;
    //create totalmoneyperdayid
    $getAdminID = "SELECT totalMoneyID from totalmoneyperday";
    $adminIDResult = mysqli_query($conn,$getAdminID);
    if(mysqli_num_rows($adminIDResult)>0){
        while($row=mysqli_fetch_assoc($adminIDResult)){
            if((int)$row['totalMoneyID']===$totalMoneyID)
                $totalMoneyID=($row['totalMoneyID']+1);
            else break;
        }
    }

    //getmoneyperday to compare
    $thisdayBalance=0;
    try {
        $compareStmt = "SELECT totalAmount from totalmoneyperday where moneyPerDayDate='$currentDate'";
        $execompare=mysqli_query($conn,$compareStmt);
        while($row=mysqli_fetch_assoc($execompare)){
            $thisdayBalance=(int)$thisdayBalance+(int)$row['totalAmount'];
        }
    } catch (\Throwable $th) {
        //throw $th;
    }

    if($thisdayBalance<$total){
        $insertTotal="INSERT INTO totalmoneyperday values('$currentDate','$totalMoneyID','$total','$currentDate')";
        if (!$conn->query($insertTotal) === TRUE) echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    

    $stmt = "SELECT totalAmount from totalmoneyperday where moneyPerDayDate = '$currentDate'";
    $rslt = mysqli_query($conn,$stmt);
    if(mysqli_num_rows($rslt)>0){
        while($row= $rslt->fetch_assoc()){
            $currentBalance = (int)$row['totalAmount'];
        }
    }else $currentBalance=0;


    //get total customer active 
    $customerCount = "Select customersID from customers";
    $countstmt = mysqli_query($conn,$customerCount);

    if(mysqli_num_rows($countstmt)>0){
        while($row=$countstmt->fetch_assoc()){
            $countcustomers++;
        }
    }else $countcustomers = "No customer found in database";
    
    //get total customer active this year
    $newcustomer = "Select dateStarted from loanapplication where year(dateStarted) = '$currentYear'";
    $newcustomerRslt = mysqli_query($conn,$newcustomer);
    if(mysqli_num_rows($newcustomerRslt)>0){
        while($row=$newcustomerRslt->fetch_assoc()){
            $newcustomerCount++;
        }
    }else $newcustomerCount = "No customer found in database";

    //getSale This year
    $getsale = "SELECT totalAmount from totalmoneyperday";
    $salerslt = mysqli_query($conn,$getsale);
    if(mysqli_num_rows($salerslt)>0){
        while($rows=$salerslt->fetch_assoc()){
            $saleThisYear += (int)$rows['totalAmount'];
        }
    }else $saleThisYear = "No data found in database";
?>
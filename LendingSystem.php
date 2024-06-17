<?php
  include "loginSys.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log In</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;500;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="css/LoginPage.css">
  
</head>
<body>

  <div class="log-box">
    <div class="welcome-box">
    
    <p>
        WELCOME, USER! <br>
        Lending Management System
      </p>
      <p>
        We're delighted to have you here. Get ready to access a range of powerful tools and features that will streamline your lending activities. Your journey to efficient lending starts now. 
      </p>
      
    </div>
    <div class="log-components">
      <p>
        Login Account 
      </p>
      <form name="form1" action="LendingSystem.php" class="form" method="POST">

        <input type="email" name="email" class="inp-field" placeholder="Enter your Email" required>
   
        <input type="password" name="password" class="inp-field" placeholder="Enter your Password" required>

        <input type="submit" name="submit" class="sub-btn" value="LOGIN">
        
        <a href="Register_form.php">Create an account</a>

      </form>
    </div>
  </div>


</body>
</html>
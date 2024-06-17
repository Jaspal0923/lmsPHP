<?php 
session_start();
include "confiq.php";
$email=$_SESSION['email'];
$payment=0;
$loanAmount;
$balance=0;
$customersID='';
$loanID='';
$fname ='';
$lname ='';
$bdate ='';
$phno ='';

    $getuserstmt = "SELECT c.firstname,c.lastname,c.birthday,c.phoneNo,c.customersID from customers c inner join userc u on u.userID=c.userID where u.email='$email'";
    $getrslt = mysqli_query($conn,$getuserstmt);
    while($row=mysqli_fetch_assoc($getrslt)){
      $fname=$row['firstname'];
      $lname=$row['lastname'];
      $bdate=$row['birthday'];
      $phno=$row['phoneNo'];
      $customersID=$row['customersID'];
    }

    //get total payment
    $totalPaystmt = "SELECT paymentAmount,loanID from loanPayment where customersID=$customersID";
    $totalreslt = mysqli_query($conn,$totalPaystmt);
    while($row=mysqli_fetch_assoc($totalreslt)){
      $payment+=(int)$row['paymentAmount'];
      $loanID=$row['loanID'];
    }

    //getuserLoanDetails
    try {
      $loanstmt = "SELECT l.loanAmount, b.currentBalance from loanApplication l inner join loanbalance b on l.loanID=b.loanID where l.loanID=$loanID";
      if($balrslt=mysqli_query($conn,$loanstmt)){
      while($row=mysqli_fetch_assoc($balrslt)){
        $loanAmount=$row['loanAmount'];
        $balance=$row['currentBalance'];
      }
    }
    } catch (\Throwable $th) {
      $loanAmount="No data";
    }
    
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/profits.png">
  <link rel="icon" type="image/png" href="assets/img/profits.png">
  <title>
    Welcome User!
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href=".assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 background-color-secondary position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 rounded-1 shadow-lg" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="">
        <img src="assets/img/profits.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Lending Management</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <form action="user-dashboard.php" method="post">
      <ul class="navbar-nav">
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-sm font-weight-bolder opacity-6">Edit Profile</h6>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">USER INFORMATION</h6>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xxs font-weight-bolder opacity-6">First Name</h6>
        </li>
        <li class="nav-item">
          <input type="text" name="firstName" class="ps-3 border-0 shadow rounded-1 ms-4 form-control-sm" value="<?php echo $fname;?>">
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xxs font-weight-bolder opacity-6">Last Name</h6>
        </li>
        <li class="nav-item">
          <input type="text" name="lastName"class="border-0 shadow rounded-1 ps-3 ms-4 form-control-sm" value="<?php echo $lname;?>">
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xxs font-weight-bolder opacity-6">Birth Date</h6>
        </li>
        <li class="nav-item">
          <input type="text" name="date" class="border-0 shadow rounded-1 ps-3 ms-4 form-control-sm" value="<?php echo $bdate;?>">
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xxs font-weight-bolder opacity-6 ">Phone Number</h6>
        </li>
        <li class="nav-item">
          <input type="text" name="number" class="mb-3 border-0 shadow rounded-1 ps-3 ms-4 form-control-sm" value="<?php echo $phno;?>">
        </li>
      </ul>
      
    </div>
    <div class="sidenav-footer mx-4 ">
      <button type="submit" class="btn color-schem btn-sm w-100 mt-4">Apply Changes</button>
    </div>
  </form>
  <?php
    //edit user
    if(isset($_POST['firstName'])){
        $firstname=$_POST['firstName'];
        $lastname=$_POST['lastName'];
        $date=$_POST['date'];
        $number=$_POST['number'];
        //update query
        $updateUser = "UPDATE customers SET firstname='$firstname', lastname='$lastname', birthday='$date',phoneNo='$number' where customersID=$customersID";
        if ($conn->query($updateUser) === TRUE) {header("Location: user-dashboard.php"); exit();}
      }
  ?>
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Dashboard</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 w-40 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Search here...">
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="logout.php" class="nav-link text-white font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Logout</span>
              </a>
            </li>
            
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card rounded-1 side-color shadow">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers text-font">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold text-success">Loan Amount</p>
                    <h5 class="font-weight-bolder">
                      <?php echo $loanAmount?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card rounded-1 side-color shadow">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers text-font">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold text-success">Paid Balance</p>
                    <h5 class="font-weight-bolder">
                    <?php echo $payment?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-success shadow-danger text-center rounded-circle">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card rounded-1 side-color shadow">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers text-font">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold text-success">Remainig Balance</p>
                    <h5 class="font-weight-bolder">
                      <?php echo $balance?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class=" py-4">
        <div class="row">
          <div class="col-12">
            <div class="card mb-4 rounded-1 shadow-lg bottom-color">
              <div class="card-header pb-0">
                <h6 class="text-success"> Loan Details</h6>
              </div>
              <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar p-0 text-font">
                  <table class="table table-striped align-items-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Loan ID</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Loan Amount</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Term Length</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Interest Rate</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Payment Schedule</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                      <?php
                        //put user details
                        //make user table connect with customers table using customerID as foreign key
                        //create application status for (approve,pending and denied)
                        
                        $userstmt = "SELECT l.loanID,l.loanAmount,l.termLength,l.interestRate,l.paymentSched,c.customersID from loanapplication l inner join customers c on l.customersID=c.customersID inner join userc u on c.userID=u.userID where u.email='$email'";
                        $stmtrslt = mysqli_query($conn,$userstmt);

                          while($row=mysqli_fetch_assoc($stmtrslt)){?>
                            <td class="d-flex flex-column justify-content-center"><p class="text-xs text-secondary mb-0"><?php echo $row['loanID'];?></p></td>
                            <td class="align-middle text-center"><span class="text-secondary text-xs font-weight-bold"><?php echo $row['loanAmount'];?></span></td>
                            <td class="align-middle text-center"><span class="text-secondary text-xs font-weight-bold"><?php echo $row['termLength'];?></span></td>
                            <td class="align-middle text-center"><span class="text-secondary text-xs font-weight-bold"><?php echo $row['interestRate'];?></span></td>
                            <td class="align-middle text-center"><span class="text-secondary text-xs font-weight-bold"><?php echo $row['paymentSched'];?> days a week</span></td>
                        </tr>
                        <?php
                          }
                        ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © Lending Management System
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="" class="nav-link text-muted" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="" class="nav-link pe-0 text-muted" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Clients",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#829460",
          backgroundColor: gradientStroke1,
          borderWidth: 3,
          fill: true,
          data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#fbfbfb',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#ccc',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="`assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>
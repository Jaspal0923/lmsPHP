<?php
 include "confiq.php";
 $customerID=$_GET['a'];
 $name="";
 $balance=0;
 $payment=0;
 $loanID=0;


 $stmt="SELECT c.firstname,c.lastname from customers c where c.customersID=$customerID";
 $rslt=mysqli_query($conn,$stmt);
 while($row=mysqli_fetch_assoc($rslt)){
  $name=$row['firstname']." ".$row['lastname'];
 }  

 $balstmt="SELECT l.currentBalance,l.loanID from loanBalance l inner join loanapplication a on a.loanID=l.loanID where a.customersID=$customerID ";
 $balrslt=mysqli_query($conn,$balstmt);
 while($row=mysqli_fetch_assoc($balrslt)){
  $balance=$row['currentBalance'];
  $loanID=$row['loanID'];
 }

 $totalPaystmt = "SELECT paymentAmount from loanPayment where customersID=$customerID";
 $totalreslt = mysqli_query($conn,$totalPaystmt);
 while($row=mysqli_fetch_assoc($totalreslt)){
  $payment+=(int)$row['paymentAmount'];
 }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="/assets/img/profits.png">
  <title>
    Payment
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
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
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="tables.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-calendar-grid-58 text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Tables</span>
          </a>
        </li>
    </div>
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Payments</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Payments</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Type here...">
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="logout.php" class="nav-link text-white font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Logout</span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
            

          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-lg-8">
          <div class="row">
            <div class="col-xl-6 mb-xl-0 mb-4">
              <div class="card bg-transparent shadow-xl">
                <div class="overflow-hidden position-relative border-radius-xl" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/card-visa.jpg');">
                  <span class="mask bg-gradient-success"></span>
                  <div class="card-body position-relative z-index-1 p-3">
                    <i class="fas fa-wifi text-white p-2"></i>
                    <h6 class="text-white mb-0"><?php echo $name?></h6>
                    <div class="d-flex">
                      <div class="d-flex">
                        <div class="me-4">
                          <p class="text-white text-sm opacity-8 mb-0">Customer Name</p>
                        </div>
                      </div>
                      <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                        <img class="w-60 mt-2" src="assets/img/logos/mastercard.png" alt="logo">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-xl-6">
              <div class="row">
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header mx-4 p-3 text-center">
                      <div class="icon icon-shape bg-gradient-success shadow-primary text-center border-radius-lg">
                        <i class="ni ni-money-coins opacity-10" aria-hidden="true"></i>
                      </div>
                    </div>
                    <div class="card-body pt-0 p-3 text-center">
                      <h6 class="text-center mb-0">Remainig Balance</h6>
                      <hr class="horizontal dark my-3">
                      <h5 class="mb-0">Php <?php echo $balance;?></h5>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mt-md-0 mt-4">
                  <div class="card">
                    <div class="card-header mx-4 p-3 text-center">
                      <div class="icon icon-shape bg-gradient-success shadow-success text-center border-radius-lg">
                        <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                      </div>
                    </div>
                    <div class="card-body pt-0 p-3 text-center">
                      <h6 class="text-center mb-0">Total Payment</h6>
                      <hr class="horizontal dark my-3">
                      <h5 class="mb-0">Php <?php echo $payment?></h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mb-lg-0 mb-4">
              <div class="card mt-4">
                <div class="card-header pb-0 p-3">
                  <div class="row">
                    <div class="col-6 d-flex align-items-center">
                      <h6 class="mb-0 text-success ">Customer Payment</h6>
                    </div>
                    <div class="col-6 text-end">
                      <div class="mt-3">
                        <!-- Button trigger modal -->
                        <button
                          type="button"
                          class="btn color-schem"
                          data-bs-toggle="modal"
                          data-bs-target="#modalCenter"
                        >
                        <i class="fas fa-plus"></i>&nbsp;&nbsp;Add new payment
                        </button>

                        <!-- Modal -->
                      <form action="billingSys.php" method="post">
                      <input type="hidden" id="custID" name="custID" value=<?php echo $customerID?>>
                      <input type="hidden" id="loanID" name="loanID" value=<?php echo $loanID?>>
                      <input type="hidden" id="balance" name="balance" value=<?php echo $balance?>>

                        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title text-success" id="modalCenterTitle">Add new payment</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="emailWithTitle" class="form-label">Amount</label>
                                    <input
                                      type="number"
                                      id="emailWithTitle"
                                      name="amount"
                                      class="form-control"
                                      placeholder="$100"
                                      required
                                    />
                                  </div>
                                  <div class="col mb-0">
                                    <label for="dobWithTitle" class="form-label">Payment Date</label>
                                    <input
                                      type="date"
                                      id="dobWithTitle"
                                      name="date"
                                      class="form-control"
                                      placeholder="DD / MM / YY"
                                      required
                                    />
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">
                                  Close
                                </button>
                                <button type="submit" class="btn color-schem">Save changes</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                      <!--TODO: Create insert form-->
                      
                      </div>
                    </div>

                  </div>
                </div>
                <div class="card-body p-3">
                  <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar p-0 text-font ">
                    <table id="loanApplicationTable" class="table table-striped  align-items-cente mb-0">
                      <thead class="text-left">
                        <tr>
                          <th class="text-uppercase text-secondary text-xs opacity-7 th-lg" scope="col">Payment ID</th>
                          <th class="text-uppercase text-secondary text-xs opacity-7 " scope="col">Payment Date</th>
                          <th class="text-uppercase text-secondary text-xs opacity-7" scope="col">Amount</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <?php
                            $paymentID="";
                            $date="";
                            $amount="";
                            $allPaystmt = "SELECT paymentID,paymentDate,paymentAmount from loanpayment where customersID=$customerID";
                            $allpayrslt = mysqli_query($conn,$allPaystmt);

                            while($row=mysqli_fetch_assoc($allpayrslt)){?>
                          <td>
                            <div class="px-3">
                              <p class="text-sm font-weight-bold mb-0"><?php echo $row['paymentID'];?></p>
                            </div>
                          </td>
                          <td>
                            <h6 class="mb-0 text-sm"><?php echo $row['paymentDate'];?></h6>
                          </td>
                          <td>
                            <h6 class="mb-0 text-sm"><?php echo $row['paymentAmount'];?></h6>
                          </td>
                          <td class="">
                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                              Edit
                            </a>
                          </td>
                          <td class="">
                            <a href="billingRemove.php?a=<?php echo $row['paymentID'];?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete user">
                              Remove
                            </a>
                          </td>
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
                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
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
  <script src="assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>
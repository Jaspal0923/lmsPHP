<?php
  include "loanAppSys.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Loan Request</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;500;700&display=swap" rel="stylesheet">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  
  <link rel="stylesheet" href="css/Application_form.css">

</head>
<body>

  <div class="container h-100">
    <div class="row justify-content-center h-100">
      <div class="card w-75 shadow-lg my-auto">
        <div class="card-header">
          <p class="fs-3 text-center mt-2 title-color">Loan Application Form</p>
          <p class="fs-6">Please fill in all needed information in the loan application form below to request a loan from your organization. Information regarding income assets are requested for qualification.</p>
        </div>
        <div class="card-body">
          <form action="Loan_form.php" method="post" class="needs-validation" novalidate>
            <div class="form-group">
              <p class="fs-5">Personal Information</p>
              <div class="row">
                <div class="col">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control rounded-0 shadow-sm border-left-green" id="floatingInput" placeholder="Jose" name="fname" required>
                    <label for="floatingInput">First Name</label>
                    <div class="invalid-feedback">
                      Please enter your first name.
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="form-floating mb-3 ">
                    <input type="text" class="form-control rounded-0 shadow-sm border-left-green" id="floatingInput" placeholder="Rizal" name="lname" required>
                    <label for="floatingInput">Last Name</label>
                    <div class="invalid-feedback">
                      Please enter your last name.
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="form-floating mb-3 ">
                    <select class=" form-control rounded-0 shadow-sm border-left-green" name="gender" id="floatingInput" required>
                      <option value="" disabled selected hidden>Choose gender</option> 
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                    </select>
                    <label for="floatingInput">Gender</label>
                    <div class="invalid-feedback">
                      Please select your gender.
                    </div>
                  </div>  
                </div>

                <div class="w-100"></div>

                <div class="col">
                  <div class="form-floating mb-3 ">
                    <input type="date" class="form-control rounded-0 shadow-sm border-left-green" id="floatingInput" name="birthDate" required>
                    <label for="floatingInput">Birth Date</label>
                    <div class="invalid-feedback">
                      Please enter your birth date.
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="form-floating mb-3 ">
                    <input type="number" class="form-control rounded-0 shadow-sm border-left-green" id="floatingInput" placeholder="0999" name="phoneNumber" required>
                    <label for="floatingInput">Phone Number</label>
                    <div class="invalid-feedback">
                      Please enter your phone number.
                    </div>
                  </div>
                </div>
                
                <div class="w-100"></div>
                
                <p class="fs-5">Address</p>

                <div class="col">
                  <div class="form-floating mb-3 ">
                    <input type="text" class="form-control rounded-0 shadow-sm border-left-green" id="floatingInput" placeholder="test@gmail.com" name="streetAdd" required>
                    <label for="floatingInput">Street Address</label>
                    <div class="invalid-feedback">
                      Please provide a valid address.
                    </div>
                  </div>
                </div>

                <div class="col">
                  <div class="form-floating mb-3 ">
                    <input type="text" class="form-control rounded-0 shadow-sm border-left-green" id="floatingInput" placeholder="test@gmail.com" name="city" required>
                    <label for="floatingInput">City</label>
                    <div class="invalid-feedback">
                      Please provide a valid city.
                    </div>
                  </div>
                </div>

                <div class="w-100"></div>

                <div class="col">
                  <div class="form-floating mb-3 ">
                    <input type="text" class="form-control rounded-0 shadow-sm border-left-green" id="floatingInput" placeholder="test@gmail.com" name="region" required>
                    <label for="floatingInput">Region</label>
                    <div class="invalid-feedback">
                      Please provide a valid region.
                    </div>
                  </div>
                </div>

                <div class="col">
                  <div class="form-floating mb-3 ">
                    <input type="number" class="form-control rounded-0 shadow-sm border-left-green" id="floatingInput" placeholder="test@gmail.com" name="postalCode" required>
                    <label for="floatingInput">Postal Code</label>
                    <div class="invalid-feedback">
                      Please provide a valid postal code.
                    </div>
                  </div>
                </div>

                <div class="w-100"></div>

                <p class="fs-5">Desired Loan</p>

                <div class="col">
                  <div class="form-floating mb-3 ">
                    <input type="number" class="form-control rounded-0 shadow-sm border-left-green" id="floatingInput" placeholder="test@gmail.com" name="loanAmount" min="1000" max="50000" step="1000" required>
                    <label for="floatingInput">Loan Amount</label>
                    <div class="invalid-feedback">
                      Please enter a valid amount. (1,000 mininum to 50,000 maximum)
                    </div>
                  </div>
                </div>

                <div class="col">
                  <div class="form-floating mb-3 ">
                    <select class=" form-control rounded-0 shadow-sm border-left-green" name="termLength" id="floatingInput" required>
                      <option value="" disabled selected hidden>Choose term length</option> 
                      <option value="30">30 days</option>
                      <option value="60">60 days</option>
                    </select>
                    <label for="floatingInput">Term Length</label>
                    <div class="invalid-feedback">
                    Please select term length.
                    </div>
                  </div>  
                </div>

                <div class="w-100"></div>

                <div class="col">
                  <div class="form-floating mb-3 ">
                    <select class=" form-control rounded-0 shadow-sm border-left-green" name="interestRate" id="floatingInput" required>
                      <option value="" disabled selected hidden>Choose interest rate</option> 
                      <option value="10">10%</option>
                      <option value="20">20%</option>
                    </select>
                    <label for="floatingInput">Interest Rate</label>
                    <div class="invalid-feedback">
                    Please select interest rate.
                    </div>
                  </div>  
                </div>

                <div class="col">
                  <div class="form-floating mb-3 ">
                    <select class=" form-control rounded-0 shadow-sm border-left-green" name="paymentSched" id="floatingInput" required>
                      <option value="" disabled selected hidden>Choose payment schedule</option> 
                      <option value="5">weekdays</option>
                      <option value="2">weekends</option>
                    </select>
                    <label for="floatingInput">Payment Schedule</label>
                    <div class="invalid-feedback">
                    Please select payment schedule.
                    </div>
                  </div>  
                </div>

                <div class="w-100"></div>

                <div class="col">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                    <label class="form-check-label" for="invalidCheck">
                      Agree to <a href="">terms and conditions</a> 
                    </label>
                    <div class="invalid-feedback">
                      You must agree before submitting.
                    </div>
                  </div>
                </div>

                <div class="col-12 mt-3">
                  <button class="btn btn-color" type="submit">Submit</button>
                </div>

              </div>
            </div>
          </form>
        </div>
        <div class="card-footer text-end">
          <small>&copy; Lending Management System</small>
        </div>
      </div>
    </div>
  </div>

   <!-- JavaScript -->
  <script src="js/bootstrap.min.js"></script>
  
  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.prototype.slice.call(forms)
        .forEach(function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }

            form.classList.add('was-validated')
          }, false)
        })
    })()
  </script>
</body>
</html>
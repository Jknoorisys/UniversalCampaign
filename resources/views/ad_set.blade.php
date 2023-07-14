<!DOCTYPE html>
<html>

<head>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

  {{-- Theme --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap.min.css') }}">

  {{-- Fontawsome --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style>
    * {
      box-sizing: border-box;
    }

    #regForm {
      background-color: #ffffff;
      margin: 100px auto;
      font-family: Raleway;
      padding: 40px;
      width: 70%;
      min-width: 300px;
      border-radius: 10px;
    }

    input {
      font-family: Raleway;
    }

    /* Mark input boxes that gets an error on validation: */
    input.invalid {
      background-color: #ffdddd;
    }

    /* Hide all steps by default: */
    .tab {
      display: none;
    }

    /* Make circles that indicate the steps of the form: */
    .step {
      height: 15px;
      width: 15px;
      margin: 0 2px;
      background-color: #bbbbbb;
      border: none;
      border-radius: 50%;
      display: inline-block;
      opacity: 0.5;
    }

    .step.active {
      opacity: 1;
      background-color: #7b8ab8
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
      background-color: #5b62f4;
      opacity: 1;
    }
  </style>
  <script>
    function showSubRadioButtons() {
      var colorRadio = document.getElementsByName("object");
      var subRadioDivfb = document.getElementById("subRadioDivfb");

      if (colorRadio[0].checked) {
        subRadioDivfb.style.display = "block";
      } else {
        subRadioDivfb.style.display = "none";
      }
    }
  </script>
</head>

<body>

  <div class="container">
    <div class="row col-12 justify-content-center">
      <form id="regForm" method="POST" action="{{ url('createCampaign') }}">
        @csrf

        <h3 class="text mb-4" style="font-weight: bold">Create Adsets</h3>
        <!-- One "tab" for each step in the form: -->
        <div class="tab">
          <div class="form-group">
            <div class="row">
              <div class="col-6">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="name" name="name" placeholder="Campaign Name" required>
                  <label for="name">Adset Name</label>
                </div>
              </div>
              <div class="col-6">
                <div class="form-floating">
                  <input type="datetime-local" class="form-control" id="startTime" name="start_time" placeholder="Campaign Start Time" required>
                  <label for="startTime">Adset Start Time</label>
                </div>
              </div>
              <div class="col-6">
                <div class="form-floating">
                  <input type="datetime-local" class="form-control" id=amount" name="bid_amount" placeholder="bid Amount" required>
                  <label for="bid_amount">Bid Amount</label>
                </div>
              </div>
            </div>
            <fieldset class="form-group">
              <h6 class="mt-4" style="font-weight: bold">Select Object</h6>
              <div class="row">
                <div class="col-3">
                  <label class="mb-2">FaceBook</label>
                  <div class="form-check">
                    <label>Optmization Goal:</label>
                    <input class="form-check-input" type="radio" id="red" name="object" value="OPTMIZATION_GOALS" onclick="showSubRadioButtons()">
                  </div>
                  <div class="form-check">
                  <label>Billing Event:</label>
                    <input class="form-check-input" type="radio" id="blue" name="object" value="ADD_RECALL_LIFT" onclick="showSubRadioButtons()">
                  </div>
                  <div class="form-check">
                  <label>Budget:</label>
                    <input class="form-check-input" type="radio" id="green" name="object" value="OFFSITE_CONVERSIONS" onclick="showSubRadioButtons()">
                  </div>
                  <div class="form-check">
                  <label>Targeting:</label>
                    <input class="form-check-input" type="radio" id="green" name="object" value="OFFSITE_CONVERSIONS" onclick="showSubRadioButtons()">
                  </div><br><br >
                  <div id="subRadioDivfb" style="display: none;">
                    <p>Select Optimization Goals:</p>
                    <input class="form-check-input" type="radio" id="light-red" name="shade" value="APP_INSTALLS">
                    <label for="light-red">APP INSTALLS</label><br>
                    <input class="form-check-input" type="radio" id="dark-red" name="shade" value="AD_RECALL_LIFT">
                    <label for="dark-red">AD_RECALL_LIFT</label>
                  </div>
                </div>
                <div class="col-3">
                  <label class="mb-2">SnapChat</label>
                  <div class="col-3">
                  <div class="form-check">
                    <p>Select a color:</p>
                    <input class="form-check-input" type="radio" id="red" name="object" value="red" onclick="showSubRadioButtons()">
                    <label for="red">Red</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" id="blue" name="object" value="blue" onclick="showSubRadioButtons()">
                    <label for="blue">Blue</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" id="green" name="object" value="green" onclick="showSubRadioButtons()">
                    <label for="green">Green</label>
                  </div>
                  <div id="subRadioDivsc" style="display: none;">
                    <p>Select a shade of red:</p>
                    <input class="form-check-input" type="radio" id="light-red" name="shade" value="light-red">
                    <label for="light-red">Light Red</label>
                    <input class="form-check-input" type="radio" id="dark-red" name="shade" value="dark-red">
                    <label for="dark-red">Dark Red</label>
                  </div>
                </div>
                </div>
               
              </div>
            </fieldset>
          </div>
        </div>
        <div class="tab">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="myCheck" onclick="myFunction()">
            <label class="form-check-label" for="myCheck">Set an End Date (Optional)</label>
          </div>
          <div class="row mt-2" id="text" style="display:none">
            <div class="form-floating">
              <input type="datetime-local" class="form-control" id="endTime" name="end_time" placeholder="Campaign End Time">
              <label for="endTime">Campaign End Time</label>
            </div>
          </div>
          <div class="row mt-2">
            <label class="mb-2">Budget</label>
            <div class="col-6">
              <div class="form-floating mb-3">
                <input type="number" step="0.1" class="form-control" id="daily_cpc" name="daily_cpc" placeholder="Daily Spend Cap" required>
                <label for="name">Daily Spend Cap</label>
              </div>
            </div>
            <div class="col-6">
              <div class="form-floating mb-3">
                <input type="number" step="0.1" class="form-control" id="lifetime_cpc" name="lifetime_cpc" placeholder="Lifetime Spend Cap" required>
                <label for="name">Lifetime Spend Cap</label>
              </div>
            </div>
          </div>
        </div>
        <div style="overflow:auto;" class="mt-2">
          <div style="float:right;">
            <button type="button" class="btn btn-primary btn-sm" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
            <button type="button" class="btn btn-outline-info btn-sm" id="nextBtn" onclick="nextPrev(1)">Next</button>
          </div>
        </div>
        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-top:40px;">
          <span class="step"></span>
          <span class="step"></span>
        </div>
      </form>
    </div>
  </div>

  <script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
      // This function will display the specified tab of the form...
      var x = document.getElementsByClassName("tab");
      x[n].style.display = "block";
      //... and fix the Previous/Next buttons:
      if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
      } else {
        document.getElementById("prevBtn").style.display = "inline";
      }

      if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Submit";
        document.getElementById("nextBtn").type = "submit";
      } else {
        document.getElementById("nextBtn").innerHTML = "Next";
      }
      //... and run a function that will display the correct step indicator:
      fixStepIndicator(n)
    }

    function nextPrev(n) {
      // This function will figure out which tab to display
      var x = document.getElementsByClassName("tab");
      // Exit the function if any field in the current tab is invalid:
      if (n == 1 && !validateForm()) return false;
      // Hide the current tab:
      x[currentTab].style.display = "none";
      // Increase or decrease the current tab by 1:
      currentTab = currentTab + n;
      // if you have reached the end of the form...
      if (currentTab >= x.length) {
        // ... the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
      }
      // Otherwise, display the correct tab:
      showTab(currentTab);
    }

    function validateForm() {
      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      x = document.getElementsByClassName("tab");
      y = x[currentTab].getElementsByTagName("input");
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
          // add an "invalid" class to the field:
          y[i].className += " invalid";
          // and set the current valid status to false
          valid = false;
        }
      }
      // If the valid status is true, mark the step as finished and valid:
      if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
      }
      return valid; // return the valid status
    }

    function fixStepIndicator(n) {
      // This function removes the "active" class of all steps...
      var i, x = document.getElementsByClassName("step");
      for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
      }
      //... and adds the "active" class on the current step:
      x[n].className += " active";
    }
  </script>

  <script>
    function myFunction() {
      var checkBox = document.getElementById("myCheck");
      var text = document.getElementById("text");
      if (checkBox.checked == true) {
        text.style.display = "block";
      } else {
        text.style.display = "none";
      }
    }
  </script>
</body>

</html>
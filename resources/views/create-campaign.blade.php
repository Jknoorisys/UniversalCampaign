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
</head>
<body>

  <div class="container">
    <div class="row col-12 justify-content-center">
        <form id="regForm" method="POST" action="{{ url('createCampaign') }}">
          @csrf

          <h3 class="text mb-4" style="font-weight: bold">Create Campaign</h3>
          <!-- One "tab" for each step in the form: -->
          <div class="tab">
              <div class="form-group">
                  <div class="row">
                      <div class="col-6">
                          <div class="form-floating mb-3">
                              <input type="text" class="form-control" id="name" name="name" placeholder="Campaign Name" required>
                              <label for="name">Campaign Name</label>
                          </div>
                      </div>
                      <div class="col-6">
                          <div class="form-floating">
                              <input type="datetime-local" class="form-control" id="startTime" name="start_time" placeholder="Campaign Start Time" required>
                              <label for="startTime">Campaign Start Time</label>
                          </div>
                      </div>
                  </div>
                  <fieldset class="form-group">
                      <h6 class="mt-4" style="font-weight: bold">Select Objective</h6>
                      <div class="row">
                        <div class="col-3">
                          <label class="mb-2">Google</label>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="google_objective" id="optionsRadios1" value="SEARCH" checked="">
                            <label class="form-check-label" for="optionsRadios1">SEARCH</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="google_objective" id="optionsRadios2" value="DISPLAY">
                            <label class="form-check-label" for="optionsRadios2">DISPLAY</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="google_objective" id="optionsRadios3" value="SHOPPING">
                            <label class="form-check-label" for="optionsRadios3">SHOPPING</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="google_objective" id="optionsRadios4" value="HOTEL">
                            <label class="form-check-label" for="optionsRadios4">HOTEL</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="google_objective" id="optionsRadios5" value="VIDEO">
                            <label class="form-check-label" for="optionsRadios5">VIDEO</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="google_objective" id="optionsRadios6" value="MULTI_CHANNEL">
                            <label class="form-check-label" for="optionsRadios5">MULTI_CHANNEL</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="google_objective" id="optionsRadios7" value="LOCAL">
                            <label class="form-check-label" for="optionsRadios5">LOCAL</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="google_objective" id="optionsRadios8" value="SMART">
                            <label class="form-check-label" for="optionsRadios5">SMART</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="google_objective" id="optionsRadios9" value="PERFORMANCE_MAX">
                            <label class="form-check-label" for="optionsRadios5">PERFORMANCE_MAX</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="google_objective" id="optionsRadios10" value="LOCAL_SERVICES">
                            <label class="form-check-label" for="optionsRadios5">LOCAL_SERVICES</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="google_objective" id="optionsRadios11" value="DISCOVERY">
                            <label class="form-check-label" for="optionsRadios5">DISCOVERY</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="google_objective" id="optionsRadios12" value="TRAVEL">
                            <label class="form-check-label" for="optionsRadios5">TRAVEL</label>
                          </div>
                        </div>
                        <div class="col-3">
                          <label class="mb-2">FB/Instagram</label>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="fb_objective" id="optionsRadios1" value="OUTCOME_APP_PROMOTION" checked>
                            <label class="form-check-label" for="optionsRadios1">APP PROMOTION</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="fb_objective" id="optionsRadios2" value="OUTCOME_AWARENESS">
                            <label class="form-check-label" for="optionsRadios2">OUTCOME AWARENESS</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="fb_objective" id="optionsRadios3" value="OUTCOME_ENGAGEMENT">
                            <label class="form-check-label" for="optionsRadios3">ENGAGEMENT</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="fb_objective" id="optionsRadios4" value="OUTCOME_LEADS">
                            <label class="form-check-label" for="optionsRadios4">LEADS</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="fb_objective" id="optionsRadios5" value="OUTCOME_SALES">
                            <label class="form-check-label" for="optionsRadios5">SALES</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="fb_objective" id="optionsRadios6" value="OUTCOME_TRAFFIC">
                            <label class="form-check-label" for="optionsRadios6">TRAFFIC</label>
                          </div>
                        </div>
                        <div class="col-3">
                          <label class="mb-2">Snapchat</label>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="snapchat_objective" id="optionsRadios1" value="BRAND_AWARENESS" checked>
                            <label class="form-check-label" for="optionsRadios1">BRAND AWARENESS</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="snapchat_objective" id="optionsRadios2" value="APP_CONVERSION">
                            <label class="form-check-label" for="optionsRadios2">APP CONVERSION</label>
                          </div>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="snapchat_objective" id="optionsRadios3" value="APP_INSTALL">
                              <label class="form-check-label" for="optionsRadios3">APP INSTALL</label>
                          </div>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="snapchat_objective" id="optionsRadios4" value="CATALOG_SALES">
                              <label class="form-check-label" for="optionsRadios4">CATALOG SALES</label>
                          </div>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="snapchat_objective" id="optionsRadios5" value="ENGAGEMENT">
                              <label class="form-check-label" for="optionsRadios5">ENGAGEMENT</label>
                          </div>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="snapchat_objective" id="optionsRadios6" value="LEAD_GENERATION">
                              <label class="form-check-label" for="optionsRadios6">LEAD GENERATION</label>
                          </div>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="snapchat_objective" id="optionsRadios7" value="VIDEO_VIEW">
                              <label class="form-check-label" for="optionsRadios7">VIDEO VIEW</label>
                          </div>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="snapchat_objective" id="optionsRadios8" value="WEB_CONVERSION">
                              <label class="form-check-label" for="optionsRadios8">WEB CONVERSION</label>
                          </div>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="snapchat_objective" id="optionsRadios9" value="PROMOTE_STORIES">
                              <label class="form-check-label" for="optionsRadios9">PROMOTE STORIES</label>
                          </div>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="snapchat_objective" id="optionsRadios10" value="PROMOTE_PLACES">
                              <label class="form-check-label" for="optionsRadios10">PROMOTE PLACES</label>
                          </div>
                        </div>
                        <div class="col-3">
                          <label class="mb-2">Tiktok</label>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="tiktok_objective" id="optionsRadios6" value="REACH" checked>
                              <label class="form-check-label" for="optionsRadios6">REACH</label>
                          </div>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="tiktok_objective" id="optionsRadios7" value="TRAFFIC">
                              <label class="form-check-label" for="optionsRadios7">TRAFFIC</label>
                          </div>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="tiktok_objective" id="optionsRadios8" value="VIDEO_VIEWS">
                              <label class="form-check-label" for="optionsRadios8">VIDEO VIEWS</label>
                          </div>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="tiktok_objective" id="optionsRadios9" value="LEAD_GENERATION">
                              <label class="form-check-label" for="optionsRadios9">LEAD GENERATION</label>
                          </div>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="tiktok_objective" id="optionsRadios10" value="ENGAGEMENT">
                              <label class="form-check-label" for="optionsRadios10">ENGAGEMENT</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="tiktok_objective" id="optionsRadios10" value="APP_PROMOTION">
                            <label class="form-check-label" for="optionsRadios10">APP PROMOTION</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="tiktok_objective" id="optionsRadios10" value="WEB_CONVERSIONS">
                            <label class="form-check-label" for="optionsRadios10">WEB CONVERSIONS</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="tiktok_objective" id="optionsRadios10" value="PRODUCT_SALES">
                            <label class="form-check-label" for="optionsRadios10">PRODUCT SALES</label>
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
      if (checkBox.checked == true){
        text.style.display = "block";
      } else {
        text.style.display = "none";
      }
    }
  </script>
</body>
</html>

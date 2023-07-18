<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Snapchat</title>

        {{-- Theme --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap.min.css') }}">

        {{-- Fontawsome --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        {{-- Bootstrap CDN --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        {{-- Multiple Select --}}
        <link href="{{ asset('css/mobiscroll.javascript.min.css') }}" rel="stylesheet" />
        <script src="{{ asset('js/mobiscroll.javascript.min.js') }}"></script> 

        <style>
            .md-country-picker-item {
                position: relative;
                line-height: 20px;
                padding: 10px 0 10px 40px;
            }

            .md-country-picker-flag {
                position: absolute;
                left: 0;
                height: 20px;
            }

            .mbsc-scroller-wheel-item-2d .md-country-picker-item {
                transform: scale(1.1);
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row col-12 justify-content-center mt-5">
                <div class="card">
                    <div class="card-header text-info"><h3>Create Ad Group</h3></div>
                    <div class="card-body">
                        <form action="{{ url('snapchat/create-ad-group') }}" method="POST">
                            @csrf
                            <input type="hidden" name="campaign_id" value="{{ $campaign_id }}">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Ad Group Name" required>
                                            <label for="name">Ad Group Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                   <div class="col-2">
                                        <label for=""><h6 class="mt-4">Ad Squad Type</h6></label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="type1" value="SNAP_ADS" checked="">
                                            <label class="form-check-label" for="type1">SNAP ADS</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="type2" value="LENS">
                                            <label class="form-check-label" for="type2">LENS</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="type3" value="FILTER">
                                            <label class="form-check-label" for="type3">FILTER</label>
                                        </div>
                                   </div>
                                   <div class="col-4">
                                        <label for=""><h6 class="mt-4">Placements</h6></label>
                                        <div class="form-check">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="config" id="automatic" onclick="myFunction()" value="AUTOMATIC" checked>
                                                <label class="form-check-label" for="automatic">Automatic Placement(Recommended)</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="config" id="custom" onclick="myFunction()" value="CUSTOM">
                                                <label class="form-check-label" for="custom">Custom Placement</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 mt-4" id="placement" style="visibility:hidden">
                                        <label for=""><h6 class="mt-4">Placement Types</h6></label>
                                        <div class="form-check">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="placement" id="placement1" value="INTERSTITIAL_USER" checked>
                                                <label class="form-check-label" for="placement1">INTERSTITIAL USER</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="placement2" name="placement" value="INTERSTITIAL_CONTENT">
                                                <label class="form-check-label" for="placement2">INTERSTITIAL CONTENT</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="placement" id="placement3" value="INTERSTITIAL_SPOTLIGHT">
                                                <label class="form-check-label" for="placement3">INTERSTITIAL SPOTLIGHT</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="placement4" name="placement" value="INSTREAM">
                                                <label class="form-check-label" for="placement4">INSTREAM</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="placement" id="placement5" value="FEED">
                                                <label class="form-check-label" for="placement5">FEED</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="placement6" name="placement" value="CAMERA">
                                                <label class="form-check-label" for="placement6">CAMERA</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <fieldset class="form-group">
                                    <label for=""><h6 class="mt-4">Choose Optimization Goal</h6></label>
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="objective" id="objective1" value="IMPRESSIONS" checked="">
                                                <label class="form-check-label" for="objective1">IMPRESSIONS</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="objective" id="objective2" value="SWIPES">
                                                <label class="form-check-label" for="objective2">SWIPES</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="objective" id="objective3" value="APP_INSTALLS">
                                                <label class="form-check-label" for="objective3">APP INSTALLS</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="objective" id="objective4" value="VIDEO_VIEWS">
                                                <label class="form-check-label" for="objective4">VIDEO VIEWS (2 SEC)</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="objective" id="objective5" value="VIDEO_VIEWS_15_SEC">
                                                <label class="form-check-label" for="objective5">VIDEO VIEWS (15 SEC)</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="objective" id="objective6" value="USES">
                                                <label class="form-check-label" for="objective6">USES</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="objective" id="objective7" value="STORY_OPENS">
                                                <label class="form-check-label" for="objective7">STORY OPENS</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="objective" id="objective8" value="PIXEL_PAGE_VIEW">
                                                <label class="form-check-label" for="objective8">PIXEL PAGE VIEW</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="objective" id="objective9" value="PIXEL_ADD_TO_CART">
                                                <label class="form-check-label" for="objective9">PIXEL ADD TO CART</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="objective" id="objective10" value="PIXEL_PURCHASE">
                                                <label class="form-check-label" for="objective10">PIXEL PURCHASE</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="objective" id="objective11" value="PIXEL_SIGNUP">
                                                <label class="form-check-label" for="objective11">PIXEL SIGNUP</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="objective" id="objective12" value="APP_ADD_TO_CART">
                                                <label class="form-check-label" for="objective12">APP ADD TO CART</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="objective" id="objective13" value="APP_PURCHASE">
                                                <label class="form-check-label" for="objective13">APP PURCHASE</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="objective" id="objective14" value="APP_SIGNUP">
                                                <label class="form-check-label" for="objective14">APP SIGNUP</label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                {{-- <div class="row">
                                    <label class="mt-4"><h6>Targeting</h6></label>
                                    <div class="col-4">
                                        <label>
                                            Countries
                                            <input mbsc-input id="demo-multiple-select-input" placeholder="Please select..." data-dropdown="true" data-input-style="outline" data-label-style="stacked" data-tags="true" name="countries[]" />
                                        </label>
                                        <select id="demo-multiple-select" multiple>
                                        </select>  
                                    </div>                                 
                                </div> --}}
                                <div class="row">
                                    <div class="col-6">
                                        <label for=""><h6 class="mt-4">Bid</h6></label>
                                        <div class="form-check">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="bid_strategy" id="auto_bid" onclick="myFunction1()" value="AUTO_BID" checked>
                                                <label class="form-check-label" for="auto_bid">Auto Bid (Recommended)</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="bid_strategy" id="max_bid_checked" onclick="myFunction1()" value="LOWEST_COST_WITH_MAX_BID">
                                                <label class="form-check-label" for="max_bid_checked">Max Bid</label>
                                            </div>
                                            <div class="form-floating mb-3" id="max_bid" style="visibility: hidden;">
                                                <input type="number" step="0.1" class="form-control" id="max_bid" name="max_bid" placeholder="Max Bid (per 1000 Impressions)">
                                                <label for="max_bid">Max Bid (per 1000 Impressions)</label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-6 mt-4" id="placement" style="visibility:hidden">
                                        <label for=""><h6 class="mt-4">Placement Types</h6></label>
                                        <div class="form-check">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="placement" id="placement1" value="INTERSTITIAL_USER" checked>
                                                <label class="form-check-label" for="placement1">INTERSTITIAL USER</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="placement2" name="placement" value="INTERSTITIAL_CONTENT">
                                                <label class="form-check-label" for="placement2">INTERSTITIAL CONTENT</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="placement" id="placement3" value="INTERSTITIAL_SPOTLIGHT">
                                                <label class="form-check-label" for="placement3">INTERSTITIAL SPOTLIGHT</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="placement4" name="placement" value="INSTREAM">
                                                <label class="form-check-label" for="placement4">INSTREAM</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="placement" id="placement5" value="FEED">
                                                <label class="form-check-label" for="placement5">FEED</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="placement6" name="placement" value="CAMERA">
                                                <label class="form-check-label" for="placement6">CAMERA</label>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <a href="{{ url('snapchat/get-all-campaigns') }}" class="btn btn-secondary">Close</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<script>
    function myFunction() {
        if (document.getElementById('custom').checked) {
            document.getElementById('placement').style.visibility = 'visible';
        }else 
            document.getElementById('placement').style.visibility = 'hidden';
    }

    function myFunction1() {
        if (document.getElementById('max_bid_checked').checked) {
            document.getElementById('max_bid').style.visibility = 'visible';
        }else 
            document.getElementById('max_bid').style.visibility = 'hidden';
    }

    mobiscroll.setOptions({
        theme: 'ios',
        themeVariant: 'light'
    });

    var inst = mobiscroll.select('#demo-multiple-select', {
        display: 'anchored',
        filter: true,
        itemHeight: 40,
    });

    mobiscroll.util.http.getJson('https://trial.mobiscroll.com/content/countries.json', function (resp) {
        var countries = [];
        for (var i = 0; i < resp.length; ++i) {
            var country = resp[i];
            countries.push({ text: country.text, value: country.value });
        }
        inst.setOptions({ data: countries });
    });

    // Add this function to capture the selected values and update the hidden input field
    function updateSelectedValues() {
  var selectedValues = inst.getVal(); // Get the selected values
  var countryCodes = selectedValues.map(function(item) {
    return item.value.split(',')[0].trim(); // Extract the country code from each selected value
  });
  document.getElementById('selected-values').value = countryCodes.join(','); // Update the hidden input field
}

mobiscroll.select('#demo-multiple-select', {
  inputElement: document.getElementById('demo-multiple-select-input'),
  onChange: updateSelectedValues // Call the function when the selection changes
});
    
</script>

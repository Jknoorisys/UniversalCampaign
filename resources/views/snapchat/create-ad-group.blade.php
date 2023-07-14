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
                                <div class="col-6">
                                    
                                </div>
                            </div>
                            <div class="row">
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
                        </div>
                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <a href="{{ url('snapchat/get-all-campaigns/' . $ad_account_id) }}" class="btn btn-secondary">Close</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
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
                <div class="card-header text-info"><h3>Create Campaigns</h3></div>
                <div class="card-body">
                    <form action="{{ url('snapchat/create-campaign') }}" method="POST">
                        @csrf
                        <input type="hidden" name="ad_account_id" value="{{ $ad_account_id }}">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Camaoign Name" required>
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
                                <legend class="mt-4">Slecte Objective</legend>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="objective" id="optionsRadios1" value="BRAND_AWARENESS" checked="">
                                            <label class="form-check-label" for="optionsRadios1">BRAND AWARENESS</label>
                                          </div>
                                          <div class="form-check">
                                            <input class="form-check-input" type="radio" name="optionsRadios" id="optionsRadios2" value="APP_CONVERSION">
                                            <label class="form-check-label" for="optionsRadios2">APP CONVERSION</label>
                                          </div>
                                          <div class="form-check">
                                              <input class="form-check-input" type="radio" name="objective" id="optionsRadios3" value="APP_INSTALL">
                                              <label class="form-check-label" for="optionsRadios3">APP INSTALL</label>
                                          </div>
                                          <div class="form-check">
                                              <input class="form-check-input" type="radio" name="objective" id="optionsRadios4" value="CATALOG_SALES">
                                              <label class="form-check-label" for="optionsRadios4">CATALOG SALES</label>
                                          </div>
                                          <div class="form-check">
                                              <input class="form-check-input" type="radio" name="objective" id="optionsRadios5" value="ENGAGEMENT">
                                              <label class="form-check-label" for="optionsRadios5">ENGAGEMENT</label>
                                          </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="objective" id="optionsRadios6" value="LEAD_GENERATION">
                                            <label class="form-check-label" for="optionsRadios6">LEAD GENERATION</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="objective" id="optionsRadios7" value="VIDEO_VIEW">
                                            <label class="form-check-label" for="optionsRadios7">VIDEO VIEW</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="objective" id="optionsRadios8" value="WEB_CONVERSION">
                                            <label class="form-check-label" for="optionsRadios8">WEB CONVERSION</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="objective" id="optionsRadios9" value="PROMOTE_STORIES">
                                            <label class="form-check-label" for="optionsRadios9">PROMOTE STORIES</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="objective" id="optionsRadios10" value="PROMOTE_PLACES">
                                            <label class="form-check-label" for="optionsRadios10">PROMOTE PLACES</label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
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
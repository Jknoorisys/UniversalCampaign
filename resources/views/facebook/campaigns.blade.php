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
                <div class="card-header text-info"><h3>Campaigns</h3></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-11"></div>
                        <div class="col-1 mb-1">
                            <a href="{{ url('facebook/create-campaign-form/ . $ad_account_id)') }}"><i class="fa fa-plus" style="font-size:24px"></i></a>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead class="text-center">
                            <th>Name</th>
                           
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @if (!empty($campaigns))
                                @foreach ($campaigns as $campaign )
                                    <tr class="text-center">
                                        <td>{{ $campaign['id'] }}</td>
                                        
                                        <td><a href="{{ url('facebook/get-all-campaigns/  . $campaign['id'] ') }}"><i class="fa fa-ellipsis-h" style="font-size:24px"></i></a></td>
                                    </tr>
                                @endforeach 
                            @else
                                <tr class="text-center">
                                    <td colspan="5"><h6 class="text-danger">No Campaign Found!</h6></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


  
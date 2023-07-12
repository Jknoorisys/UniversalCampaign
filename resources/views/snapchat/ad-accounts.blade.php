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
</head>
<body>
    <div class="container">
        <div class="row col-12 justify-content-center mt-5">
            <div class="card">
                <div class="card-header text-info"><h3>Ad Accounts</h3></div>
                <div class="card-body">
                    <table class="table">
                        <thead class="text-center">
                            <th>Name</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @if ($addAccounts)
                                @foreach ($addAccounts as $addAccount )
                                    <tr class="text-center">
                                        <td>{{ $addAccount['adaccount']['name'] }}</td>
                                        <td>{{ $addAccount['adaccount']['type'] }}</td>
                                        <td>{{ $addAccount['adaccount']['status'] }}</td>
                                        <td><a href="{{ url('snapchat/get-all-campaigns/' . $addAccount['adaccount']['id']) }}"><i class="fa fa-ellipsis-h" style="font-size:24px"></i></a></td>
                                    </tr>
                                @endforeach 
                            @else
                                <tr class="text-center">
                                    <td colspan="5"><h6 class="text-danger">No Add Account Found!</h6></td>
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
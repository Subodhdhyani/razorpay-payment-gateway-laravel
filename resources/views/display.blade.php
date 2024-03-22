<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refund Page</title>
    <link rel="stylesheet" type="text/css" href="{{url('bootstrap/css/bootstrap.min.css')}}">
</head>
<body>
@if(session('success'))
    <div class="alert alert-success" role="alert">
            {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger" role="alert">
            {{ session('error') }}
    </div>
@endif

<a href="{{url('/')}}" class="btn btn-danger mb-4 mt-2">Make Payment</a>
    <h1 class="text-center">Make Refund</h1>
        <div class="container">
  <table class="table table-hover table-bordered">
  <thead>
    <tr>
      <th scope="col">Booking No</th>
      <th scope="col">Product Name</th>
      <th scope="col">Amount</th>
      <th scope="col">Refund</th>
    </tr>
  </thead>
  <tbody>
    @foreach($show as $record)
    <tr>
      <td>{{$record->booking_number}}</td>
      <td>{{$record->product_name}}</td>
      <td>{{$record->amount}}</td>
      <td><a href="{{ route('refund',$record->id) }}" class="btn btn-success">Refund</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>


    <script src="{{url('bootstrap/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>    
</body>
</html>
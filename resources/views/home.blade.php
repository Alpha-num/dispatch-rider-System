<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>

.custom-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.custom-table th, .custom-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

.custom-table th {
    background-color: #f2f2f2;
}

.custom-table tbody tr:hover {
    background-color: #f5f5f5;
}


</style>
<body>

<h3>Welcome, {{Auth::user()->name}}</h3>

<p>
        <a class="logout-link" href="#" onsubmit="logout()">
            <form method="POST" id="logout-form" action="{{ route('logout') }}">
                @csrf
                <button type="submit text-white" class="px-0">
                    Logout
                </button>
            </form>
            <span>
                <i class="fa fa-sign-out"></i>
            </span>
        </a>
</p>

  @if(Gate::check('isUser'))
        @if(session('booking_success'))
                    <script>
                        alert("{{ session('booking_success') }}");
                    </script>
        @endif

            <p><a href="{{route('booking.create')}}">Book a ride</a></p>

            <br>

            <h3>All your bookings are shown here</h3>
            @if(Auth::user()->bookings->count() === 0)
                <p>You have not made any Bookings yet</p>
            @else 
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Destination</th>
                            <th>item</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Auth::user()->bookings as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->destination }}</td>
                                <td> {{ $booking->item_name}}</td>
                                <td> {{$booking->item_quantity}} </td>
                                <td> {{$booking->completed ? 'Completed' : 'Pending'}} </td>
                                <td>{{ $booking->created_at }}</td>
                                <td><a href="{{route('booking.view', $booking->id)}}">View</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

    @else 

        <p>You are logged in as a <strong>{{Auth::user()->role}}</strong> </p>
        @if(session('ride_success'))
            <script>
                alert("{{ session('ride_success') }}");
            </script>
        @endif
        @if(session('ride_completed'))
            <script>
                alert("{{ session('ride_completed') }}");
            </script>
        @endif
        
        <a href="{{route('rides.index')}}">View Available Rides </a>

        <h2>All your Rides</h2>
        <table class="table custom-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Destination</th>
                            <th>Departure Time</th>
                            <th>Status</th>
                            <th>Mark as complete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Auth::user()->rides as $ride)
                            <tr>
                                <td>{{ $ride->id }}</td>
                                <td>{{ $ride->booking->destination }}</td>
                                <td>{{$ride->departure_time}}</td>
                                <td> {{$ride->completed ? 'Completed' : 'Pending'}} </td>
                                <td>
                                    @if (!$ride->completed)
                                        <form action="{{ route('ride.complete') }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="ride_id" value="{{$ride->id}}" />
                                            <button type="submit">Complete</button>
                                        </form>
                                    @else
                                        <span>Completed</span>
                                    @endif
                                </td>
                                <td><a href="{{route('ride.view', $ride->id)}}">View</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <br>

                <p><a href="{{route('ratings.index')}}">Click</a> to see your ratings</p>
        

    @endif
        
</body>
</html>
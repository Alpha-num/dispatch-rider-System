<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>

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
</head>
<body>
<div class="container">

        @if(session('booking_completed'))
            <script>
                alert("{{session('booking_completed')}}")
            </script>
        @endif

        <h3>Booking Details</h3>

        <p><strong>ID:</strong> {{ $booking->id }}</p>
        <p><strong>Destination:</strong> {{ $booking->destination }}</p>
        <p><strong>Item:</strong> {{ $booking->item_name }}</p>
        <p><strong>Quantity:</strong> {{ $booking->item_quantity }}</p>
        <p><strong>Status:</strong> {{ $booking->completed ? 'Completed' : 'Pending' }}</p>
        <p><strong>Created At:</strong> {{ $booking->created_at }}</p>


        <h3>Ride Details</h3>
        @if ($booking->ride)

        <table class="table custom-table">
                <thead>
                    <tr>
                        <th>Ride ID</th>
                        <th>Rider Name</th>
                        <th>Departure Time</th>
                        <th>Ride Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>{{$booking->ride->id}}</td>
                            <td>{{ $rider->name }}</td>
                            <td>{{ $booking->ride->departure_time }}</td>
                            <td>{{ $booking->ride->completed ? 'Completed' : 'pending' }}</td>
                            <td>
                                @if (!$booking->completed)
                                    <form action="{{ route('booking.complete') }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="booking_id" value="{{$booking->id}}" />
                                        <button type="submit">Accept</button>
                                    </form>
                                @else
                                    <span>Accepted</span>
                                @endif
                            </td>
                            <td> 
                                @if($booking->completed)
                                    <a href="{{ route('rating.create', $rider->id) }}">Rate rider</a>
                                @endif
                            </td>
                        </tr>
                </tbody>
            </table>
            
        @else

            <p>No ride found for this booking yet.</p>
        @endif
    </div>
</body>
</html>
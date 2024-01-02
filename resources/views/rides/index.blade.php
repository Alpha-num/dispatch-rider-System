<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
    <h2>All Rides</h2>

    <div class="container">

        @if ($bookings->isEmpty())
            <p>No pending bookings found.</p>
        @else
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Destination</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>{{ $booking->destination }}</td>
                            <td>{{ $booking->item_name }}</td>
                            <td>{{ $booking->item_quantity }}</td>
                            <td>{{ $booking->completed ? 'Completed' : 'Pending' }}</td>
                            <td>{{ $booking->created_at }}</td>
                            <td>
                                @if (!$booking->ride)
                                    <a href=" {{ route('ride.accept', $booking->id) }}">Accept</a>
                                @else
                                    <span>Ride already accepted</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>

</body>
</html>
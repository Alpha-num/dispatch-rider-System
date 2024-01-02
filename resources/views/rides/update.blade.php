<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h5>Booking Details </h5>
    <p> <strong> Destination </strong>: {{$ride->booking->destination}} </p>
    <p><strong>Item Name : </strong> {{$ride->booking->item_name}}</p>
    <p><strong>Item Quantity : </strong> {{$ride->booking->item_quantity}} </p>


    <div class="container">
        <h2>Update Ride</h2>

        <form action="{{ route('ride.update') }}" method="POST">
            @csrf
            @method('PATCH')

            <div>
                <label for="departure_time">Departure Time:</label>
                <input type="datetime-local" id="departure_time" name="departure_time" value="{{ old('departure_time', Carbon\Carbon::parse($ride->departure_time)->format('Y-m-d\TH:i')) }}" required>
                <input type="hidden" name="ride_id" value="{{$ride->booking->id}}" />
            </div>
            <br>

            @if($ride->completed)

                <button type="submit" disabled>Completed</button>
            @else 
                <button type="submit">Mark as Completed</button>
            @endif 
        </form>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h5>Booking Details </h5>
    <p> <strong> Destination </strong>: {{$booking->destination}} </p>
    <p><strong>Item Name : </strong> {{$booking->item_name}}</p>
    <p><strong>Item Quantity : </strong> {{$booking->item_quantity}} </p>


    <div class="container">
        <h2>Create Ride</h2>

        <form action="{{ route('rides.store') }}" method="POST">
            @csrf

            <div>
                <label for="departure_time">Departure Time:</label>
                <input type="datetime-local" id="departure_time" name="departure_time" required>
                <input type="hidden" name="booking_id" value="{{$booking->id}}" />
                
                @error('departure_time')
                    <p style="color: red;">{{$message}}</p>
                @enderror
            </div>
            <br>
            <button type="submit">Create Ride</button>
        </form>
    </div>
</body>
</html>
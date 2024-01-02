<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
                    
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
}


.ride-form {
    margin-top: 20px;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
}

button {
    background-color: #007bff;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

.invalid-feedback {
    color: #dc3545;
    display: block;
    margin-top: 5px;
    font-size: 12px;
}
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Book a Ride</h2>

            <form method="POST" action="{{ route('booking.store') }}" class="ride-form">
                @csrf

                <div class="form-group">
                    <label for="destination">Destination</label>
                    <input id="destination" type="text" name="destination" required>

                    @error('destination')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="departure_time">Item name</label>
                    <input type="text" name="item_name" required>

                    @error('item_name')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="departure_time">Item Quantity</label>
                    <input type="number" name="item_quantity" required>

                    @error('departure_time')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Book Ride</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ratings</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 12px;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: start;

            height: 100vh;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background-color: #fff;
            border: 1px solid #ddd;
            margin: 10px;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        strong {
            color: #007bff;
        }
    </style>
</head>
<body>
    <h2>Ratings for {{ Auth::user()->name }}</h2>

    @if ($ratings->isEmpty())
        <p>No ratings found.</p>
    @else
        <ul>
            @foreach ($ratings as $rating)
                <li>
                    <strong>Rating:</strong> <strong>Rated by:</strong> {{ $rating->user->name }} gave you a {{ $rating->rating }} Star
                    <br>
                    <strong>Comment:</strong> {{ $rating->comment }}
                    <br>
                    
                </li>
            @endforeach
        </ul>
    @endif

    <p><a href="{{route('home')}}">Home </a></p>
</body>
</html>
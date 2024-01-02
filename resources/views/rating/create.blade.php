<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating System</title>
    <style>
            body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

.rating-container {
    text-align: center;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.stars {
    font-size: 30px;
    cursor: pointer;
}

.star {
    color: #ddd;
    transition: color 0.3s;
}

textarea {
    width: 100%;
    margin: 10px 0;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

#submit-rating {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
    </style>
</head>
<body>
    @if(session('rating_success'))
        <script>
            alert("{{session('rating_success')}}")
        </script>

    @endif
<div class="rating-container">
    <h2>Rate Your Rider</h2>
    <p>Rider Name: {{ $user->name }}</p>
    <div class="stars" id="stars-container">

        <span class="star" data-attribute ="1"> &#9733; </span>
        <span class="star" data-attribute="2"> &#9733; </span>
        <span class="star" data-attribute="3"> &#9733; </span>
        <span class="star" data-attribute="4"> &#9733; </span>
        <span class="star" data-attribute="5"> &#9733; </span>
    </div>

    <form class="reviewForm" method="post" action="{{route('rating.store')}}">
        @csrf
        @method('PUT')
        <textarea id="comment" placeholder="Enter your comment" name="comment"></textarea>
        <input type="hidden" name="rating" class="rating"/>
        <input type="hidden" name="rider_id" value="{{$user->id}}" />
        <button id="submit-rating">Submit Rating</button>

        @if($errors->any)
            <ul style="background-color: yellow;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </form>

    <p><a href="{{route('home')}}">back</a></p>
    
</div>



<script>

document.addEventListener('DOMContentLoaded', function () {
    const starsContainer = document.getElementById('stars-container');
    const stars = document.querySelectorAll('.star');
    const commentInput = document.getElementById('comment');
    const submitButton = document.getElementById('submit-rating');
    const ratingInput = document.querySelector('.rating');
    const rating = 1;

    stars.forEach(star => {
        star.addEventListener('click', ()=>{
           let ratingNumber = star.getAttribute('data-attribute');
            console.log(ratingNumber);
            const rating = getSelectedRating(ratingNumber);
            resetStars();
            setRating(rating);
        });
    })

    submitButton.addEventListener('click', function () {
        
        const comment = commentInput.value;

        ratingInput.value = rating;
        // document.querySelector('.reviewForm').submit();
        

        // Perform your AJAX request to store the rating and comment in the backend
        // Update this part based on your actual API endpoint and data structure
        console.log('Selected Rating:', ratingInput.value);
        console.log('Comment:', comment);
        
    });

    function resetStars() {
        stars.forEach(star => star.style.color = '#ddd');
    }
    
    function getSelectedRating(count){
        return count;
    }

    function setRating(count) {
        for (let i = 0; i < count; i++) {
            stars[i].style.color = '#f8d82e';
        }
    }

});


</script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <title>viewdetails</title>
    <link rel="stylesheet" href=" {{ asset('css/viewdetails.css') }}">
</head>
<body>
    <div class="container">
        <div class="view-details">
            <div class="view-details-head">
              <h2>Company Details</h2>
              <span><i class="fas fa-arrow-right"></i></span>
            </div>
            <div class="view-details-body">
                <div class="profile-container">
                    <div class="profile-pic">
                        <img id="profile-img" src="{{ asset('storage/'.$companyDetails->logo_path) }}" alt="Profile Picture">
                    </div>
                    <div class="profile-info">
                        <h3 class="company-name">{{$companyDetails->company_name}}</h3>
                        <p class="company-type">Service Type: {{$companyDetails->type}}</p>
                        <p class="rating">Rating: 4.5</p>
                        <p class="location">Location: {{$companyDetails->state}}</p>
                        <p class="budget">Budget: {{$companyDetails->budget}} per/day</p>
                    </div>
                </div>
                <div class="crousal-container">
                    <ul class="gallery">
                        <li style="background: #f6bd60;"><img src="images/profile.jpg" alt="image"></li>
                        <li style="background: #f7ede2;"><img src="images/profile.jpg" alt="image"></li>
                        <li style="background: #f5cac3;"><img src="images/profile.jpg" alt="image"></li>
                        <li style="background: #84a59d;"><img src="images/profile.jpg" alt="image"></li>
                        <li style="background: #f28482;"><img src="images/profile.jpg" alt="image"></li>
                    </ul>
                </div>

                <div class="check-availability">
                    <h3>Check Availability</h3>
                    <div class="date-container">
                        <div class="date">
                            <label for="start-date">Start Date</label>
                            <input type="date" id="start-date">
                        </div>
                        <div class="date">
                            <label for="end-date">End Date</label>
                            <input type="date" id="end-date">
                        </div>
                    </div>
                    <div class="check-book"> 
                        <button type="button" class="check">Check</button>
                        <span class="availability">Available</span>
                        <button type="submit" form="payment-form" class="book">Book Now</button>
                        <form action="/user/payment/create" id= "payment-form" method="POST">
                            @csrf
                            <input type="hidden" name="company_id" value="{{$user->id}}">
                            <input type="hidden" name="client_id" value="{{$_SESSION['user']->id}}">
                            <input type="hidden" name="starting_date">
                            <input type="hidden" name="ending_date">
                            <input type="hidden" name="amount">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const slider = document.querySelector('.gallery');
        let isDown = false;
        let startX;
        let scrollLeft;

        slider.addEventListener('mousedown', e => {
        isDown = true;
        slider.classList.add('active');
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
        });
        slider.addEventListener('mouseleave', _ => {
        isDown = false;
        slider.classList.remove('active');
        });
        slider.addEventListener('mouseup', _ => {
        isDown = false;
        slider.classList.remove('active');
        });
        slider.addEventListener('mousemove', e => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        const SCROLL_SPEED = 3;
        const walk = (x - startX) * SCROLL_SPEED;
        slider.scrollLeft = scrollLeft - walk;
        });

        const check = document.querySelector('.check');
        const book = document.querySelector('.book');
        const startDate = document.getElementById('start-date');
        const endDate = document.getElementById('end-date');
        const availability = document.querySelector('.availability');

        check.addEventListener('click', () => {
            let start = new Date(startDate.value);
            let end = new Date(endDate.value);
            let isAvailable = true;

            let companyBookings = @json($companyBookings);

            companyBookings.forEach(booking => {
                let bookingStart = new Date(booking.starting_date);
                let bookingEnd = new Date(booking.ending_date);
                if ((start >= bookingStart && start <= bookingEnd) || (end >= bookingStart && end <= bookingEnd)) {
                    isAvailable = false;
                }
            });
                // calculate total amount by multiplying budget with number of days
                let totalAmount = (((end - start) / (1000 * 60 * 60 * 24))+ 1) * {{$companyDetails->budget}};
            if (isAvailable) {
                availability.style.color = 'green';
                availability.textContent = 'Available';
                availability.style.display = 'block';
                book.style.display = 'block';
                document.querySelector('input[name="amount"]').value = totalAmount;
                document.querySelector('input[name="starting_date"]').value = startDate.value;
                document.querySelector('input[name="ending_date"]').value = endDate.value;
            } else {
                availability.style.color = 'red';
                availability.textContent = 'Not Available';
                availability.style.display = 'block';
                book.style.display = 'none';
            }
        });

        startDate.addEventListener('change', function() {
            hideAvailabilityAndBook();
        });

        endDate.addEventListener('change', function() {
            hideAvailabilityAndBook();
        });

        function hideAvailabilityAndBook() {
            availability.style.display = 'none';
            book.style.display = 'none';
        }
    </script>
</body>
</html>
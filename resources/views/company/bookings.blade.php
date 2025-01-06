{{-- user index blade before login --}}
@extends('layouts.companylayout')
@section('title', 'Bookings')
@section('links')
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
@endsection
@section('content')
      <div class="booking-container">
        <div class="booking-head">
          <button class="booking-filter-btn filter-active" id="all">All</button>
          <button class="booking-filter-btn" id="upcoming">Upcoming</button>
          <button class="booking-filter-btn" id="completed">Completed</button>
          <button class="booking-filter-btn" id="cancelled">Cancelled</button>

          <div class="booking-filter">
            <select name="booking-filter" id="booking-filter">
              <option value="all" selected>All</option>
              <option value="upcoming">Upcoming</option>
              <option value="completed">Completed</option>
              <option value="cancelled">Cancelled</option>
            </select>
          </div>

        </div>
        <div class="booking-card-container">
          @foreach ($userBookings as $booking)
          <div class="booking-card">
            <div class="booking-card-top">
              <span id="bookingId">Booking ID: {{ $booking['booking_id'] }}</span>
              <span id="bookingDate">{{ $booking['booking_date'] }}</span>
            </div>
            <div class="booking-card-bottom">
              <div class="booking-details">

                <table>
                  <tr>
                    <td>Event Date</td>
                    <td>{{ $booking['starting_date'] }} to {{ $booking['ending_date'] }}</td>
                  </tr>
                  <tr>
                    <td>Address</td>
                    <td>{{ $booking['address'] }}</td>
                  </tr>
                  <tr>
                    <td>Client Name</td>
                    <td>{{ $booking['clientname'] }}</td>
                  </tr>
                  <tr>
                    <td>Contact No.</td>
                    <td>{{ $booking['phone']}}</td>
                  </tr>
                </table>
                
              </div>
            </div>
            <div class="status">
              <span id="status">{{ $booking['status']}}</span>
            </div>
          </div>
          @endforeach
        </div>
      </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    function filterBookings() {
        var filter = $('#booking-filter').val().toLowerCase();

        $('.booking-card').each(function() {
            var $bookingCard = $(this);
            var status = $bookingCard.find('.status #status').text().toLowerCase();

            if (filter === 'all' || status === filter) {
                $bookingCard.show();
            } else {
                $bookingCard.hide();
            }
        });
    }

    $('.booking-filter-btn').click(function() {
        var filter = $(this).attr('id');

        // Remove active class from all buttons and add it to the clicked button
        $('.booking-filter-btn').removeClass('filter-active');
        $(this).addClass('filter-active');

        // Set the selected option in the dropdown menu
        $('#booking-filter').val(filter);

        // Filter bookings based on the selected filter
        filterBookings();
    });

    $('#booking-filter').on('change', function() {
        // Get the selected filter value from the dropdown
        var filter = $(this).val().toLowerCase();

        // Remove active class from all buttons
        $('.booking-filter-btn').removeClass('filter-active');

        // Add active class to the button corresponding to the selected filter
        $('#' + filter).addClass('filter-active');

        // Filter bookings based on the selected filter
        filterBookings();
    });

    // Initial filtering based on the 'All' filter
    $('#all').addClass('filter-active');
    filterBookings();
});

</script>
@extends('layouts.companylayout')
@section('title', 'Dashboard')
@section('links')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection
@section('content')
<div class="dashboard-container">
    <div class="left">
      <div class="earnings-card">
        <h2>Total Income</h2>
        <p>Rs. {{$data['totalAmount']}}</p>
        <div class="button-container">
          <a href="#" class="withdraw">Withdraw</a>
          <a href="#" class="view">View Details</a>
        </div>
        <div class="note">
          <p>*commission will be deducted at the time of withdrawl</p>
        </div>
      </div>
      <div class="rating-card">
        <div class="info-top">
          <h2>Total reviews</h2>
          <p>5</p>
        </div>
        <div class="review-details">
          <div class="rating">
            <h2>Rating</h2>
            <p>4.5</p>
          </div>
          <a href="#" class="view">check reviews</a>
        </div>

      </div>

    </div>
    <div class="right">
      <h2>Bookings</h2>
      <div class="pie-chart">
        <canvas id="pie-chart"></canvas>
      </div>
    </div>
  </div>
@endsection

@section('scripts')

        var completedBookings = @json($data['completedBookings']);
        var upcomingBookings = @json($data['upcomingBookings']);
        var cancelledBookings = @json($data['cancelledBookings']);

        var ctx = document.getElementById("pie-chart").getContext("2d");
        var myChart = new Chart(ctx, {
            type: "pie",
            data: {
                labels: ["completed", "Upcoming", "Cancelled"],
                datasets: [{
                    label: "Number of bookings",
                    data: [completedBookings, upcomingBookings, cancelledBookings],
                    backgroundColor: [
                        "rgba(255, 206, 86, 0.2)",
                        "rgba(54, 162, 235, 0.2)",
                        "rgba(255, 99, 132, 0.2)",
                    ],
                    borderColor: [
                        "rgba(255, 206, 86, 1)",
                        "rgba(54, 162, 235, 1)",
                        "rgba(255, 99, 132, 1)",
                    ],
                    borderWidth: 1,
                }],
            },
        });

@endsection





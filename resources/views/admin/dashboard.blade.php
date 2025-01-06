{{-- admin dashboard --}}
@extends('layouts.adminlayout')
@section('title', 'Admin Dashboard')
@section('links')
<link rel="stylesheet" href="{{ asset('css/admindashboard.css') }}" />
@endsection

@section('content')
<div class="dashboard-container">
    <div class="left">
      <div class="revenue">
        <h2>Total Revenue</h2>
        <p>₹ {{$data['revenue']}}</p>
        <h2>Commission</h2> 
        <p id="commission">₹ {{$data['commission']}}</p>
      </div>
      <div class="bookings">
        <!-- donut chart -->
        <h2>Bookings</h2>
        <div class="donut-chart">
          <canvas id="donut-chart"></canvas>
        </div>
      </div>
    </div>
    <div class="right">
      <div class="users">
        <h2>Users</h2>
        <div class="line-chart">
          <canvas id="line-chart"></canvas>
        </div>
      </div>
      <div class="approved-companies">
        <h2>Last Approved Companies</h2>
        <div class="card-container">
            @foreach($data['companies'] as $company)
            <div class="card">
                <h4>{{$company->company_name}}</h4>
                <p>Approved on {{$company->updated_at}}</p>
            </div>
            @endforeach
        </div>
      </div>
    </div>
</div>
    
@endsection
<script>

    var completedBookings = @json($data['completed']);
    var upcomingBookings = @json($data['upcoming']);
    var cancelledBookings = @json($data['cancelled']);

    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('donut-chart').getContext('2d');
        var myDonutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["completed", "upcoming", "Cancelled"],
                datasets: [{
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
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        enabled: true
                    }
                }
            }
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('line-chart').getContext('2d');
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Users',
                    data: [5, 10, 15, 20, 25, 30, 35],
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: false,
                    tension: 0.1
                }, {
                    label: 'Companies',
                    data: [3, 6, 9, 12, 15, 18, 21],
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: false,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        enabled: true
                    }
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Months'
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Number'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    });

</script>


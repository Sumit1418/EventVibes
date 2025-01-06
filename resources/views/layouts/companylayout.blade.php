<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/navigation.css') }}">
    <script src="https://kit.fontawesome.com/d3b584d238.js" crossorigin="anonymous"></script>
    <title>@yield('title')</title>
    @yield('links')
</head>
<body>
  <header>
    <div class="logo-container">
      <h1>EventVibes</h1>
    </div>
    <nav class="navbar">
      <ul>
        <li class="nav-item active">
          <a class="nav-link" href="/company/dashboard"><i class="fa-solid fa-house"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/company/bookings"
            ><i class="fas fa-calendar-alt"></i
          ></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/company/payments"
            ><i class="fas fa-money-bill-wave"></i
          ></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/company/help"
            ><i class="fas fa-question-circle"></i
          ></a>
        </li>
      </ul>
    </nav>
    <div class="head-right">
      <div class="notification"><i class="fas fa-bell"></i></div>
      <div class="profile"><i class="fas fa-user"></i></div>
    </div>
  </header>

  <div id="profilemodal" class="modal">
    <div class="profile-content">
      <div class="profile-head">
        <h2>Profile</h2>
        <span class="profile-close">&times;</span>
      </div>
      <div class="profile-body">
        <div class="profile-picture">
          <img
            src="{{ asset('storage/'.$_SESSION['companyDetails']->logo_path) }}"
            alt="Profile Picture"
          />
        </div>
        <div class="profile-text">
          <p id="full-name"> 
            {{ $_SESSION['user']->name }}
          </p>
        </div>
        <div class="profile-text">
          <p id="email">
            {{ $_SESSION['user']->email }}
          </p>
        </div>

        <div class="profile-options">
          <a href="/company/companydetails" class="profile-option">
            <i class="fas fa-edit"></i> Edit Profile
          </a>
          <a href="/logout" class="profile-option">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
        </div>
      </div>
    </div>
  </div>

  <div id="notifmodal" class="modal">
    <div class="notif-content">
      <div class="notif-head">
        <h2>Notifications</h2>
        <span class="notif-close">&times;</span>
      </div>
      <div class="notif-body">
        <div class="notif-item">
          <div class="notif-date">
            <p>12.04.24</p>
          </div>
          <div class="notif-text">
            <p>Sumit booked your service for 3 days</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="main">
      @yield('content')
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
        var currentUrl = window.location.pathname;

        $(".navbar .nav-item").removeClass("active");

        $(".navbar .nav-link").each(function() {
            var navLinkUrl = $(this).attr("href");
            
            if (navLinkUrl === currentUrl) {
                $(this).closest(".nav-item").addClass("active");
            }
        });
    });

    var profilemodal = document.getElementById("profilemodal");
    var profilebtn = document.getElementsByClassName("profile")[0];
    var profilespan = document.getElementsByClassName("profile-close")[0];

    var notifmodal = document.getElementById("notifmodal");
    var notifbtn = document.getElementsByClassName("notification")[0];
    var notifspan = document.getElementsByClassName("notif-close")[0];

    // Open profile modal
    profilebtn.onclick = function () {
      profilemodal.style.display = "block";
    };

    // Close profile modal
    profilespan.onclick = function () {
      profilemodal.style.display = "none";
    };

    // Open notification modal
    notifbtn.onclick = function () {
      notifmodal.style.display = "block";
    };

    // Close notification modal
    notifspan.onclick = function () {
      notifmodal.style.display = "none";
    };

    // Close modals when clicking outside
    window.onclick = function (event) {
      if (event.target == profilemodal) {
        profilemodal.style.display = "none";
      }
      if (event.target == notifmodal) {
        notifmodal.style.display = "none";
      }
    };

    // Hide modals on window load
    window.onload = function () {
      profilemodal.style.display = "none";
      notifmodal.style.display = "none";
    };

    @yield('scripts')
  </script>
</body>
</html>
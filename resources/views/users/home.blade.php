{{-- user index blade before login --}}
@extends('layouts.userlayout')
@section('title', 'EventVibes')
@section('links')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection
@section('content')
<div class="home-container">
    <div class="home-head">
      <div class="service">
        <select name="service" id="service">
          <option value="all" selected>All Services</option>
          <option value="caterer">Caterer</option>
          <option value="decorator">Decorator</option>
          <option value="photographer">Photographer</option>
          <option value="music">Music</option>
          <option value="lighting">Lighting</option>
          <option value="dj">DJ</option>
          <option value="eventplanner">Event Planner</option>
        </select>
      </div>
      <div class="pincode">
        <input
          type="text"
          name="pincode"
          id="pincode"
          placeholder="Enter Pincode"
        />
      </div>
      <div class="search-name">
        <label for="search-name">or by Company Name</label>
        <div class="search">
          <input
            type="text"
            name="search-name"
            id="name"
            placeholder="Example: xyz"
          />
        </div>
      </div>
    </div>
    <div class="companies-card-container">
      @foreach ($_SESSION['allcompany'] as $company)
      <div class="companies-card">
        <div class="serviceable-pincode" style="display: none">
          <p>Serviceable Pincode: {{ $company['serviceable_pincodes'] }}</p>
        </div>
          <div class="companies-card-top">
              <div class="companies-logo">
                  <img src="{{ asset('storage/'.$company['logo_path']) }}" alt="Company Logo" />
              </div>
              <div class="additional-details">
                  <div class="company-rating">
                      <p>Rating: 4.5</p>
                  </div>
                  <div class="company-budget">
                      <p>Budget: {{ $company['budget'] }} per/day</p>
                  </div>
                  <div class="company-loctaion">
                      <p>Location: {{ $company['state'] }}</p>
                  </div>
              </div>
          </div>
          <div class="companies-card-bottom">
              <div class="company-name">
                  <p>{{ $company['company_name'] }}</p>
              </div>
              <div class="company-owner">
                  <p>Owner: {{ $company['owner_name'] }}</p>
              </div>
              <div class="company-type">
                  <p>Service type: {{ $company['type'] }}</p>
              </div>
          </div>
          <form method="GET" action="/user/viewdetails" class="view-details-button">
              <input type="hidden" name="company_id" value="{{ $company['user_id'] }}" />
              <button type="submit" id="view-details">view details</button>
          </form>
      </div>
      @endforeach
    </div>
  </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  
  $(document).ready(function() {

    function filterCompanies() {
      var service = $('#service').val().toLowerCase();
      var pincode = $('#pincode').val().toLowerCase();
      var name = $('#name').val().toLowerCase();

      $('.companies-card').each(function() {
        var $companyCard = $(this);
        var companyService = $companyCard.find('.company-type p').text().toLowerCase();
        var companyPincode = $companyCard.find('.serviceable-pincode p').text().toLowerCase();
        var companyName = $companyCard.find('.company-name p').text().toLowerCase();


        if ((service === 'all' || companyService.includes(service)) &&
            (pincode === '' || companyPincode.includes(pincode)) &&
            (name === '' || companyName.includes(name))) {
          $companyCard.show();
        } else {
          $companyCard.hide();
        }
      });
    }

    $('#service, #pincode, #name').on('change keyup', filterCompanies);

    filterCompanies();
  });


</script>


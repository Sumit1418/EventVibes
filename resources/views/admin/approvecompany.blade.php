@extends('layouts.adminlayout')
@section('title', 'Approve Companies')

@section('links')
<link rel="stylesheet" href="{{ asset('css/approvecompany.css') }}" />
@endsection

@section('content')
<div class="companies-container">
    <div class="filters">
        <button class="filter active-filter" id="approved">Approved</button>
        <button class="filter" id="not-approved">Disapproved</button>
    </div>
    <div class="companies-card-container">
        @foreach ($companies as $company)
        <div class="companies-card" data-status="{{ $company['status'] }}">
            <div class="companies-card-top">
                <div class="companies-logo">
                    <img src="{{ asset('storage/'.$company['logo_path']) }}" alt="Company Logo" />
                </div>
                <div class="additional-details">
                    <div class="company-budget">
                        <p>Budget: {{ $company['budget'] }} per/day</p>
                    </div>
                    <div class="company-location">
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
            <form method="POST" action="/admin/changestatus" class="view-details-button">
                @csrf
                <input type="hidden" name="company_id" value="{{ $company['user_id'] }}" />
                @if($company['status'] === 'disapproved')
                    <input type="hidden" name="status" value="approved"/>
                    <button type="submit" class="status-btn approve-btn">Approve</button>
                @elseif($company['status'] === 'approved')
                    <input type="hidden" name="status" value="disapproved"/>
                    <button type="submit" class="status-btn disapprove-btn">Disapprove</button>
                @endif
            </form>
        </div>
        @endforeach
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function filterCompanies(status) {
            $('.companies-card').each(function() {
                if ($(this).data('status') === status) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        $('.filter').click(function() {
            $('.filter').removeClass('active-filter');
            $(this).addClass('active-filter');
            var filter = $(this).attr('id') === 'approved' ? 'approved' : 'disapproved';
            filterCompanies(filter);
        });

        // Initial filtering based on the 'Disapproved' filter
        filterCompanies('approved');
    });
</script>

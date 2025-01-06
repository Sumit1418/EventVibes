@extends('layouts.userlayout')
@section('title', 'payment')
@section('links')
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
@endsection
@section('content')
<div class="transaction-container">
    <div class="transaction-head">
        <div class="transaction-status">
            <select name="status" id="transaction-status">
                <option value="all" selected>All transactions</option>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
            </select>
        </div>
    </div>
    <div class="transaction-body">
        <div class="body-headings">
            <div class="body-heading">Date</div>
            <div class="body-heading">Transaction Id</div>
            <div class="body-heading">Amount</div>
            <div class="body-heading">to</div>
            <div class="body-heading">Status</div>
        </div>

        <div class="body-row-container">
            @foreach ($userPayments as $payment)
            {{-- {{dd($payment->transaction_id)}}; --}}
            <div class="body-row">
                <div class="body-data">{{ $payment->date }}</div>
                <div class="body-data">{{ $payment->transaction_id }}</div>
                <div class="body-data">{{ $payment->amount }}</div>
                <div class="body-data">{{ $payment->companyname }}</div>
                <div class="body-data">{{ $payment->status }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>  
    
@endsection

{{-- script for transaction status filter --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const transactionStatus = document.getElementById('transaction-status');
        transactionStatus.addEventListener('change', (e) => {
            const status = e.target.value;
            const bodyRows = document.querySelectorAll('.body-row');
            bodyRows.forEach(row => {
                const rowStatus = row.children[4].textContent.toLowerCase();
                if (status === 'all') {
                    row.style.display = 'grid';
                } else if (status === rowStatus) {
                    row.style.display = 'grid';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>


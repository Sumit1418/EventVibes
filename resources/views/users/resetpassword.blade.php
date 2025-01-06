{{-- resetpassword blade--}}
@extends('layouts.loginlayout')
@section('title', 'Forgot Password')

@section('content')
<form method="POST" action="" class="p-3 mt-3">
    @csrf
        <div class="form-field d-flex align-items-center">
            <span class="far fa-envelope"></span>
            <input type="email" name="email" id="email" placeholder="Email">
        </div>
        <button type="submit" class="btn mt-3">Send otp</button>
    </form>
    <div class="text-center fs-6">
        Remember your password? <a href="/login">Login</a>
    </div>
@endsection

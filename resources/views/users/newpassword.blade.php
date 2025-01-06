{{-- newpassword blade --}}
@extends('layouts.loginlayout')
@section('title', 'Reset Password')

@section('content')
<form method="POST" action="" class="p-3 mt-3">
    @csrf
        <div class="form-field d-flex align-items-center">
            <span class="fas fa-lock"></span>
            <input type="password" name="newPassword" id="newPassword" placeholder="New Password">
        </div>
        <div class="form-field d-flex align-items-center">
            <span class="fas fa-lock"></span>
            <input type="password" name="confirmNewPassword" id="confirmNewPassword" placeholder="Confirm New Password">
        </div>
        <div class="form-field d-flex align-items-center">
            <span class="fas fa-key"></span>
            <input type="text" name="otp" id="otp" placeholder="OTP">
        </div>
        <button type="submit" class="btn mt-3">Reset Password</button>
    </form>
    <div class="text-center fs-6">
        Remember your password? <a href="/login">Login</a>
    </div>
@endsection

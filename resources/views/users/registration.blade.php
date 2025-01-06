{{-- registration blade--}}
@extends('layouts.loginlayout')
@section('title', 'Register')

@section('content')
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form method="POST" action="/registration" class="p-3 mt-3">
        @csrf
        <div class="form-field d-flex align-items-center">
            <span class="fas fa-user"></span>
            <select name="userType" id="userType" required>
                <option value="" disabled selected>select user type</option>
                <option value="user">User</option>
                <option value="Company">Company</option>
            </select>
        </div>
        
        <div class="form-field d-flex align-items-center">
            <span class="fas fa-signature"></span>
            <input type="text" name="fullName" id="fullName" placeholder="Full Name">
        </div>
        <div class="form-field d-flex align-items-center">
            <span class="far fa-envelope"></span>
            <input type="email" name="email" id="email" placeholder="Email">
        </div>
        <div class="form-field d-flex align-items-center">
            <span class="fas fa-key"></span>
            <input type="password" name="password" id="password" placeholder="Password">
        </div>
        <div class="form-field d-flex align-items-center">
            <span class="fas fa-key"></span>
            <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password">
        </div>
        <button type="submit" class="btn mt-3">Register</button>
    </form>
    <div class="text-center fs-6">
        Already have an account? <a href="/login">Login</a>
    </div>
@endsection

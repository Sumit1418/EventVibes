{{-- login blade --}}
@extends('layouts.loginlayout')
@section('title', 'Login')

@section('content')
@if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif
@if(Session::has('error'))
    <div class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
@endif

<form method="POST" action="/login" class="p-3 mt-3">
    @csrf
        {{-- <div class="form-field d-flex align-items-center">
            <span class="far fa-user"></span>
            <input type="text" name="userName" id="userName" placeholder="Username">
        </div> --}}
        <div class="form-field d-flex align-items-center">
            <span class="far fa-envelope"></span>
            <input type="email" name="email" id="email" placeholder="Email">
        </div>
        <div class="form-field d-flex align-items-center">
            <span class="fas fa-key"></span>
            <input type="password" name="password" id="pwd" placeholder="Password">
        </div>
        <button type="submit" class="btn mt-3">Login</button>
    </form>
    <div class="text-center fs-6">
        <a href="/resetpassword">Forget password?</a> or <a href="/registration">Sign up</a>
    </div>
@endsection

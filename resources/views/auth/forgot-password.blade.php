
@extends('layouts.app')
@section('content')
<div class="login-right">
    <div class="login-right-wrap">
        <h1 class="text-center">Enter Your Email To Reset Your Password</h1>
        <p class="account-subtitle">Are You Remember Your Password ? <a href="{{route('login')}}">Login</a></p>
        <h4 class="text-danger">{{Session::get('error')}}</h4>
        <form action="{{route('reset.password.email')}}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email<span class="login-danger">*</span></label>
                <input type="email" class="form-control @error('email') {{$message}} @enderror" name="email">
                <span class="profile-views"><i class="fas fa-envelope"></i></span>
            </div>
          
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Send Email</button>
            </div>
        </form>
    </div>
</div>

@endsection

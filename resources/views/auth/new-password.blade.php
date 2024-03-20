
@extends('layouts.app')
@section('content')
{{-- message --}}
{{-- {!! Toastr::message() !!} --}}
<div class="login-right">
    <div class="login-right-wrap">
        <h1>Welcome to MySchool</h1>
        <h2>New Password</h2>
        <form action="" method="POST">
            @csrf
            <div class="form-group">
                <label>Password <span class="login-danger">*</span></label>
                <input type="password" class="form-control pass-input @error('password') {{$message}} @enderror" name="password">
                <span class="profile-views feather-eye toggle-password"></span>
            </div>
            <div class="form-group">
                <label>Confirm Password <span class="login-danger">*</span></label>
                <input type="password" class="form-control pass-input @error('password_confirmation') {{$message}} @enderror" name="password_confirmation">
                <span class="profile-views feather-eye toggle-password"></span>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Change Password</button>
            </div>
        </form>
    </div>
</div>

@endsection

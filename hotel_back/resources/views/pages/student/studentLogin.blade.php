@extends('layouts.app')

@section('content') 
    <form action="{{route('studentLogin')}}" class="form-group" method="post" autocomplete="off">
        {{csrf_field()}}   
        <div class="col-md-4">
            <label for="">Email</label><br>
            <input type="text" name="email" value="{{request()->cookie(key: 'email')}}"><br>

            <label for="">Password</label><br>
            <input type="password" name="password"  value="{{request()->cookie(key: 'password')}}"><br>  <br>    
            
            <input type="checkbox" class="form-check-input" name="remember" value="remember" @if (Cookie::get('email') !== null){ checked } @endif>
            <label class="form-check-label">Remember me</label> <br><br>
            
            <input type="submit" class="btn btn-primary" value="Login">
           

            @if($errors->any())
                <div class="alert alert-success" style="height: 100px; width:190px;">
                <h4>{{$errors->first()}}</h4>
                </div>
            @endif
        </div>
    </form>
 @endsection

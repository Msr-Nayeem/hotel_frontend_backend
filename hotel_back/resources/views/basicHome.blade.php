@extends('layouts.app');

@section('topnav')
    <nav class="navbar bg-light">
        <div class="container-fluid justify-content-start">
        <a class="btn btn-outline-success me-2" type="button" href="{{route('home')}}">Home</a>
        <a class="btn btn-outline-success me-2" type="button" href="{{route('service')}}">Service</a>
        <a class="btn btn-outline-success me-2" type="button" href="{{route('ourteam')}}">Our team</a>
        <a class="btn btn-outline-success me-2" type="button" href="{{route('contact')}}">Contact</a>
        <a class="btn btn-outline-success me-2" type="button" href="{{route('about')}}">About us</a>
        </div>
    </nav>
 @endsection
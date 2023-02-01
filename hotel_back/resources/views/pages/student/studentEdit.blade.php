@extends('layouts.app')
@section('content')
    <form action="{{route('studentUpdate')}}" class="form-group" method="post" autocomplete="off">
        {{csrf_field()}}
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-4 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="img-fluid" width="150px" src="{{asset('image/student_edit.png')}}">
                        <span class="font-weight-bold" style = "text-transform:capitalize;">{{$student->name}}</span>
                        <span class="text-black-50">{{$student->email}}</span>
                        
                        
                    </div>
                </div>
                <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                <div>
                    <h3>Update Information</h3>
                </div>
                <div class="row mt-3">
                    <div class="col-md-10">
                    <input type="text" class="form-control" name="id" value="{{$student->id}}" hidden>
                        <label class="labels">Full Name</label>
                        <input type="text" class="form-control" name="name" value="{{$student->name}}" placeholder="Enter full name">
                        @error('name')
                            <span class="text-danger">{{$message}}</span><br>
                        @enderror 
                        <br>
                    
                        <label class="labels">Email</label>
                        <input type="text" class="form-control" name="email" value="{{$student->email}}" placeholder="enter email"> 
                        @error('email')
                            <span class="text-danger">{{$message}}</span><br>
                        @enderror
                        <br>
        
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Mobile Number</label>
                        <input type="text" class="form-control" name="phone" value="0{{$student->phone}}" placeholder="phone number">
                        @error('phone')
                            <span class="text-danger">{{$message}}</span><br>
                        @enderror
                        <br>
                    </div>
                    <div class="col-md-4">
                        <label class="labels">Date of Birth</label>
                        <input type="date" class="form-control" name="dob" value="{{$student->dob}}">
                        @error('dob')
                            <span class="text-danger">{{$message}}</span><br>
                        @enderror
                        <br>
                    </div>

                </div>
                <input type="submit" class="btn btn-primary profile-button" value="Change">
                
            </div>

            </div>

            </div>

        </div>
            
        
    </form>
 @endsection
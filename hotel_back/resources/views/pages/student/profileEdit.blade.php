@extends('layouts.app')
@section('content')
    <div class="container" style="cursor:default;" >
    <div class="main-body">
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4 style = "text-transform:capitalize;">{{$student->name}}</h4>
                      <h6 class="text-secondary" style = "text-transform:capitalize;">Role: {{$student->utype}}</h6>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                <form action="{{route('profileUpdate')}}" class="form-group" method="post" autocomplete="off" style="cursor:default;">
                     {{csrf_field()}}
                     <input type="text" class="form-control" name="id" value="{{$student->id}}" hidden>

                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Full Name :</h6>
                        </div>
                        <div class="col-sm-3 text-secondary">
                        <input type="text" class="form-control" name="name" value="{{$student->name}}" placeholder="Enter full name">
                        </div>
                        <div class="col-sm-3">
                        <h6 class="mb-0">Date of Birth</h6>
                        </div>
                        <div class="col-sm-3 text-secondary">
                        <input type="date" class="form-control" name="dob" value="{{$student->dob}}">
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-sm-2">
                        <h6 class="mb-0">Email :</h6>
                      </div>
                      <div class="col-sm-4 text-secondary">
                      <input type="email" class="form-control" name="email" value="{{$student->email}}" placeholder="Valid email">
                      </div>

                      <div class="col-sm-3">
                        <h6 class="mb-0">Phone :</h6>
                      </div>
                      <div class="col-sm-3 text-secondary">
                      <input type="text" class="form-control" name="phone" value="0{{$student->phone}}" placeholder="Enter full name">
                      </div>

                    </div>
                    
                    <hr>
                    <div class="row">
                      <div class="col-sm-12">
                      <input type="submit" class="btn btn-primary profile-button" value="Update">
                    </div>
                    </div>
                    </form>
                    
                </div>
              </div>

 
@endsection
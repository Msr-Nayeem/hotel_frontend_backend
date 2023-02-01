@extends('layouts.dash')
@section('content')
<br>
    <div class="main-body">
        <div class="row gutters-sm">
          <div class="col-md-4">
              <div class="card">
                <div class="card-body">
                  <div class="align-items-center text-center">
                    <img src="{{asset('image/profile_icon.png')}}" alt="Admin" class="img-fluid" width="150">
                    <div class="mt-3">
                      <h4 style = "text-transform:capitalize;"name</h4>
                      <h6 class="text-secondary" style = "text-transform:capitalize;">Role: </h6>
                      <button id=""  class="btn btn-primary btn-rounded" value="">Change Password</button>
                      <a class="btn btn-primary btn-rounded" style="margin-left:17px;" href="">Edit/Update </a>
                    </div>
                </div>
            </div>
          </div>
          </div>
          <div class="col-md-8">
              <div class="card">
                <div class="card-body">
                  <div class="align-items-center text-center">
                    <img src="{{asset('image/profile_icon.png')}}" alt="Admin" class="img-fluid" width="150">
                    <div class="mt-3">
                      <h4 style = "text-transform:capitalize;"name</h4>
                      <h6 class="text-secondary" style = "text-transform:capitalize;">Role: </h6>
                      <button id=""  class="btn btn-primary btn-rounded" value="">Change Password</button>
                      <a class="btn btn-primary btn-rounded" style="margin-left:17px;" href="">Edit/Update </a>
                    </div>
                </div>
            </div>
          </div>
          </div>
        </div>
</div>
@endsection
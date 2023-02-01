@extends('layouts.app')

@section('content')

<section class="h-100 h-custom" style="background-color: #8fc4b7;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-8 col-xl-6">
        <div class="card rounded-3">
          <img src="{{asset('image/addRoom.webp')}}"
            class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;"
            alt="Sample photo">
          <div class="card-body p-4 p-md-5">
            <form class="from-control" action="{{route('addRoom')}}"  method="post">    
            {{csrf_field()}}
            @if($errors->any())
                  <div class="err">
                  <h4 style="text-align: center;">{{$errors->first()}}</h4>
                  </div>
                @endif
                <div class="col-md-6 mb-6">
                   <label class="form-label" for="cetegory">Cetegory</label>
                    <select class="form-select form-select-lg" id="cetegory" name="cetegory">
                        <option value="delux">Delux</option>
                        <option value="premium">Premium</option>
                        <option value="regular">Regular</option>
                    </select>
                    <br>
                    <label class="form-label">Rent(BDT)</label>
                    <input type="number" id="rent" class="form-control form-control-lg" name="rent" value="1000"/> 
                </div> 
                    <button type="submit"
                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" id="addButton">Add</button>
                </div>
              
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
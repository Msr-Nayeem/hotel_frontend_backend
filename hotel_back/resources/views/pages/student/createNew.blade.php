@extends('layouts.app')

@section('content')

 <form action="{{route('createNew')}}" class="form-group" method="post" autocomplete="off" style="cursor:default;">
        {{csrf_field()}}
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="row mt-0">
                    <div class="col-md-10">
                        <label class="labels">Full Name</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Enter full name">
                        @error('name')
                            <span class="text-danger">{{$message}}</span><br>
                        @enderror 
                        <br>
                    
                        <label class="labels">Email</label>
                        <input type="text" class="form-control" name="email"  value="{{old('email')}}" placeholder="enter email"> 
                        @error('email')
                            <span class="text-danger">{{$message}}</span><br>
                        @enderror
                        <br>

                        <label for="">Password</label><br>
                        <input type="password" class="form-control" name="password"  value="{{old('password')}}" placeholder="Enter Password">
                        @error('password')
                            <span class="text-danger">{{$message}}</span><br>
                        @enderror
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Mobile Number</label>
                        <input type="text" class="form-control" name="phone" value="{{old('phone')}}" placeholder="phone number">
                        @error('phone')
                            <span class="text-danger">{{$message}}</span><br>
                        @enderror
                        <br>
                    </div>
                    <div class="col-md-4">
                        <label class="labels">Date of Birth</label>
                        <input type="date" class="form-control" name="dob" value="{{old('dob')}}" style="cursor:pointer;">
                        @error('dob')
                            <span class="text-danger">{{$message}}</span><br>
                        @enderror
                        <br>
                    </div>
                    <div class="col-md-10">
                        <label class="labels">Register As</label>
                        <select class="form-control" name="utype" style="cursor:pointer;">
                            <option value="0">Select Type</option>
                            <option value="receptionist">Receptionist</option>
                            <option value="user">User</option>
                        </select>
                        @error('utype')
                            <span class="text-danger">{{$message}}</span><br>
                        @enderror
                        <br>
                    </div>
                    <br>
                    <div class="col-md-5">
                        <label class="labels">Country</label>
                        <select class="form-control" id="Country_dropdown" name="country">
                            <option value="1" selected>Bangladesh</option>
                        </select>
                        <br>
                    </div>
                    <br>

                    <div class="col-md-5">
                        <label class="labels">City</label>
                        <select class="form-control" id="city_dropdown" name="city">
                            <option value="0">Select City</option>
                            @if(!empty($cities))
                                @foreach($cities as $city)
                                <option value="{{ $city->id }}"> {{ $city->city_name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('city')
                            <span class="text-danger">{{$message}}</span><br>
                        @enderror
                        <br>
                    </div>
                    <br>
                    <div class="col-md-5">
                        <label class="labels" id="d">District</label>
                        <select class="form-control" id="district_dropdown" name="district">
                        <option value="0">Select City First</option>
                        </select>
                        @error('district')
                            <span class="text-danger">{{$message}}</span><br>
                        @enderror
                        <br>
                    </div>
                    <div class="col-md-5">
                        <label class="labels">Area</label>
                        <select class="form-control" id="area_dropdown" name="area">
                        <option value="0" id="select">Select District First</option>
                        </select>
                        @error('area')
                            <span class="text-danger">{{$message}}</span><br>
                        @enderror
                        <br>
                    </div>
                    <br>
                </div>
                
            </div>
                        
        </div>
        
         <input type="submit" class="btn btn-primary profile-button" value="Register">

 </form>
 @endsection
 @section('scriptList')
 <script>

    $(document).ready(function () {
        $('#city_dropdown').change(function()
        {
            let id = $(this).val();
            if(id==0)
            {
                $('select[id="district_dropdown"]').empty();
                $('select[id="district_dropdown"]').append('<option value="0">Select City First</option>');
                $('select[id="area_dropdown"]').empty();
                $('select[id="area_dropdown"]').append('<option value="0">Select District First</option>');
            }
            else
            {
                $.ajaxSetup({
                    headers: 
                    {
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    dataType: 'json',
                    url: "/getDistrict/"+id,
                    type: "GET",
                    success: function (data){
                        $('select[id="district_dropdown"]').empty();
                        $('select[id="district_dropdown"]').append('<option value="0">Select District</option>');
                        $.each(data, function(key,data){
                        
                        $('select[id="district_dropdown"]').append('<option value="'+ data.id +'">'+ data.district_name +'</option>');
                    });
                    },
                error: function(error) {
                        console.log(error);
                }
                });

            }        
        
        });

        $('#district_dropdown').change(function()
        {
            let id = $(this).val();
            if(id==0){
                $('select[id="area_dropdown"]').empty();
                $('select[id="area_dropdown"]').append('<option value="0">Select District First</option>');
            }
            else
            {
                $('select[id="area_dropdown"]').empty();
                $('select[id="area_dropdown"]').append('<option value="0">Select Area</option>');
                 $.ajaxSetup({
                headers: 
                    {
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    dataType: 'json',
                    url: "/getArea/"+id,
                    type: "GET",
                    success: function (data){
                        $('select[id="area_dropdown"]').empty();
                        $('select[id="area_dropdown"]').append('<option value="0">Select Area</option>');
                        $.each(data, function(key,data){
                        $('select[id="area_dropdown"]').append('<option value="'+ data.id +'">'+ data.area_name +'</option>');
                    });
                    },
                error: function(error) {
                        console.log(error);
                }
                }); 

            }  
        
        });
    });
       
</script>
@endsection


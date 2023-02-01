@extends('layouts.app')

@section('content')
<div class="container" style="cursor:default;">
    <br>
    <div class="main-body">
            
        <!-- <div class="card">
            <div class="card-body">
                <div class="align-items-center text-center">
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Full Name :</h6>
                            </div>
                            <div class="col-sm-3">
                                <h6 class="mb-0" style = "text-transform:capitalize;">nayeem</h6>   
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="card">
            <div class="card-body" style="background-color:cyan; height: 300px; width:85%; position:fixed;">
                <div class="container">
                <form action="{{route('bookings')}}"  method="post">
                         {{csrf_field()}}
                      
                    <label style="margin-left:100px;">From: </label>
                    <input type="date" name="from_" id="from_" class="mb-0" style="margin-left: 10px; width:120px; height:40px;">      
                 
                    <label style="margin-left:20px;">To: </label>
                    <input type="date" name="to_" id="to_" class="mb-0" style="width:120px; height:40px;">  

                    <label class="form-label" style="margin-left:10px;">Period: </label>
                    <input class="mb-0" id="period" name="period" style="width:60px; height:40px;" readonly>    
                 
                    <label class="form-label" for="cetegory" style="margin-left:20px;">Cetegory</label>
                    <select class="mb-0" id="cetegory" name="cetegory" style="width:200px; height:40px;">
                        <option value="0">Select Room</option>
                        <option value="delux">Delux (3k)</option>
                        <option value="premium">Premium (2k)</option>
                        <option value="regular">Regular (1k)</option>
                    </select>

                    <label class="form-label" style="margin-left:20px;">Room Id</label>
                    <select class="mb-0" id="room_id" name="room_id" style="width:150px; height:40px;">
                        <option value="0">Select Room First</option>
                    </select>
                    <br>
                    <label class="form-label" style="margin-left:100px; margin-top: 40px">Rent: </label>
                    <input class="mb-0" id="rent_text" name="rent_text" style="width:150px; height:40px;" value="0" readonly>

                
                    <label class="form-label" style="margin-left:10px;">Total Rent: </label>
                    <input class="mb-0" id="total_rent" name="total_rent" style="width:150px; height:40px;" readonly>
                    
                    <label class="form-label" style="margin-left:20px;">Customer ID:</label>
                    <select class="mb-0" id="customer_id" name="customer_id" style="width:200px; height:40px;">
                    <option value="0">Select Customer</option>
                    @foreach($students as $student)
                        <option value="{{$student->id}}">{{$student->name}}</option>
                    @endforeach    
                    </select>

                    <button type="submit" class="mb-0" style="width: 150px; height:40px; margin-left:20px; background-color:darkcyan; border: 2px;">Submit </button>
                        <br><br><br>
                    @if($errors->any())
                        <div class="err">
                        <h4 style="text-align:center;">{{$errors->first()}}</h4>
                        </div>
                    @endif
                 </div>
        </div>
            
     </div>
    
 @endsection

 @section('scriptList')
 <script>

    $('#cetegory').change(function()
        {
            $('select[id="room_id"]').empty();
            let cetegory = $(this).val();
            $.ajaxSetup({
                headers: 
                {
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                dataType: 'json',
                url: "/getRoom/"+cetegory,
                type: "GET",
                success: function (data){
                    $('select[id="room_id"]').empty();
                    $('select[id="room_id"]').append('<option value="0">Select Room</option>');
                    $.each(data, function(key,data){
                    $('select[id="room_id"]').append('<option value="'+ data.id +'">Room no: '+ data.id +'</option>');
                });
                },
            error: function(error) {
                    console.log(error);
            }
            });                     
        
        });
    $('#room_id').change(function()
        {
            let id = $('select[id="room_id"]').val();
            if(id==0){
                document.getElementById("rent_text").value = "0";
            }
            $.ajaxSetup({
                headers: 
                {
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                dataType: 'json',
                url: "/getRent/"+id,
                type: "GET",
                success: function (data){
                    
                    $.each(data, function(key,data){
                        document.getElementById("rent_text").value = data.rent_per_day;
                });
                },
            error: function(error) {
                    console.log(error);
            }
            });

        });
        $('#to_').change(function(){
            var from_ = new Date(document.getElementById('from_').value);
            var to_ = new Date(document.getElementById('to_').value);
            var Difference_In_Time = to_.getTime() - from_.getTime();
            var Days = Difference_In_Time / (1000 * 3600 * 24);
            if(Days<0){
                alert("Select Date agein");
                document.getElementById("period").value = "";
            }
            else if(Days == "0"){
                document.getElementById("period").value ="1";
            }
            else{
                document.getElementById("period").value = Days;
            }
            
        });
        $('#total_rent').click(function(){
            
            document.getElementById("total_rent").value = "";
            var period = document.getElementById('period').value;
            var rent = document.getElementById('rent_text').value;
            document.getElementById("total_rent").value = rent*period;
        });

</script>
 @endsection
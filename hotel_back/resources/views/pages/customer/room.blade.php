@extends('layouts.app')

@section('content')
<!-- Modal -->
<div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="confirmationModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Confirmation</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      
        <div class="modal-body">
          <p id="alertMsg">Dynamic Text</p>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-mdb-dismiss="modal">Cancel</button>
        <a type="button" id="myAnchor" class="btn btn-danger btn-sm" href="">Okay</a>
      </div>
    </div>
  </div>
</div>

    @if($errors->any())
        <div class="alert alert-success">
        <h6 style="color: red;">{{$errors->first()}}</h6>
        </div>
    @endif
    
    <table id="roomTable" class="table table-bordered table-success border-dark table-striped table-hover" style="cursor:default;">
        <tr class="table-warning border-dark">
            <th style="text-align: left">Room ID</th>
            <th>Category</th>
            <th>Status</th>
            <th>Rent per day</th>
            <th>Guest ID</th>
            <th>Action</th>
        </tr>
        @if ($room_datas->count() == 0)
        <tr>
            <td colspan="6">No Room added till now.</td>
        </tr>
        @endif
        @foreach($room_datas as $room)
        <tr>
            <td>{{$room->id}}</td>
            <td>{{$room->cetegory}}</td>
            <td>{{$room->status}}</td>
            <td>{{$room->rent_per_day}} BDT</td>
            <td><a href="/details/{{$room->booked_for}}">{{$room->booked_for}}</a></td>
            @if($room->status == "booked")
            <td><button  id="{{$room->id}}" name="edit" onclick="alertFunction(this)" class="btn btn-danger btn-sm" value="{{$room->id}}">Cancel Booking</button></td>
           @else
           <td></td>
            @endif
        </tr>
        @endforeach
        <tfoot>
          <tr>
          <td colspan="6" style="text-align: center;">{{ $room_datas->links() }} 
          displaying {{$room_datas->count()}} room(s) of  total-{{$room_datas->total()}}</td>   
          </tr>
        </tfoot>
        
    </table>
    <div class="d-flex justify-content-center">
      <form class="from-control" action="{{route('room')}}"  method="get" autocomplete="off">  
        
        {{csrf_field()}}
        <a type="button"  class="btn btn-danger btn-sm" href="{{route('room')}}">Refresh</a>
        <input type="text"  name="search" style="background-color:cyan; margin-left:20px;" placeholder="search..."> 
        <button type="submit" class="btn btn-danger btn-sm" style="margin-left:20px;">Search </buton>
        <button type="button" onclick="window.print()" class="btn btn-danger btn-sm" style="margin-left:20px;">print </buton>
        
    </div>
    <br>

@endsection


@section('scriptList')
<script>  

  function alertFunction(btn){
    var sid = btn.value;
      
      $('#alertModal').modal('show');
      document.getElementById("alertMsg").innerHTML="Are You Sure?<br><br>Room id : ("+sid+") will be availeable.";
      document.getElementById("myAnchor").href ="/makeAvailable/"+sid;
    
  }
 
$(document).ready(function(){
    $('#roomTable').dataTable();
});
</script>
 @endsection
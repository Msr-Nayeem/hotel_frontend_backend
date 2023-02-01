@extends('layouts.app')

@section('content')
<!-- Modal -->
<div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="confirmationModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Dynamic Title</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      
      @if(session()->get("type")=="teacher")
        <div class="modal-body">
          <h6 style="color: red;">This feature is for admin only</h6>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-mdb-dismiss="modal">Okay</button>
        </div>
        @else
        <div class="modal-body">
          <p id="alertMsg">Dynamic Text</p>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-mdb-dismiss="modal">Cancel</button>
        <a type="button" id="myAnchor" class="btn btn-danger btn-sm" href="">Okay</a>
      </div>
      @endif
    </div>
  </div>
</div>
    @if($errors->any())
        <div class="alert alert-success">
        <h6 style="color: red;">{{$errors->first()}}</h6>
        </div>
    @endif
 
    <table class="table table-bordered table-success border-dark table-striped table-hover" style="cursor:default;">
        <tr class="table-warning border-dark">
            <th style="text-align: left">Name</th>
            <th>Receptionist ID</th>
            <th>Email</th>
            <th colspan="2">Action</th>
            
        </tr>
        @if ($students->count() == 0)
        <tr>
            <td colspan="5">No Receptionist till now.</td>
        </tr>
        @endif
        @foreach($students as $student)
        <tr>
            <td><a href="/details/{{$student->id}}">{{$student->name}}</a></td>
            <td>{{$student->id}}</td>
            <td>{{$student->email}}</td>
            <td><button  id="{{$student->name}}" name="edit" onclick="alertFunction(this)" class="btn btn-danger btn-sm" value="{{$student->id}}">EDIT</button></td>
            <td><button  id="{{$student->name}}" name="delete" onclick="alertFunction(this)" class="btn btn-danger btn-sm" value="{{$student->id}}">Delete</button></td>
        </tr>
        @endforeach
        <tfoot>
          <tr>
          <td colspan="5" style="text-align: center;">{{ $students->links() }} 
          displaying {{$students->count()}} room(s) of  total -{{$students->total()}}</td>   
          </tr>
        </tfoot>
    </table>
    <div class="d-flex justify-content-center">
   <form class="from-control" action="{{route('receptionistList')}}"  method="get"  autocomplete="off">  
     
     {{csrf_field()}}
     <a type="button"  class="btn btn-danger btn-sm" href="{{route('receptionistList')}}">Refresh</a>
     <input type="text"  name="search" style="background-color:cyan;" placeholder="search..."> 
     <button type="submit" class="btn btn-danger btn-sm">Search </buton>
     
    </div>
    <br>
@endsection

@section('scriptList')
<script>  

  function alertFunction(btn){
    var sid = btn.value;
    var sname = btn.id;  
    if(btn.name == "delete"){
      $('#alertModal').modal('show');
      document.getElementById("modalTitle").innerHTML="Delete Confirmation !";
      document.getElementById("myAnchor").innerHTML="Yes Delete";
      document.getElementById("alertMsg").innerHTML="Are You Sure?<br>Once Deleted, can not be reversed.<br>Student : ("+sname+") will be deleted.";
      document.getElementById("myAnchor").href ="/studentDelete/"+sid;
    }
    else{
      $('#alertModal').modal('show');
      document.getElementById("myAnchor").href ="/studentUpdate/"+sid;
      document.getElementById("modalTitle").innerHTML="Edit Confirmation !";
      document.getElementById("alertMsg").innerHTML="Are You sure to edit?<br>You are going to edit: ("+sname+")";
      document.getElementById("myAnchor").innerHTML="Yes Edit";
      
    }
    
  }
 </script>
 @endsection
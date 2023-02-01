<!-- Modal -->
<div
  class="modal fade"
  id="staticBackdrop"
  data-mdb-backdrop="static"
  data-mdb-keyboard="false"
  tabindex="-1"
  aria-labelledby="staticBackdropLabel"
  aria-hidden="true"
>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Confirmation</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h6>Do You want to logout?</h6>
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-secondary btn-sm" data-mdb-dismiss="modal">Cancel</a>
        <a class="btn btn-danger btn-sm" type="button" href="{{route('logoutt')}}"">Logout</a>
      </div>
    </div>
  </div>
</div>
<!-- Navbar -->
<nav class="navbar navbar-expand fixed-top navbar-light bg-light">
  <!-- Container wrapper -->
  <div class="container-fluid">

      <!-- Left links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="btn btn-outline-success me-2" type="button" href="{{route('home')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-success me-2" type="button" href="{{route('booking')}}">Booking</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-success me-2" type="button" href="{{route('receptionistList')}}">Receptionist List</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-success me-2" type="button" href="{{route('guestList')}}">Guest list</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-success me-2" type="button" href="{{route('createNew')}}">Add New User</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-success me-2" type="button" href="{{route('addRoom')}}">Add Room</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-success me-2" type="button" href="{{route('room')}}">Room</a>
        </li>
        
        
      </ul>
      <!-- Left links ->

      <!-- Avatar -->
      @if(session()->has('id'))

      <div class="dropdown">
        <a
          class="dropdown-toggle d-flex align-items-center hidden-arrow"
          href="#"
          id="navbarDropdownMenuAvatar"
          role="button"
          data-mdb-toggle="dropdown"
          aria-expanded="false"
        >
          <img
            src="{{asset('image/profile_icon.png')}}"
            class="rounded-circle"
            height="35"
            alt="profile icon"
          />
        </a>
        <ul
          class="dropdown-menu dropdown-menu-end"
          aria-labelledby="navbarDropdownMenuAvatar"
        >
          <li>
            <a class="dropdown-item" href="{{route('profile')}}">Profile</a>
          </li>
          <li>
            <a class="dropdown-item" type="button" data-mdb-toggle="modal" data-mdb-target="#staticBackdrop">Logout</a>
          </li>
        </ul>
      </div>
      @endif
    </div>
    <!-- Right elements -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->
<!-- Modal -->
<div
  class="modal fade"
  id="staticBackdrop"
  data-backdrop="static"
  data-keyboard="false"
  tabindex="-1"
  aria-labelledby="staticBackdropLabel"
  aria-hidden="true"
>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Confirmation</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h6>Do You want to logout?</h6>
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</a>
        <a class="btn btn-danger btn-sm" type="button" href="{{route('logout')}}"">Logout</a>
      </div>
    </div>
  </div>
</div> 
 

 <!-- TOP Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light ml-6">

 <!-- Left navbar links -->
 <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>  
  </ul>

<ul class="navbar-nav ml-auto">      
  <!-- Messages Dropdown Menu -->
  <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
    <img
            src="{{asset('image/profile_icon.png')}}"
            class="rounded-circle"
            height="25"
            alt="profile icon"
          />
    </a>
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <a class="dropdown-item" href="{{route('adminProfile')}}">Profile</a>
        <a class="dropdown-item" type="button" data-toggle="modal" data-target="#staticBackdrop">Logout</a>
    </div>
  </li>
</ul>
</nav>
<!-- /.top-navbar -->


<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
      <img src="{{ asset('hotel.ico') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light">HOME</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('image/profile_icon.png')}}" class="rounded-circle"
            height="35"
            alt="profile icon"
           >
        </div>
        <div class="info">
          <a href="{{route('adminProfile')}}" class="d-block">Admin Name</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               
               <li class="nav-header">LEBEL</li>
               <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-user-secret"></i>
              <p>
                Admin
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview  ml-4">
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fa fa-user-plus" style='color: blue'></i>
                  <p>Add Admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa fa-users" style='color: blue'></i>
                  <p>Admin List</p>
                </a>
              </li>
            </ul>
          </li>

         
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class='fas fa-user-tie'></i>
              <p>
                Receiptionist
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview  ml-4">
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far  fa fa-user-plus" style='color: green'></i>
                  <p>Add Receiptionist</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                <i class="far fa fa-users" style='color: green'></i>
                  <p>Receiptionist List</p>
                </a>
              </li>

            </ul>

          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fa fa-user-circle"></i>
              <p>
                Guest
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview  ml-4">
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far  fa fa-user-plus" style='color: yellow'></i>
                  <p>Add Guest</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                <i class='far fa fa-users' style='color: yellow'></i>
                  <p>Guest List</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class='fas fa-hotel' style='color: white'></i>
              <p>
                Rooms
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview  ml-4">
              <li class="nav-item">
                <a href="" class="nav-link">
                <i class='fa fa-plus' style='color:#796c0b'></i>
                  <p>Add Room</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                <i class='fa fa-list' style='color:#796c0b'></i>
                  <p>Room List</p>
                </a>
              
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Multi Level
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview ml-4">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    level 1
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview ml-4">
                  <li class="nav-item">
                    <a href="" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>level 2</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>level 2</p>
                    </a>
                  </li>
                  
                </ul>
              </li>                
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>level 1</p>
                </a>
              </li>
            </ul>
            
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  

</div>

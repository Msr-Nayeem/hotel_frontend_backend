<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link href="{{asset('css/all.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/mdb.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/addRoom.css')}}" rel="stylesheet"/>
  
    <link rel="stylesheet" href="{{asset('css/createUser.css')}}">  
    <script type="text/javascript" src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
    <title>Hotel Management</title>
    
    <style>
      *{
        margin: 0px;
        border: 0px;
      }
      th{
        text-align: center;
      }
      body{
        background: #f7f7ff;
        margin-top:20px;
      }
    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid transparent;
        border-radius: .25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
    }
    .me-2 {
        margin-right: .5rem!important;
    }
    
  </style>
  </head>
  <body class="p-3 m-0 border-0 bd-example" >
   @include('inc.newNav')
   <br><br>
    <div class="container">
      @yield('content')
    </div>
  
    <script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>
    @yield('scriptList')
  </body>
</html>
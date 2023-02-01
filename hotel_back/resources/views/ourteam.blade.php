
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <title>Lab Task 1</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body class="p-3 m-0 border-0 bd-example">
    <nav class="navbar bg-light">
        <div class="container-fluid justify-content-start">
        <a class="btn btn-outline-success me-2" type="button" href="{{route('home')}}">Home</a>
        <a class="btn btn-outline-success me-2" type="button" href="{{route('service')}}">Service</a>
        <a class="btn btn-outline-success me-2" type="button" href="{{route('ourteam')}}">Our team</a>
        <a class="btn btn-outline-success me-2" type="button" href="{{route('contact')}}">Contact</a>
        <a class="btn btn-outline-success me-2" type="button" href="{{route('about')}}">About us</a>
        </div>
    </nav>
    <div class="container">
    <h1>Our Team</h1>
    An overview of the founding team and core contributors
    <ol>
    @foreach($teams as $member)
    <li>Name : {{$member->namee}} <br>address : {{$member->address}}</li>
    @endforeach
</ol>
    </div>
  </body>
</html>
<html>
<head>

    <link rel="stylesheet" href="{{asset('css/newLogin.css')}}">
    <title>Login</title>

</head>
<body>
    <div class="container">
            <div class="header">
            <h3>Welcome</h3>
            </div>
            <form action="{{route('loginn')}}" class="form-group" method="post" autocomplete="off">
                {{csrf_field()}}   
            <div>
                <i class="fa fa-envelope" id="email" aria-hidden="true"></i>
                <input type="email" name="email" id="email" placeholder="Email" value="{{request()->cookie(key: 'email')}}">

            </div>
            <div>
                <i class="fa fa-lock" id="lock"></i>
                <input type="password" name="password" id="password" placeholder="Password"  value="{{request()->cookie(key: 'password')}}">  
            </div>
            <div>
                <input type="checkbox" class="form-check-input" name="remember" value="remember" @if (Cookie::get('email') !== null){ checked } @endif>
                <label class="form-check-label">Remember me</label> <br><br>
            </div>
            <button type="submit" class="log-in" name="log-in">Log In</button>
            <button type="button" class="log-in" id="sign-up" style="margin-left: 3%;" onclick="newAccount()">Sign Up</button>
            </form>
            @if($errors->any())
                <div class="err">
                <h4>{{$errors->first()}}</h4>
                </div>
            @endif
    </div>

    <script>
        function newAccount(){
            location.href="/createUser";
        }

</script>
</body>
</html>
<head>
<link href="{{asset('css/mdb.min.css')}}" rel="stylesheet"/>
<link rel="stylesheet" href="{{asset('css/createUser.css')}}">
    <title>New Account</title>
</head>
<section class="vh-100 bg-image"
  style="background-image: url('{{asset('image/createUser.webp')}}');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Create an account</h2>

              <form action="{{route('createUser')}}" onsubmit="return validate()" method="post" autocomplete="off">
              {{csrf_field()}}
                <div class="form-outline mb-4">
                
                  <input type="text" id="name" class="form-control form-control-lg" name="name"/>
                  <label class="form-label" for="name">Your Name</label>
                </div>
                <span class="text-danger" id="name_error"></span>

                <div class="form-outline mb-4">
                  <input type="email" id="email" class="form-control form-control-lg" name="email"/>
                  <label class="form-label" for="email">Your Email</label>
                </div>
                <span class="text-danger" id="email_error"></span>

                <div class="form-outline mb-4">
                  <input type="password" id="password" class="form-control form-control-lg" name="password"/>
                  <label class="form-label" for="password">Password</label>
                </div>
                <span class="text-danger" id="password_error"></span>

                <div class="form-outline mb-4">
                  <input type="password" id="repassword" class="form-control form-control-lg" />
                  <label class="form-label" for="repassword">Repeat your password</label>
                </div>
                <span class="text-danger" id="password_errorr"></span>

                <div class="form-outline mb-4">
                  <input type="text" id="phone" class="form-control form-control-lg" name="phone"/>
                  <label class="form-label" for="phone">Phone</label>
                </div>
                <span class="text-danger" id="phone_error"></span>

                <div class="form-check d-flex justify-content-center mb-5">
                  <input class="form-check-input me-2" type="checkbox" value="1" id="check" />
                  <label class="form-check-label" for="form2Example3g">
                    I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                  </label>
                </div>

                <div class="d-flex justify-content-center">
                  <button type="submit"
                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" id="regButton">Register</button>
                </div>

                <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="/studentLogin"
                    class="fw-bold text-body"><u>Login here</u></a></p>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript" src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>
<script>
   var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      if (confirm("Press Ok to go Login Page\n Cancel to create another user") == true)
      {
        location.href="/studentLogin";
      } 
    }
      function validate(){

        var name = document.getElementById("name").value;
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        var repassword = document.getElementById("repassword").value;
        var phone = document.getElementById("phone").value;

        if(name.length <6){
          document.getElementById("name_error").innerHTML="Min 6 char<br><br>";
          return false;
        }
        else{
          document.getElementById("name_error").innerHTML="";
        }

        if(email.length <11){
          document.getElementById("email_error").innerHTML="Enter a valid Mail<br><br>";
          return false;
        }
        else{
          document.getElementById("email_error").innerHTML="";
        }

        if(password.length <= 4){
          document.getElementById("password_error").innerHTML="Min 5 char<br><br>";
          return false;
        }
        else{
          document.getElementById("password_error").innerHTML="";
        }

        if(repassword.length <= 4){
          document.getElementById("password_errorr").innerHTML="Min 5 char<br><br>";
          return false;
        }
        else{
          document.getElementById("password_errorr").innerHTML="";

        }

        if(repassword != password){
          if(repassword.length <= 4){
            document.getElementById("password_errorr").innerHTML="Min 5 char<br><br>";
            return false;
          }
          else{
            document.getElementById("password_errorr").innerHTML="Must Be same as Password<br><br>";
            return false;
          }
          
        }
        else{
          document.getElementById("password_errorr").innerHTML="";
          document.getElementById("password_error").innerHTML="";
        }

        if(phone.length < 11){
          document.getElementById("phone_error").innerHTML="11 digit must<br><br>";
          return false;
        }
        else{
          document.getElementById("phone_error").innerHTML="";
        }
        return true;
      
      }
</script>
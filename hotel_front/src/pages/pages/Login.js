import React, {useState} from "react";
import { useNavigate } from "react-router-dom";



import LoginCSS from "./Login.module.css";
import axios from "axios"; 

function Login() {
  let[email, setEmail] = useState("");
  let[password, setPassword] =useState("");
  const navigate = useNavigate();
  const loginSubmit = (e) => {
    e.preventDefault();

    var obj = {email: email, password: password};
    axios.post("http://127.0.0.1:8000/api/apiLogin",obj)
        .then(resp=>{  
              
            var token = resp.data;            
            if(token !== "failed"){
              localStorage.setItem('user',token);
              navigate("/studentList");
              console.log("login done");
              /* console.log(localStorage.getItem('user')); */

            }
            else{
              console.log("login failed");
            }
        }).catch(err=>{
            console.log(err);
        });
  };
  
  // JSX code for login form
  const renderForm = (
    <div className={LoginCSS.container}>
            <div className="header">
            <h3 className={LoginCSS.hd}>Welcome</h3>
            </div>
            
            <form autoComplete="off">
             
            <div> 
                <input
                        type="email"
                        id={LoginCSS.email}
                        value={email}
                        onChange={(e)=>setEmail(e.target.value)}
                        placeholder="Email"                            
                    />

            </div>
            <div>
              <input
              type="password"
              id={LoginCSS.password}
              value={password} 
              onChange={(e)=>setPassword(e.target.value)}
              placeholder="Password"                           
            />
            </div>
            <div>
                <input type="checkbox" className={LoginCSS.formCheckInput} name="remember" value="remember" />
                <label>Remember me</label> 
            </div>
            <button type="button" 
            className={LoginCSS.logIn} 
            name="logIn" 
            onClick={loginSubmit}
            >Log In</button>

            <button type="button" className={LoginCSS.logIn} id={LoginCSS.signUp} onClick={()=> window.location.href='/Registration'}>Sign Up</button>
            </form>           
    </div>
  );

  return (
    <div className="Login">
      <div className="loginForm">
        {renderForm}      
      </div>
    </div>
  );
}


export default Login;
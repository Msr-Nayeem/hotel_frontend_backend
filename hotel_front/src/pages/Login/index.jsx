import React, {useState} from "react";
import { useNavigate } from "react-router-dom";
import axios from "axios"; 

import {Loading, LoadingClose, CustomAlert} from "../../components/Alert"; 

function Login() {
  document.title="Login to GrandView";
  let[email, setEmail] = useState("");
  let[password, setPassword] =useState("");
  const navigate = useNavigate();

  const loginSubmit = (e) => {
    e.preventDefault();
    Loading();
    var obj = {email: email, password: password};
    axios.post("http://127.0.0.1:8000/api/login",obj)
        .then(resp=>{              
            var token = resp.data;  
            if(token === "block"){
              LoadingClose();
              CustomAlert("error", "Ops !", "You are blocked");
            }          
            else if(token !== "error" && token !== "block"){
              localStorage.setItem('user',token);
              LoadingClose();
              navigate("/home");
            }
            else{
              LoadingClose();
              CustomAlert("error", "Error !", "Email/Password not mathced");
            }
        }).catch(err=>{          
          LoadingClose();
          CustomAlert("info", "Error !", "Axios Connection Error");
        });
  };


  //Checking right mail or not
/*   const send = () =>{  
      
    axios.get('https://emailvalidation.abstractapi.com/v1/?api_key=b535ff641c2740ec8c211dad7bfe259d&email=msrnayeemm@gmail.com')
    .then(response => {
        console.log(response.data.deliverability);
    })
    .catch(error => {
        console.log(error);
    });       
    }
 */
  
  return (
    <div className="Login">
      <div className="loginForm">
        <div className="Lcontainer">
            <div className="header">
              <h3 className="hd">Welcome</h3>
            </div>
              <form>              
              
                  <input
                          type="email"
                          id="email"
                          value={email}
                          onChange={(e)=>setEmail(e.target.value)}
                          placeholder="Email"                            
                      />
             
              
                <input
                type="password"
                id="password"
                value={password} 
                onChange={(e)=>setPassword(e.target.value)}
                placeholder="Password"                           
              />
              
              <div>
                  <input type="checkbox" className="formCheckInput" name="remember" value="remember" />
                  <label>Remember me</label> <br></br>
                  <span  className="formCheckInput" onClick={()=> navigate("/reset")} style={{ cursor : 'pointer', color: 'darkBlue', textDecoration : 'underline'}}>Forgot password ?</span>
              </div>
              <button type="button" className="logIn" name="logIn" onClick={loginSubmit}>Log In</button>

              <button type="button" className="logIn" id="signUp" onClick={()=> navigate("/Registration")}>Sign Up</button>
              </form>          
      </div>    
      </div>
    </div>
  );
}


export default Login;
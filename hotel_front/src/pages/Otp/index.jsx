import React, {useState} from "react";
import { useNavigate } from "react-router-dom";
import axios from "axios"; 

import {Loading, LoadingClose, CustomAlert} from "../../components/Alert";

function Reset() {
  document.title = "Reset";
  let[otp, setOtp] = useState("");
  const navigate = useNavigate();
  
  function cancel(){
    navigate("/reset");
  }


  const otpSubmit = (e) => {
    e.preventDefault();
    Loading();
    var reset_tkn = localStorage.getItem('reset_token');
    axios.get("http://127.0.0.1:8000/api/matchotp",{ params: {otp_no: otp, token_no: reset_tkn} })
        .then(resp=>{   
                
          if(resp.data !== "wrong otp"){
            LoadingClose();
            localStorage.removeItem("reset_token");
            localStorage.setItem('reset_email', resp.data);
            navigate("/newPassword");
          }
          else{
              LoadingClose();
              CustomAlert( "error", "Wrong Info", "please provide correct otp");
          }
          
        }).catch(err=>{ 
          LoadingClose();
          CustomAlert( "info", "Error !", "Axios Connection Error");
        }); 
  };

  return (
    <div className="Login">
          <div className="loginForm">
                <div className="Lcontainer">
                <div className="header">
                <h3 className="hd">OTP</h3>
                </div>
                
                <form autoComplete="off">
                
                <div> 
                    <input
                            type="text"
                            id="email"
                            value={otp}
                            onChange={(e)=>setOtp(e.target.value)}
                            placeholder="Enter Otp"                            
                        />

                </div>
                
                <button type="button" className="logIn" name="logIn" onClick={otpSubmit}>Submit</button>
                <button type="button" className="logIn" id="signUp" onClick={cancel}>Back</button>
                </form>           
        </div>     
      </div>
    </div>
  );
}


export default Reset;
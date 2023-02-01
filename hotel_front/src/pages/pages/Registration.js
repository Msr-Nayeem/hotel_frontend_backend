import axios from 'axios';
import React, {useState} from 'react';
import 'bootstrap/dist/css/bootstrap.css';

import './Registration.css'


function Registration() {
    
    const [Name, setName] = useState("");
    const [Phone, setPhone] = useState("");
    const [email, setEmail] = useState("");
    const [password,setPassword] = useState("");
    const [dob,setDob] = useState("");
    
    const handleInputChange = (e) => {
        const {id , value} = e.target;
        if(id === "Name"){
            setName(value);
        }
        if(id === "Phone"){
            setPhone(value);
        }
        
        if(id === "email"){
            setEmail(value);
        }
        if(id === "password"){
            setPassword(value);
        }
        if(id === "dob"){
            setDob(value);
        }
        

    }

    const handleSubmit  = () => {
        var obj = {name:Name, email: email, password: password, phone:Phone, dob:dob};


        axios.post("http://127.0.0.1:8000/api/apiRegistration",obj)
        .then(resp=>{   
            var token = resp.data;             
            alert(token);

        }).catch(err=>{
            console.log(err);
        });
        // console.log(Name,email,password,dob,Phone);
    }

    return(
        <div className="form">
            <div className="form-body">
                <div className="name">
                    <label className="form__label" >Name </label>
                    <input className="form__input" type="text" value={Name} onChange = {(e) => handleInputChange(e)} id="Name" placeholder="First Name"/>
                </div>
                
                <div className="email">
                    <label className="form__label" >Email </label>
                    <input  type="email" id="email" className="form__input" value={email} onChange = {(e) => handleInputChange(e)} placeholder="Email"/>
                </div>
                <div className="password">
                    <label className="form__label" >Password </label>
                    <input className="form__input" type="password"  id="password" value={password} onChange = {(e) => handleInputChange(e)} placeholder="Password"/>
                </div>
               
                <div className="phone">
                    <label className="form__label" >Phone</label>
                    <input className="form__input" type="text" id="Phone" value={Phone} onChange = {(e) => handleInputChange(e)} placeholder="phone no"/>
                </div>
                <div className="dob">
                    <label className="form__label" >Date of Birth</label>
                    <input className="form__input" type="date" id="dob" value={dob} onChange = {(e) => handleInputChange(e)}/>
                </div>
            </div>
            <div className="footer">
                <button onClick={()=>handleSubmit()} type="submit" className="btn">Register</button>
            </div>
        </div>
       
    )       
}

export default Registration;
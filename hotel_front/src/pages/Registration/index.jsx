import axios from 'axios';
import { useNavigate } from "react-router-dom";
import { useForm } from "react-hook-form";
import 'bootstrap/dist/css/bootstrap.css';
import './Registration.css'
import { useState, useEffect } from 'react';
import {Loading, LoadingClose, CustomAlert, sweetConfirm} from "../../components/Alert"; 

function Registration() {
    const navigate = useNavigate();
    const { register, handleSubmit, formState: { errors } } = useForm();
    document.title = "New Account";
   
    const [divisionsList, setDivisions] = useState([]);
    const [districtList, setDistrictList] = useState([]);
    const [upazilaList, setUpazilasList] = useState([]);
    const [divisionId, setDivisionId] = useState('');
    const [districtId, setDistrictId] = useState('');
    const [division_name, setDivision_name] = useState('');
    const [district_name, setDistrict_name] = useState('');
    const [upazila_name, setUpazila_name] = useState('');

    useEffect(() =>{
        axios.get("http://127.0.0.1:8000/api/getDivisions")
            .then(resp=>{                          
               setDivisions(resp.data);    
            }).catch(err=>{
                console.log("getCity",err);
            });
    }, [])

    useEffect(() =>{
        axios.get("http://127.0.0.1:8000/api/getDistricts",{ params: {belongs:divisionId } })
            .then(resp=>{                          
                setDistrictList(resp.data); 
            }).catch(err=>{
                console.log("getDistrict",err);
            });
    }, [divisionId])

    useEffect(() =>{
        axios.get("http://127.0.0.1:8000/api/getUpazilas",{ params: {belongs:districtId } })
            .then(resp=>{                          
                setUpazilasList(resp.data); 
            }).catch(err=>{
                console.log("getArea",err);
            });
    }, [districtId])

    const setDivision = (event) => {
        setDivisionId(event.target.value);
        const {options, selectedIndex} = event.target;
        setDivision_name(options[selectedIndex].innerHTML);
    }
    const setDistrict = (event) => {
        setDistrictId(event.target.value);
        const {options, selectedIndex} = event.target;
        setDistrict_name(options[selectedIndex].innerHTML);
    }
    const setUpazilas = (event) => {
        const {options, selectedIndex} = event.target;
        setUpazila_name(options[selectedIndex].innerHTML);
    }

    const onSubmit = (data) => {
        
        var new_data = {name:data.name, email: data.email, password: data.password,
         phone: data.phone, dob: data.dob, division : division_name, district: district_name, upazila: upazila_name};
        Loading();
        axios.post("http://127.0.0.1:8000/api/registration",new_data)
        .then(resp=>{   
            if(resp.data === "success"){
                LoadingClose();
                document.getElementById("regForm").reset();
                CustomAlert("success", "Registerd", "Account created successfully");
                sweetConfirm("✓", "Registerd", "Account created successfully. Redirecting to Login Page")
                    .then(confirmed => {
                        if(confirmed.isConfirmed){
                            navigate("/");
                        }
                    });
            }
            else{
                LoadingClose();
                CustomAlert("Error", "Failed", "Something went wrong"); 
            }
        }).catch(err=>{
            LoadingClose();
            CustomAlert("Error", "API", "Axios Api error"); 
            console.log("admin reg", err);
        });  
      }
  
    return(
        <form className='form' id='regForm' autoComplete='off' onSubmit={handleSubmit(onSubmit)}>
            <div className="form-body">
                <div className="name">
                    <label className="form__label" >Name </label>
                    <input className="form__input" type="text" placeholder="Enter Name" {...register("name", { required: true, minLength: 5 })}/>
                    {errors.name && <p>Min :5</p>}
                </div>
                
                <div className="email">
                    
                    <label className="form__label" >Email </label>
                    <input  type="text"  className="form__input" placeholder="Email" {...register("email", 
                        { 
                            required: true,
                            // eslint-disable-next-line  
                            pattern: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{3,}))$/ 
                        })}
                    />
                    {errors.email && <p>Enter Valid Email</p>}
                </div>
                <div className="password">
                    <label className="form__label" >Password </label>
                    <input className="form__input" type="password" placeholder="Password" {...register("password", { 
                            required: true, 
                            pattern: /^(?=.*\d)(?=.*[a-z]).{5,15}$/
                        })}
                    />
                    {errors.password && <p>minimum 5, letter and digit must</p>}
                </div>
               
                <div className="phone">
                    <label className="form__label" >Phone</label>
                    <input className="form__input" type="text" placeholder="phone no" {...register("phone", { required: true, minLength: 11 })}/>
                </div>
                {errors.phone && <p>Enter Phone Number</p>}
                <div className="dob">
                    <label className="form__label" >Date of Birth</label>
                    <input className="form__input" type="date" {...register("dob", { required: true})}/>
                    {errors.dob && <p>Required</p>}
                </div>
                <div>
                <label className="form__label" >City Name</label>
                 <select name='division' className="form__input" required onChange={setDivision}>
                    <option value="">Choose Division</option>
                    {divisionsList.map(options => 
                        (
                            <option value={options.id} key={options.id} >{options.name}</option>
        
                        ))
                    }
                </select> 
                </div>
                <div>
                <label className="form__label" >District Name</label>
                 <select className="form__input" name='district' required onChange={setDistrict}>
                    <option value="">Choose District</option>
                    {districtList.map(options => 
                        (
                            <option value={options.id} key={options.id} >{options.name}</option>
        
                        ))
                    }
                </select> 
                </div>
                <div>
                <label className="form__label" >Upazila Name</label>
                 <select className="form__input" name='upazila' required onChange={ setUpazilas}>
                    <option value="">Choose Upazila</option>
                    {upazilaList.map(options => 
                        (
                            <option value={options.id} key={options.id} name="{options.name}">{options.name}</option>
                        ))
                    }
                </select> 
                </div>
            </div>
            <div className="footer">
                <button  type="submit" className="btn">Register</button>
                <button type="button" className="btn" id='btnn' onClick={() => navigate(-1)}>Login</button>
            </div>
        </form>
       
    )       
}

export default Registration;
import React, {useState, useEffect} from 'react';
import DashboardHeader from '../../components/DashboardHeader';
import {useNavigate, useParams} from 'react-router-dom';
import '../styles.css';

import SideBar from '../../components/Sidebar';
import sidebar_menu from '../../constants/sidebar-menu';
import {CustomAlert} from '../../components/Alert';
import axios from 'axios';

function Update () {
    let { table_name } = useParams();
    let { idd } = useParams();
    
    const [user, setUser] = useState({
        name: "",
        email: "",
        phone: "",
        dob: ""
      });
    
    const { name, email, phone,dob } = user;
    
    const onInputChange = (e) => {
        setUser({ ...user, [e.target.name]: e.target.value });
      };
    
      
      useEffect(() => {
       
        axios.get("http://127.0.0.1:8000/api/getDetails",{ params: {table: table_name, user_id:idd } })
            .then(resp=>{                                              
            setUser(resp.data);
           
            }).catch(err=>{
                console.log("details",err);
            });
    
        }, [idd, table_name]);
    
       const onSubmit = async (e) => {
        
        e.preventDefault();
        var obj = {table: table_name, user_id:idd, Name:name, Email: email, Phone:phone, DOB:dob};
        
         axios.post("http://127.0.0.1:8000/api/userUpdate",obj)
        .then(resp=>{     
            if(resp.data === "done"){
                CustomAlert("success", "Done", "Successfully updated.");             
                back();
            }
            else{
                CustomAlert("error", "Ops", "something went wrong.");
            }

        }).catch(err=>{
            console.log("edit error", err);
        }); 
        
      };
      const navigate = useNavigate();

      const back = () => {
       navigate(-1);
      }; 
    
    return(
        <div className='dashboard-container'>
        <SideBar menu={sidebar_menu} />
        <div className='dashboard-content'>
            <DashboardHeader />
            <div className='profile-content-container'>
                <div className='dashboard-content-header'>
                    <h2>Personal Information</h2> 
                </div>
                
            <div className="form">
              <form onSubmit={(e) => onSubmit(e)}>     
            <div className="form-body">
                <div className="name">
                    <label className="form__label" >Name </label>
                    <input className="form__input" type="text"   placeholder="First Name"
                    name="name" value={name}
                    onChange={(e) => onInputChange(e)}/>
                </div>
                
                <div className="email">
                    <label className="form__label" >Email </label>
                    <input  type="email"  className="form__input" placeholder="Email"
                    name="email" value={email}
                    onChange={(e) => onInputChange(e)}/>
                </div>
                <div className="phone">
                    <label className="form__label" >Phone</label>
                    <input className="form__input" type="text" placeholder="phone no"
                    name="phone" value={phone}
                    onChange={(e) => onInputChange(e)}/>
                </div>
                <div className="dob">
                    <label className="form__label" >Date of Birth</label>
                    <input className="form__input" type="date" 
                    name="dob" value={dob}
                    onChange={(e) => onInputChange(e)}/>
                </div>
            </div>
            <div className="row">
                <div className="col-md-3">
                        <button className="btn btn-primary" type='submit'>Update</button>
                    </div>
                <div className="col-md-3">
                        <button className="btn btn-primary" type='button' onClick={back}>Cancel</button>
                    </div>  
                </div>
            </form> 
        </div>
                

            </div>
        </div>
        </div>
    )
}

export default Update;
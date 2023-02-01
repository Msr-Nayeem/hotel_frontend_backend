import React from 'react';
import { confirmAlert } from 'react-confirm-alert'; // Import
import 'react-confirm-alert/src/react-confirm-alert.css'; // Import css
import './styles.css';
import { useNavigate } from "react-router-dom";
import LogoutIcon from '../../assets/icons/user.svg';

import axios from 'axios';


function DashboardHeader ({ btnText, onClick }) {
    const navigate = useNavigate();
    function logOut(){
        confirmAlert({
      title: 'Logout',
      message: 'Are you sure to logout.?',
      buttons: [
        {
          label: 'Yes',
          onClick: () =>doLogout()
        },
        {
          label: 'No',
          onClick: () => console.log('')
        }
      ]
    });
    }

    function doLogout (){
        
       
        let user = localStorage.getItem('user');
        var obj = { token_no:user };
            axios.post("http://127.0.0.1:8000/api/logout",obj)
            .then(resp=>{
                var result = resp.data;
                if(result === "done"){
                    localStorage.removeItem("user");
                    navigate("/");    
                }
                           
            }).catch(err=>{
                console.log(err);
            });
    
    
    }


    return(
        <div className='dashbord-header-container'>
            
            <div></div>
            

            <div className='dashbord-header-right'>
                <img 
                    src={LogoutIcon}
                    alt='Logout-icon'
                    className='dashbord-header-icon' 
                    onClick={logOut}/>
              
            </div>
        </div>
    )
}

export default DashboardHeader;
import { Outlet, useNavigate } from "react-router-dom";
import {useEffect} from 'react';

function Auth() {
    const nav = useNavigate();
    useEffect(()=>{
        const token = localStorage.getItem('user');
        if(!token){
            nav('/');
        }
    },[nav])
    
  return (<Outlet />)
}

export default Auth
import { useState } from 'react';
import axios from 'axios';

import DashboardHeader from '../../components/DashboardHeader';
import SideBar from '../../components/Sidebar';
import sidebar_menu from '../../constants/sidebar-menu';
import '../styles.css';

import {Loading, LoadingClose, CustomAlert} from '../../components/Alert';

function Home () {
    document.title = "Add New Room";
    //const [cetegoryList, setCetegoryList] = useState([]);
    const [slCetegory, setSlCetegory] = useState("");
    const [rent, setRent] = useState("");
    

    //CETEGORY
/*     useEffect(() =>{
        const fetchData = async ()=>{
            const response = await fetch(`http://127.0.0.1:8000/api/getCetegory`);
            const newData = await response.json();
            setCetegoryList(newData);
           
        };
        fetchData();
    }, [])
 */

    const  handeCetegory  = (event) =>{
        setSlCetegory(event.target.value);
    }
    
    const newRoom = (event) =>{
        if(slCetegory !== "" && rent !== ""){
            Loading();
            axios.get("http://127.0.0.1:8000/api/addRoom",{params:{cetegory:slCetegory , rent: rent}})
            .then(resp=>{  
                setRent(''); 
                LoadingClose();
                if(resp.data === "success"){
                    CustomAlert(resp.data, "Room added successfully", resp.data);
                }
                else{
                    CustomAlert(resp.data, "Something error", resp.data);
                }
                       
            }).catch(err=>{
                console.log("booking", err);
            });
        }
        else{
            CustomAlert( "info", "Alert", "Select all the requirements"); 
        }
        
    }
   
    return(
        <div className='dashboard-container'>
        <SideBar menu={sidebar_menu} />
        
        <div className='dashboard-content'>
            <DashboardHeader btnText="Dashboard"/>
            
            <div className='addRoom-content-container' >
                <select className="selects"  onChange={ handeCetegory }>
                    <option value="">Choose Cetegory</option>
                    <option value="regular">Regular</option>
                    <option value="premium">Premium</option>
                    <option value="delux">Delux</option>
                </select>
                
                <input
                        type="text"
                        className='selects'
                        value={rent}
                        onChange={(e)=>setRent(e.target.value)}
                        placeholder="Input Rent"                            
                />
                <button type='button' className='btnAdd' onClick={newRoom}>Add</button>
                               
            </div>
        </div>
        
        </div>
    )
}

export default Home;
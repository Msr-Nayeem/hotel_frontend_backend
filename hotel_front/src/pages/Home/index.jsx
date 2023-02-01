import { useEffect, useState } from 'react';
import axios from 'axios';
import * as React from 'react';
import DatePicker from "react-datepicker";
import moment from 'moment/moment';
import "react-datepicker/dist/react-datepicker.css";


import DashboardHeader from '../../components/DashboardHeader';
import SideBar from '../../components/Sidebar';
import sidebar_menu from '../../constants/sidebar-menu';
import {CustomAlert} from '../../components/Alert';
import '../styles.css';


function Home () {
    document.title="Homepage";
    const [customerList, setCustomerList] = useState([]);
    const [customerId, setCustomerId] = useState(null);

    // const [cetegoryList, setCetegoryList] = useState([]);
    const [slCetegory, setSlCetegory] = useState(null);
    const [trigger, setTrigger] = useState(false);

    const [roomAv, setRoomsAv] = useState([]);
    const [roomId, setRoomsId] = useState(null);
    const [rent, setRent] = useState(null);

    const [startDate, setStartDate] = useState(null);
    const [endDate, setEndDate] = useState(null);
    

    //CUStOMER
    
    useEffect(() => {
        
        axios.get("http://127.0.0.1:8000/api/getCustomer")
            .then(resp=>{                                             
                setCustomerList(resp.data);
            }).catch(err=>{
                console.log("getCustomer",err);
            });    
        }, [trigger]);



    //CETEGORY
/*     useEffect(() =>{
        axios.get("http://127.0.0.1:8000/api/getCetegory")
            .then(resp=>{                                            
                setCetegoryList(resp.data);
            }).catch(err=>{
                console.log("getCetegory",err);
            });
        
    }, [])
 */
    //AVAILABLE ROOM
    useEffect(() =>{
        axios.get("http://127.0.0.1:8000/api/getRooms", {params: { inCetegory: slCetegory } })
            .then(resp=>{                          
                setRoomsAv(resp.data); 
                setTrigger(true);
            }).catch(err=>{
                console.log("getRooms",err);
            });
    }, [slCetegory])

    useEffect(() =>{
        
         axios.get("http://127.0.0.1:8000/api/getRent",{ params: {roomID:roomId } })
        .then(resp=>{               
         setRent(resp.data);
         console.log("Rent",resp.data);
        }).catch(err=>{
            console.log("getRent",err);
        }); 
    }, [roomId])
   

    function getRange(){ 
        if(startDate !== null && endDate !== null){
            var diff = moment(endDate).diff(startDate,'days') 
            if(diff <1){
               
                return "1";
            }
            else{ 
                return diff;
            }
        }
        else{
            return "..."
        }      
    }
    function calcRent(){
         if(roomId !== null && rent !== null && getRange() !== "..."){
            return rent*getRange(); 
         }
        else{
            return "...";
        }
          
    }
    const makeBooking = (event) =>{
        if(startDate !== null && endDate !== null && roomId !== null && slCetegory !== null && customerId !== null){
            
             axios.get("http://127.0.0.1:8000/api/makeBooking",{params:{room_id:roomId , customer_id: customerId}})
            .then(resp=>{ 
                 if(resp.data === "done"){
                    CustomAlert( "success", "Oww", "Room booked successfully");
                }                                             
                else{
                    CustomAlert( "error", "Ops !","Something wrong");
                }
            
            }).catch(err=>{
                CustomAlert( "info", "Error !", "API Error");
                console.log("Booking",err);
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
            <div className='booking-content-container' >
            <section>
                <section>
                <DatePicker dateFormat="dd/MM/yyyy" todayButton="Today"
                    selected={startDate} onChange={(date) => setStartDate(date)}
                    selectsStart startDate={startDate}
                    endDate={endDate} minDate={new Date()}
                    showMonthDropdown dropdownMode="select"
                    className="selects" openToDate={new Date()}
                    placeholderText="Check In Date" id='lft'
                /> 
                <DatePicker dateFormat="dd/MM/yyyy" selected={endDate}
                    onChange={(date) => setEndDate(date)} selectsEnd
                    startDate={startDate} endDate={endDate}
                    minDate={startDate} placeholderText="Check out Date"
                    className="selects" id='lft' 
                />
                </section>
                <select className="selects"  onChange={event => setSlCetegory(event.target.value)}>
                    <option value="">Choose Cetegory</option>
                    <option value="regular">Regular</option>
                    <option value="premium">Premium</option>
                    <option value="delux">Delux</option>
                </select>
                
                <select className="selects"  onChange={event =>  setRoomsId(event.target.value)}>
                    <option value="">Choose room</option>
                    {roomAv.map(rooms => 
                        (
                            <option value={rooms.id} key={rooms.id} >id- {rooms.id}- {rooms.cetegory}-({rooms.rent_per_day}Tk)</option>
                        ))
                    }
                </select>
                
            
                <select className="selects" onChange={event => setCustomerId(event.target.value)}>
                    <option value="">Choose Customer</option>
                    {customerList.map(options => 
                        (
                            <option value={options.id} key={options.id} >(id-{options.id})- {options.name}</option>
        
                        ))
                    }
                </select>
                </section>
                <button type='button' className='btnn' onClick={makeBooking}>Booking</button>
                
            </div>
            <div className='selected-content-container'>
               
                Stay Time : {getRange()} Days<br/>
                Cetegory : {slCetegory !== null ? <>{slCetegory}</>
                :<>...</>}<br></br>
                Room id : {roomId !== null ? <> {roomId}</>
                :<>...</>}<br></br>
                Room rent(day) : {rent !== null ? <> {rent} </>
                :<>...</>} BDT<br></br>
                Customer id : {customerId !== null ? <> {customerId}</>
                :<>...</>}<br></br>
                Total Rent : {calcRent()} BDT

            </div> 
        </div>
        
        </div>
    )
}

export default Home;
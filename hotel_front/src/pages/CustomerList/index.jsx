import React, {useState, useEffect} from 'react';
import ReactHTMLTableToExcel from 'react-html-table-to-excel';

import DashboardHeader from '../../components/DashboardHeader';
import SideBar from '../../components/Sidebar';
import sidebar_menu from '../../constants/sidebar-menu';
import {Link} from 'react-router-dom';
import axios from 'axios';

import '../styles.css';

import {sweetConfirm, CustomAlert, ColorLoading} from '../../components/Alert';

function CustomerList () {
    document.title = "Customers List";
    const [search, setSearch] = useState('');
    const [customer, setCustomer] = useState([]);
    const [isLoading, setLoading] = useState(true);
    useEffect(() => {
        setLoading(true);
    axios.get("http://127.0.0.1:8000/api/viewList",{ params: {table: "customers" ,searchh: search } })
        .then(resp=>{                                              
            setCustomer(resp.data);
            setLoading(false);
        }).catch(err=>{
            console.log(err);
        });
    }, [search]);

// Search
    const __handleSearch = (event) => { 
        setLoading(true);    
        setSearch(event.target.value);
    };

//DELETE
    const __handleDelete = (event) => {  
        sweetConfirm("?", "Delete !", "Are you sure to delete selected customer?")
        .then(confirmed => {
            if(confirmed.isConfirmed){
                axios.get("http://127.0.0.1:8000/api/deleteUser",{ params: {table: "customers", idd: event.target.id } })
                .then(resp=>{
                    if(resp.data !== "error"){
                        setCustomer(resp.data);
                        CustomAlert("success", "Done", "Successfully customer deleted.");
                    } 
                    else{
                        CustomAlert("error", "Ops", "something went wrong.");
                    }              
                }).catch(err=>{
                    console.log(err);
                });
            }
        });
};

//STATUS
    const __handleStatus = (event) => {  
        sweetConfirm("!", "Change", "Are you sure to change customer status ?")
        .then(confirmed => {
            if(confirmed.isConfirmed){
                axios.get("http://127.0.0.1:8000/api/changeStatus",{ params: {table: "customers",idd: event.target.id } })
                .then(resp=>{
                    if(resp.data !== "error"){
                        setCustomer(resp.data);                            
                        CustomAlert( "success", "Done", "Successfully status changed.");
                    } 
                    else{
                        CustomAlert( "info", "Ops", "Something went wrong.");
                    }              
                    
                }).catch(err=>{
                    console.log(err);
                });
            }
        }); 
};
    
    return(
        <div className='dashboard-container'>
        <SideBar menu={sidebar_menu} />
        <div className='dashboard-content'>
            <DashboardHeader btnText="ADD"/>
            <div className='dashboard-content-container'>
                <div className='dashboard-content-header'>
                    <h2>Total Customer</h2>
                    <ReactHTMLTableToExcel
                    className="export"
                    table="table-to-xls"
                    filename="Admin"
                    sheet="tablexls"
                    buttonText="Export"/>
                    <div className='dashboard-content-search'>
                        
                        <input
                            type='text'
                            id='src'
                            value={search}
                            placeholder='email/id/name..'
                            className='dashboard-content-input'
                            onChange={e => __handleSearch(e)} />
                    </div>
                </div>

                {isLoading ?  ColorLoading()
                : 
                <table id='table-to-xls'>
                    <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>Action</th>
                    </thead>

                    {customer.length !== 0 ?
                        <tbody>
                            {customer.map((customer, index) => (
                                <tr key={index}>
                                    <td style={{textTransform: "capitalize"}}><Link to={`/getDetails/customers/${customer.id}`}>{customer.name}</Link></td>
                                    <td><span>{customer.email}</span></td> 
                                    <td><span>+880{customer.phone}</span></td>  
                                    <td><span>{customer.status}</span></td>  
                                    <td>  <button className='smallBtn' id={customer.id} onClick={e => __handleStatus(e)} >{
                                       customer.status === "active" ?
                                       <>Block</> 
                                        : <>Active</>
                                    }</button></td>                                 
                                    <td>  <button className='smallBtn' id={customer.id} onClick={e => __handleDelete(e)} >Delete</button></td>                                 
                                </tr>
                            ))}
                        </tbody>
                    : 
                    <tbody>    
                        <tr>              
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><span>NO DATA AVAILABLE</span></td>                                           
                        <td></td>
                        </tr>
                    </tbody>
                }
                  
                </table>
                }
                
            </div>
        </div>
        </div>
    )
}

export default CustomerList;
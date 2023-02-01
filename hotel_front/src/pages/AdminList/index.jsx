import React, {useState, useEffect} from 'react';
import ReactHTMLTableToExcel from 'react-html-table-to-excel';

import DashboardHeader from '../../components/DashboardHeader';
import SideBar from '../../components/Sidebar';
import sidebar_menu from '../../constants/sidebar-menu';
import {Link} from 'react-router-dom';
import axios from 'axios';

import '../styles.css';

import {CustomAlert, ColorLoading, sweetConfirm} from '../../components/Alert';

function AdminList () {
    document.title = "Admins List";
    const [search, setSearch] = useState('');
    const [admin, setAdmin] = useState([]);
    const [isLoading, setLoading] = useState(true);
    useEffect(() => {
        setLoading(true);
        axios.get("http://127.0.0.1:8000/api/viewList",{ params: {table: "admins" ,searchh: search } })
            .then(resp=>{               
                var lists = resp.data;                               
                setAdmin(lists);
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
    sweetConfirm("?", "Delete !", "Are you sure to delete ?")
    .then(confirmed => {
        if(confirmed.isConfirmed){
            axios.get("http://127.0.0.1:8000/api/deleteUser",{ params: {table: "admins", idd: event.target.id } })
            .then(resp=>{
                if(resp.data !== "error"){
                    setAdmin(resp.data);                              
                    CustomAlert("success", "Done", "Successfully admin deleted.");
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

//STATUS
const __handleStatus = (event) => {  
    sweetConfirm("!", "Change", "Are you sure to change status ?")
    .then(confirmed => {
        if(confirmed.isConfirmed){
            axios.get("http://127.0.0.1:8000/api/changeStatus",{ params: {table: "admins",idd: event.target.id } })
            .then(resp=>{
                if(resp.data !== "error"){
                    setAdmin(resp.data);                              
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
                    <h2>Total Admin</h2>
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

                {isLoading ?ColorLoading()
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

                    {admin.length !== 0 ?
                        <tbody>
                            {admin.map((admin, index) => (
                                <tr key={index}>
                                <td style={{textTransform: "capitalize"}}><Link to={`/getDetails/admins/${admin.id}`}>{admin.name}</Link></td>
                                <td><span>{admin.email}</span></td> 
                                <td><span>+880{admin.phone}</span></td>  
                                <td><span>{admin.status}</span></td>  
                                <td>  <button className='smallBtn' id={admin.id} onClick={e => __handleStatus(e)} >{
                                   admin.status === "active" ?
                                   <>Block</> 
                                    : <>Active</>
                                }</button></td>                                 
                                <td>  <button className='smallBtn' id={admin.id} onClick={e => __handleDelete(e)} >Delete</button></td>                                 
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

export default AdminList;
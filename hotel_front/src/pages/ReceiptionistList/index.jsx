import axios from 'axios';
import React, {useState, useEffect} from 'react';
import ReactHTMLTableToExcel from 'react-html-table-to-excel';
import DashboardHeader from '../../components/DashboardHeader';
import {Link} from 'react-router-dom';
import '../styles.css';

import SideBar from './../../components/Sidebar';
import sidebar_menu from './../../constants/sidebar-menu';


import {CustomAlert, sweetConfirm, ColorLoading} from '../../components/Alert';

function ReceiptionistList () {
    document.title = "Receiptionists list";
    const [search, setSearch] = useState('');
    const [receiptionist, setReceiptionist] = useState([]);
    const [isLoading, setLoading] = useState(true);
    useEffect(() => {
        setLoading(true);
        axios.get("http://127.0.0.1:8000/api/viewList",{ params: {table: "receiptionists", searchh: search } })
        .then(resp=>{               
            var lists = resp.data;                                
            setReceiptionist(lists);
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
        sweetConfirm("?", "Delete !", "Are you sure to delete this receiptionist ?")
        .then(confirmed => {
            if(confirmed.isConfirmed){
                axios.get("http://127.0.0.1:8000/api/deleteUser",{ params: {table: "receiptionists", idd: event.target.id } })
                .then(resp=>{
                    if(resp.data !== "error"){
                        setReceiptionist(resp.data);                              
                        CustomAlert("success", "Done", "Successfully receiptionist deleted.");
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
            axios.get("http://127.0.0.1:8000/api/changeStatus",{ params: {table: "receiptionists",idd: event.target.id } })
            .then(resp=>{
                if(resp.data !== "error"){
                    setReceiptionist(resp.data);                              
                    CustomAlert( "success", "Done", "Successfully changed status.");
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
                    <h2>Total Receiptionist</h2>
                    <ReactHTMLTableToExcel
                    className="export"
                    table="table-to-xls"
                    filename="Receiptionist"
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

                {isLoading ?  ColorLoading() : 
                <table  id="table-to-xls">
                    <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>Action</th>
                    </thead>

                    {receiptionist.length !== 0 ?
                        <tbody>
                            {receiptionist.map((receiptionist, index) => (
                                <tr key={index}>
                                    <td style={{textTransform: "capitalize"}}><Link to={`/getDetails/receiptionists/${receiptionist.id}`}>{receiptionist.name}</Link></td>
                                    <td><span>{receiptionist.email}</span></td> 
                                    <td><span>+880{receiptionist.phone}</span></td> 
                                    <td><span>{receiptionist.status}</span></td>
                                    <td>  <button className='smallBtn' id={receiptionist.id} onClick={e => __handleStatus(e)} >{
                                       receiptionist.status === "active" ?
                                       <>Block</> 
                                        : <>Active</>
                                    }</button></td>                                 
                                    <td>  <button className='smallBtn' id={receiptionist.id} onClick={e => __handleDelete(e)} >Delete</button></td>                                 
                                </tr>
                            ))}
                        </tbody>
                    : 
                    <tbody>               
                        <td></td>
                        <td></td>
                        <td><span>NO DATA AVAILABLE</span></td>                                           
                        <td></td>
                    </tbody>  
                }
                  
                </table>

            } 
            </div>
        </div>
        </div>
    )
}

export default ReceiptionistList;
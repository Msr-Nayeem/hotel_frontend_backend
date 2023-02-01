import React, {useState, useEffect} from 'react';
import {Link} from 'react-router-dom';
import ReactHTMLTableToExcel from 'react-html-table-to-excel';
import {calculateRange, sliceData} from '../../utils/table-pagination';
import axios from 'axios';

import DoneIcon from '../../assets/icons/done.svg';
import CancelIcon from '../../assets/icons/cancel.svg';
import DashboardHeader from '../../components/DashboardHeader';
import SideBar from '../../components/Sidebar';
import sidebar_menu from '../../constants/sidebar-menu';
import { sweetConfirm, CustomAlert, ColorLoading} from '../../components/Alert';
import '../styles.css';

function Rooms () {
    document.title = "View Rooms";
    const [search, setSearch] = useState('');
    const [orders, setOrders] = useState([]);
    const [page, setPage] = useState(1);
    const [pagination, setPagination] = useState([]);
    const [lists, setLists] = useState([]);
    const [isLoading, setLoading] = useState(true);
    
    useEffect(() => {
        if(search === ''){
            setLoading(true);
        }
        else{
            setLoading(false);
        }
        
    axios.get("http://127.0.0.1:8000/api/rooms",{ params: {searchh: search } })
        .then(resp=>{               
            var lists = resp.data; 
            setPagination(calculateRange(lists, 5));                              
            setOrders( sliceData(lists, page, 5));
            setLists(lists);
            setLoading(false);
        }).catch(err=>{
            console.log(err);
        });

    }, [search,page]);

   

    // Search
    const __handleSearch = (event) => {
         setSearch(event.target.value);
    };
    

    // Change Page 
    const __handleChangePage = (new_page) => {
        setLoading(true);
        setPage(new_page);
        setOrders(sliceData(lists, new_page, 5));
        setLoading(false);
    }

    const __handleDelete = (event) => {  
        sweetConfirm("?", "Delete !", "Are you sure to delete this room?")
        .then(confirmed => {
            if(confirmed.isConfirmed){
                axios.get("http://127.0.0.1:8000/api/deleteRoom",{ params: {id: event.target.id } })
                .then(resp=>{
                    if(resp.data !== "error"){
                        var lists = resp.data; 
                        setPagination(calculateRange(lists, 5));                              
                        setOrders( sliceData(lists, page, 5));
                        setLists(lists);                              
                        CustomAlert("success", "Done", "Successfully room deleted.");
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
const cancelBooking = (event) => {  
    sweetConfirm("?", "Cancel !", "Are you sure to cancel booking ?")
        .then(confirmed => {
            if(confirmed.isConfirmed){
                axios.get("http://127.0.0.1:8000/api/cancelBooking",{ params: { id: event.target.id } })
                .then(resp=>{
                    if(resp.data !== "error"){
                        setPagination(calculateRange(resp.data, 5));                              
                        setOrders( sliceData(resp.data, page, 5));
                        setLists(resp.data);                              
                        CustomAlert( "success", "Done", "Booking cancelled.");
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
                    <h2>Rooms</h2>
                    <ReactHTMLTableToExcel
                    className="export"
                    table="table-to-xls"
                    filename="rooms"
                    sheet="tablexls"
                    buttonText="Export"/>
                    <div className='dashboard-content-search'>
                        
                        <input
                            type='text'
                            id='src'
                            value={search}
                            placeholder='Search...'
                            className='dashboard-content-input'
                            onChange={e => __handleSearch(e)} />
                    </div>
                </div>

                {isLoading ?  ColorLoading() :
                <>
                <table id='table-to-xls'>
                    <thead>
                        <th>ID</th>
                        <th>Cetegory</th>
                        <th>STATUS</th>
                        <th>Rent</th>
                        <th>Booked For(id)</th>
                        <th>Action</th>
                        <th>Delete Room</th>
                    </thead>

                    {orders.length !== null ?
                        <tbody>
                            {orders.map((order, index) => (
                                <tr key={index}>
                                    <td><span>{order.id}</span></td>
                                    <td><span>{order.cetegory}</span></td>
                                    <td>
                                        <div>
                                            {order.status === 'available' ?
                                                <img
                                                    src={DoneIcon}
                                                    alt='paid-icon'
                                                    className='dashboard-content-icon' />
                                            : order.status === 'booked' ?
                                                <img
                                                    src={CancelIcon}
                                                    alt='canceled-icon'
                                                    className='dashboard-content-icon' />
                                            :null}
                                            <span>{order.status}</span>

                                        </div>
                                    </td>
                                    <td><span>{order.rent_per_day}</span></td>
                                    
                                    {
                                        order.booked_for === null ?
                                        <td><span>...</span></td>
                                        :
                                        <td><span><Link to={`/getDetails/customers/${order.booked_for}`}>{order.booked_for}</Link></span></td>
                                    }
                                    {
                                        order.booked_for === null ?
                                        <td><span>...</span></td>
                                        :
                                        <td><button className='smallBtn' id={order.id} onClick={e => cancelBooking(e)} >Cancel</button></td>
                                    }
                                    
                                    <td><button className='smallBtn' id={order.id} onClick={e => __handleDelete(e)} >Delete</button></td>
                                </tr>
                            ))}
                        </tbody>
                    : null}
                    <tfoot>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><center>Total ={lists.length}</center></td>
                        
                        <td></td>
                        <td></td>
                        <td></td>
                    </tfoot>
                </table></>}

                {orders.length !== 0 ?
                    <div className='dashboard-content-footer'>
                        {pagination.map((item, index) => (
                            <span 
                                key={index} 
                                className={item === page ? 'active-pagination' : 'pagination'}
                                onClick={() => __handleChangePage(item)}>
                                    {item}
                            </span>
                        ))}
                  
                        
                    </div>
                : 
                    <div className='dashboard-content-footer'>
                        <span className='empty-table'>No data</span>
                    </div>
                }
            </div>
        </div>
        </div>
    )
}

export default Rooms;
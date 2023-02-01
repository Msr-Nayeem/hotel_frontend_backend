import React, {useState, useEffect} from 'react';
import {useParams} from 'react-router-dom';
import { Link } from 'react-router-dom';
import DashboardHeader from '../../components/DashboardHeader';

import {ColorLoading}  from '../../components/Alert';
import '../styles.css';

import SideBar from '../../components/Sidebar';
import sidebar_menu from '../../constants/sidebar-menu';
import axios from 'axios';

function Details () {

    const [details, setDetails] = useState('');
    let { table_name } = useParams();
    let { idd } = useParams();
    const [isLoading, setLoading] = useState(true);

    document.title = "Details-"+details.name;

    useEffect(() => {
        setLoading(true);
        axios.get("http://127.0.0.1:8000/api/getDetails",{ params: {table : table_name, user_id:idd } })
        .then(resp=>{               
            setDetails(resp.data);
            setLoading(false);
        }).catch(err=>{
            console.log(err);
        });

    }, [idd, table_name]); 

  
    return(
        <div className='dashboard-container'>
        <SideBar menu={sidebar_menu} />
        <div className='dashboard-content'>
            <DashboardHeader />
                
{isLoading ? ColorLoading() :
                    <>
                <div className="container bg-white">
                <div className="row">
                    <div className="col-md-4 border-right">
                                        <div className="d-flex flex-column align-items-center text-center p-3 py-5">
                                        <img className="rounded-circle mt-5" width="150px"
                                             src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg" alt="profile pic" />
                                        <span style={{ textTransform: "capitalize" }} className="font-weight-bold"> {details.name}</span>
                                        <b className="text-black-50" style={{ textTransform: "capitalize" }}>[{table_name.substring(0,table_name.length-1)}]</b>
                                    </div>
                    </div>
                    <div className="col-md-5 border-right">
                        <div className="p-3 py-5">
                            <div className="d-flex justify-content-between align-items-center mb-3">
                                <h4 className="text-right">Profile</h4>
                            </div>
                            <div className="row mt-2">
                                <div className="col-md-12">
                                    <label className="labels">Name</label>
                                                <input type="text" className="form-control" style={{ textTransform: "capitalize" }} value={details.name} disabled={true} />
                                </div>
                                
                            </div>
                            <div className="row mt-3">
                                <div className="col-md-12">
                                    <label className="labels">Mobile Number</label>
                                                <input type="text" className="form-control" value={details.phone} disabled={true} />
                                            </div>
                                          
                                <div className="col-md-12">
                                    <label className="labels">Email</label>
                                                <input type="text" className="form-control" value={details.email} disabled={true} />
                                </div>
                                <div className="col-md-6">
                                    <label className="labels">Date of Birth</label>
                                                <input type="text" className="form-control" value={details.dob} disabled={true} />
                                </div>
                                
                            </div>
                            <div className="row mt-3">
                                <div className="col-md-6">
                                    <label className="labels">City</label>
                                                <input type="text" className="form-control" value={details.division} disabled={true} />
                                </div>
                                <div className="col-md-6">
                                    <label className="labels">District</label>
                                                <input type="text" className="form-control" value={details.district} disabled={true} />
                                </div>
                                <div className="col-md-6">
                                    <label className="labels">Upazila</label>
                                                <input type="text" className="form-control" value={details.upazila} disabled={true} />
                                            </div>
                                            
                            </div>
                            <div className="col-md-3">
                                <Link to={`/update/${ table_name }/${idd}`} className="btn btn-primary">Update</Link>
                            </div>
                        </div>
                    </div>
                    
                    </div>
                </div>
                           
                       
        </>
    }
                 
            </div>
        </div>
       
    )
}

export default Details;
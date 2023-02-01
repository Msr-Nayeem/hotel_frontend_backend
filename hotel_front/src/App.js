import React from 'react';
import { BrowserRouter as Router, Routes, Route} from 'react-router-dom';
import PrivateRoute from './components/Hook/PrivateRoute';

import './App.css';
import Reset from './pages/Reset';
import Otp from './pages/Otp';
import NewPassword from './pages/NewPassword';

import Registration from './pages/Registration';
import Login from './pages/Login';

import Home from './pages/Home';
import Profile from './pages/Profile';
import ReceiptionistList from './pages/ReceiptionistList';
import AdminList from './pages/AdminList';
import CustomerList from './pages/CustomerList';
import Rooms from './pages/Rooms';
import Details from './pages/Details';
import DetailsEdit from './pages/DetailsEdit';
import AddRoom from './pages/AddRoom';


import Error from './pages/Error';

function App () {
 
  return(
    
    <Router>  

              <Routes>        
                <Route exact path="/reset" element={< Reset/>} />
                <Route exact path="/otp" element={< Otp/>} />
                <Route exact path="/newPassword" element={< NewPassword/>} />

                <Route exact path="/Registration" element={< Registration/>} />
                
                <Route path="/" element={< Login/>} />
                <Route exact path="/Home" element={< Home/>} />
                <Route exact path="/profile" element=
                  {
                    <PrivateRoute> 
                      < Profile/> 
                    </PrivateRoute>
                  } 
                />
                <Route exact path="/AdminList" element={< AdminList/>} />
                <Route exact path="/ReceiptionistList" element={< ReceiptionistList/>} />
                <Route exact path="/CustomerList" element={< CustomerList/>} />
                <Route exact path="/Rooms" element={< Rooms/>} />
                <Route exact path="/addRoom" element={< AddRoom/>} />
                <Route exact path="/getDetails/:table_name/:idd" element={< Details/>} />
                <Route exact path="/update/:table_name/:idd" element={< DetailsEdit/>} />

                <Route path="/*" element={< Error/>}/>   
                {/*import Navigate <Route path="/*" element={< Navigate to="/" />} /> */}   
              </Routes>         
    </Router>
  )
}

export default App;
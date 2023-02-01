import { useEffect,useState } from 'react';
import axiosConfig from './axiosConfig';
import { Link } from 'react-router-dom';

const App = () => {
  const TableRow = ({ name, id }) => {
    return (
    
      <tbody>
        <tr>
          <th>{name}</th>
          <th>{id}</th>
          
        </tr>
      </tbody>
   );
  };
  const [studentList, setStudentList] = useState([]);
  
  useEffect(()=>{
    axiosConfig.get("students/list")
    .then(resp=>{
      if(resp.data === null){
        console.log("failed");
      }
      else{
        setStudentList(resp.data);
      }
        
    }).catch(err=>{
        console.log(err);
    });
},[]);

  return (
    <div className="pdf">
     
      <div className="main-panel ps">
        
        <div className="content">
          <div className="row"></div>
          <div className="row" >
            <div className="col-md-12">
              <div className="card ">
                <div className="card-header">
                <Link to="/logout">Logout</Link>
                  <h1 className="card-title" align="center">
                    {" "}
                    Student List
                  </h1>
                </div>
                <div className="card-body">
                  <div className="table-responsive-lg">
                    <table className="table tablesorter " id="">
                      <thead className=" text-primary">
                        <tr>
                          <th>name</th>
                          <th>id</th>
                        </tr>
                      </thead>

                      {studentList.map((u) => {
                        return <TableRow key={u.id} {...u} />;
                      })}
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    
    </div>
  );
};
export default App;
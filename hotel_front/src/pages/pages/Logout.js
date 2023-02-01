import axios from "axios";
import { useNavigate } from "react-router-dom";

const Logout = ()=>{
    const navigate = useNavigate();
   
    let user = localStorage.getItem('user');
    var obj = { token_no:user };
        axios.post("http://127.0.0.1:8000/api/apiLogout",obj)
        .then(resp=>{
            var result = resp.data;
            if(result === "logout success"){
                localStorage.removeItem("user");
                console.log(result);
                navigate("/");
                
            }
                       
        }).catch(err=>{
            console.log(err);
        });


}
export default Logout;  
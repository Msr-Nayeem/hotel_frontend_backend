import UseAuth from "./useAuth";
import { Navigate } from "react-router-dom";
export default function PrivateRoute({ children }){
    const auth = UseAuth();

    return auth ? children : <Navigate to="/" />;
}
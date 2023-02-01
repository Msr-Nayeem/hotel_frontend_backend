import swal from '@sweetalert/with-react';
import Swal from 'sweetalert2';
import { ColorRing } from "react-loader-spinner";
function Loading(){
        swal({
          content: <div>
            <h1>Please Wait</h1>
              <ColorRing
                  visible={true}
                  height="150"
                  width="478"
                  ariaLabel="blocks-loading"
                  wrapperStyle={{}}
                  wrapperClass="blocks-wrapper"
                  colors={['#e15b64', '#f47e60', '#f8b26a', '#abbd81', '#849b87']}
              />
            </div>,
          buttons: false, 
          allowOutsideClick: false,      
        })
}

function LoadingClose(){
    swal.close();
}

function CustomAlert(iconName, titleText, bodyText){
    Swal.fire({
        title: titleText,
        text: bodyText,
        icon: iconName,
      });
}



function ColorLoading(){
return(
  <section className='loader'>
    <ColorRing
    margin-left="500"
    visible={true}
    height="300"
    width="300"
    ariaLabel="blocks-loading"
    wrapperStyle={{}}
    wrapperClass="blocks-wrapper"
    colors={['#e15b64', '#f47e60', '#f8b26a', '#abbd81', '#849b87']}
  />
    </section>
) ;  

}

function sweetConfirm(icon,titleText, bodyText) {
  return Swal.fire({ // Added return
  iconHtml: icon,
  title:titleText,
  text: bodyText,
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Sure',
  
  });
}

export {Loading, LoadingClose, CustomAlert, sweetConfirm, ColorLoading}
import "./Home.css";

function Home() {
 

  const renderForm = (
    <div class="container">
            <div class="header">
            <h3>Welcome</h3>
            </div>
                     
    </div>
  );

  return (
    <div className="Home">
      <div className="login-form">
        {renderForm}      
      </div>
    </div>
  );
}


export default Home;
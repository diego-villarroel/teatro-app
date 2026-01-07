import './App.css'
import { Footer } from './components/Footer/Footer';
// import { Login } from './components/Login/Login';
// import { Dashboard } from './components/Dashboard/Dashboard';
import { TeatroDash } from './components/TeatroDash/TeatroDash';

function App() {
  const teatro = {
    nombre:'San Martin', 
    mics: [{
      marca:'Shure',
      modelo:'SM 58',
      cantidad: 10,
      estado: 4
    },{
      marca:'Shure',
      modelo:'SM 57',
      cantidad: 10,
      estado: 4
    }], 
    consolas: [{
      marca:'Yamaha',
      modelo:'CL 5',
      cantidad: 2,
      estado: 3
    },{
      marca:'Yamaha',
      modelo:'PM 3',
      cantidad: 1,
      estado: 4
    }], 
    cajas: [{
      marca:'JBL',
      modelo:'100',
      cantidad: 4,
      estado: 3
    },{
      marca:'JBL',
      modelo:'200',
      cantidad: 6,  
      estado: 2
    }], 
  };
  return (
    <div className="container">
      <header>
        <h2>SanMaApp Sonidero</h2>
      </header>
      <div className="actividad">
        {/* <Dashboard></Dashboard> */}
        <TeatroDash teatroData={teatro} ></TeatroDash>
      </div>
      {/* <Login></Login> */}
      <Footer></Footer>
    </div>
  )
}

export default App

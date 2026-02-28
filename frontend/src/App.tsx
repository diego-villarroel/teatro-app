import './App.css';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import { useAuthContext } from './context/AuthContext/useAuthContext';
import { Footer } from './components/Footer/Footer';
import { Login } from './components/Login/Login';
import { Dashboard } from './components/Dashboard/Dashboard';
import { TeatroDash } from './components/TeatroDash/TeatroDash';
import { RutasProtegidas } from './components/RutasProtegidas/RutasProtegidas';

function App() {
  const { user, logout } = useAuthContext();
  
  return (
    <div className="container">
      <header>
        <h2>SanMaApp Sonidero</h2>
        {user && <button className='btn-menu' onClick={logout}>Salir</button>}        
      </header>
      <div className="actividad">
        <BrowserRouter>
          <Routes>
            <Route path='/login' element={<Login></Login>}></Route>
            <Route path='/' element={<RutasProtegidas><Dashboard /></RutasProtegidas>}></Route>
            <Route path='/admin-teatro/teatro/:teatroId' element={<RutasProtegidas><TeatroDash /></RutasProtegidas>}></Route>
          </Routes>
        </BrowserRouter>
      </div>
      <Footer></Footer>
    </div>
  )
}

export default App

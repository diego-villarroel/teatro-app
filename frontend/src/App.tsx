import './App.css';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import { Footer } from './components/Footer/Footer';
// import { Login } from './components/Login/Login';
import { Dashboard } from './components/Dashboard/Dashboard';
import { TeatroDash } from './components/TeatroDash/TeatroDash';
import { AdminAudioElements } from './components/AdminAudioElements/AdminAudioElements';
import { FormAudioElem } from './components/FormAudioElem/FormAudioElem';

function App() {
  return (
    <div className="container">
      <header>
        <h2>SanMaApp Sonidero</h2>
      </header>
      <div className="actividad">
        {/* <Login></Login> */}
        <BrowserRouter>
          <Routes>
            <Route path='/' element={<Dashboard></Dashboard>}>
            </Route>
            <Route path='/admin-teatro/teatro/:teatroId' element={<TeatroDash></TeatroDash>}>
            </Route>
            <Route path='/admin-teatro/add-elementos/:teatroId' element={<FormAudioElem accion="add"></FormAudioElem>}></Route>
          </Routes>
        </BrowserRouter>
      </div>
      <Footer></Footer>
    </div>
  )
}

export default App

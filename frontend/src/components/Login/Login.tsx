import { Navigate } from 'react-router-dom';
import { useAuthContext } from '../../context/AuthContext/useAuthContext';
import './Login.css';
import { useState } from 'react';

export const Login = () => {
  const [loginForm, setLoginForm] = useState({usuario: '', pass: ''});
  const {user, login} = useAuthContext();

  const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const { name, value } = e.target;
    setLoginForm({...loginForm, [name]: value})
  }

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    const success = login(loginForm.usuario, loginForm.pass);
    if(success) {
      window.location.href = '/';
    } else {
      console.log('Login fallido');
    }
    
  }
  return (
    <div className="login">
      <form action="" method="post" onSubmit={handleSubmit}>
        <div className="campo">
          <label htmlFor="usuario">Nombre:</label>
          <input name="usuario" type="text" id="usuario" className="usuario" placeholder="Diego" onChange={handleChange}/>
        </div>
        <div className="campo">
          <label htmlFor="pass">Clave:</label>
          <input name="pass" type="password" id="pass" className="pass" placeholder='clave123' onChange={handleChange}/>
        </div>
        <button type="submit">Login</button>
      </form>
      {/* <div>
        <h4>test</h4>
        <button>Perfil Operador</button>
        <button>Perfil Encargado</button>
        <button>Perfil Gerente</button>
      </div> */}
    </div>
  );
}
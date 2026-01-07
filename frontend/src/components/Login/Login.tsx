export const Login = () => {
  return (
    <div className="login">
      <form action="" method="post">
        <div className="campo">
          <label htmlFor="usuario">Nombre:</label>
          <input type="text" id="usuario" className="usuario" placeholder="Diego" />
        </div>
        <div className="campo">
          <label htmlFor="pass">Clave:</label>
          <input type="password" id="pass" className="pass" />
        </div>
        <button type="button">Login</button>
      </form>
    </div>
  );
}
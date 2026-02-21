
export const FormPersonal = ({teatroId, accion}: {teatroId?: number, accion: string}) => {
  return (
    <>
      <h3>Formulario Personal</h3>
      <form action="" className="form-personal">
        <div>
          <label htmlFor="teatro" >Teatro</label>
          <select name="teatro" id="teatro" defaultValue={teatroId ? teatroId : "0"}>
            <option value="0">Seleccione un teatro</option>
            <option value="1">San Martin</option>
            <option value="2">Alvear</option>
            <option value="3">Sarmiento</option>
            <option value="4">La Rivera</option>
            <option value="5">Regio</option>
          </select>
        </div>

        <div>
          <label htmlFor="nombre">Nombre</label>
          <input type="text" placeholder="Juan Perez" id="nombre" name="nombre"/>
        </div>
        <div>
          <label htmlFor="rol">Rol</label>
          <select name="rol" id="rol">
            <option value="">Seleccione un rol</option>
            <option value="0">Sonidista</option>
            <option value="1">Iluminador</option>
            <option value="2">Técnico de escenario</option>
            <option value="3">Director</option>
          </select>
        </div>
        <button>Agregar</button>
      </form>
    </>
  )
}
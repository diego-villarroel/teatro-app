import './FormAudioElem.css';

export const FormAudioElem = () => {
  return (

    <form action="" className="form-audio-elem">
    <div>
      <label htmlFor="teatro" >Teatro</label>
      <select name="teatro" id="teatro">
        <option value="">Seleccione un teatro</option>
        <option value="0">San Martin</option>
        <option value="1">Alvear</option>
        <option value="2">Sarmiento</option>
        <option value="3">La Rivera</option>
        <option value="4">Regio</option>
      </select>
    </div>

    <div>
      <label htmlFor="tipo_elemento">Tipo Elemento</label>
      <select name="tipo_elemento" id="tipo_elemento">
        <option value="">Seleccione un elemento</option>
        <option value="0">Mic</option>
        <option value="1">Consola</option>
        <option value="2">Potencia</option>
        <option value="3">Caja</option>
      </select>
    </div>
    <div>
      <label htmlFor="marca">Marca</label>
      <input type="text" placeholder="Shure" id="marca" name="marca"/>
    </div>
    <div>
      <label htmlFor="modelo">Modelo</label>
      <input type="text" placeholder="SM 57" id="modelo" name="modelo"/>
    </div>
    <div>
      <label htmlFor="cantidad">Cantidad</label>
      <input type="number" id="cantidad" name="cantidad"/>
    </div>
  </form>
  )
}
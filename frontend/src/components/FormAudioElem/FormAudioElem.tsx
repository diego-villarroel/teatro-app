import { Link } from 'react-router-dom';
import './FormAudioElem.css';
import { useState } from 'react';

interface FormAudioElemProps {
  accion: string;
  teatroId?: number;
  tipoElemento?: number;
  marca?: string;
  modelo?: string;
  cantidad?: number;
}

export const FormAudioElem = ({accion, teatroId, tipoElemento, marca, modelo, cantidad}: FormAudioElemProps) => {

  return (
    <>
      <form action="" className="form-audio-elem">
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
          <label htmlFor="tipo_elemento">Tipo Elemento</label>
          <select name="tipo_elemento" id="tipo_elemento" defaultValue={tipoElemento ? tipoElemento : ''}>
            <option value="">Seleccione un elemento</option>
            <option value="0">Mic</option>
            <option value="1">Consola</option>
            <option value="2">Potencia</option>
            <option value="3">Caja</option>
          </select>
        </div>
        <div>
          <label htmlFor="marca">Marca</label>
          <input type="text" placeholder="Shure" id="marca" name="marca" defaultValue={marca ? marca : ''}/>
        </div>
        <div>
          <label htmlFor="modelo">Modelo</label>
          <input type="text" placeholder="SM 57" id="modelo" name="modelo" defaultValue={modelo ? modelo : ''}/>
        </div>
        <div>
          <label htmlFor="cantidad">Cantidad</label>
          <input type="number" id="cantidad" name="cantidad" max={cantidad}/>
        </div>
        { accion === "add" && (
          <>          
            <div>
              <label htmlFor="codigo">Código</label>
              <input type="text" placeholder="1234" id="codigo" name="codigo"/>
            </div>
            <button>Agregar</button>
          </>
        )}
        { accion === "mod" && (
          <button>Modificar</button>
        )}
      </form>
    </>
      
  )
}
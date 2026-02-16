import { useEffect, useState } from "react";
import { Modal } from "../Modal/Modal";
import { getCategoryElem, getElementosAV } from "../../services/elementos_av";

interface ElementoAV {
  id: number;
  teatro_id: number;
  categoria_id: number;
  marca: string;
  modelo: string;
  cantidad: number,
  estado: number;
  fecha_compra: string;
  fecha_mod: string;
}

interface TablaAudioElementsProps {
  id: number;
  sala: number;
}

export const TablaAudioElements = ({id, sala} : TablaAudioElementsProps) => {
  const [audioElem, setAudioElem] = useState<ElementoAV[]>([]);
  const [categorias, setCategorias] = useState();

//   console.log(sala);
  

  useEffect(() => {
    getCategoryElem().then((cat) => {
      setCategorias(cat);
    })
  }, []);
  useEffect(() => {
    getElementosAV(id, sala).then((elem) => {
      setAudioElem(elem);      
    });
  }, [sala]);
  
  return (
    <>
    <table className="teatro-table">
      <thead>
        <tr>
          <th>Marca</th>
          <th>Modelo</th>
          <th>Cantidad</th>
          <th>Estado</th>
          <th>Accion</th>
        </tr>
      </thead>
      <tbody>
        {audioElem.map((mic, index) => (
          <tr key={index}>
            <td>{mic.marca}</td>
            <td>{mic.modelo}</td>
            <td>{mic.cantidad}</td>
            <td><div className={`estado-${mic.estado}`}>&nbsp;</div></td>
            <td><button>Modificar</button></td>
          </tr>
        ))}
      </tbody>
    </table>
    </>
  )
}
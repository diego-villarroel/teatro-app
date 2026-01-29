import { useEffect, useState } from "react";
import { Modal } from "../Modal/Modal";
import { getCategoryElem, getElementosAV } from "../../services/elementos_av";

interface ElementoAV {
  id: number;
  teatro_id: number;
  categoria_id: number;
  marca: string;
  modelo: string;
  estado: number;
  fecha_compra: string;
  fecha_mod: string;
}

interface AudioElem {
  marca: String,
  modelo: String,
  cantidad: Number,
  estado: Number
}

export const TablaAudioElements = ({id} : {id : number}) => {
  const [audioElem, setAudioElem] = useState<ElementoAV[]>([]);
  const [categorias, setCategorias] = useState();

  // console.log(id);
  

  useEffect(() => {
    getElementosAV(id).then((elem) => {
      setAudioElem(elem);
      // console.log(audioElem);
      
    });
    getCategoryElem().then((cat) => {
      setCategorias(cat);
    })
  }, []);

  const [selectedItem, setSelectedItem] = useState<AudioElem | null>(null);
  const [isModalOpen, setIsModalOpen] = useState(false);

  const handleCloseModal = () => {
    setIsModalOpen(false);
    setSelectedItem(null);
  };
  
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
            <td></td>
            <td><div className={`estado-${mic.estado}`}>&nbsp;</div></td>
            <td></td>
          </tr>
        ))}
      </tbody>
    </table>
    </>
  )
}
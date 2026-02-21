import { useEffect, useState } from "react";
import type { ReactNode } from 'react';
import { Modal } from "../Modal/Modal";
import { FormAudioElem } from "../FormAudioElem/FormAudioElem";
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

interface AudioElem {
  marca: String,
  modelo: String,
  cantidad: Number,
  estado: Number
} 

export const TablaAudioElements = ({id, sala} : TablaAudioElementsProps) => {
  const [audioElem, setAudioElem] = useState<ElementoAV[]>([]);
  const [categorias, setCategorias] = useState();
  const [selectedItem, setSelectedItem] = useState<AudioElem | null>(null);

  const [isModalOpen, setIsModalOpen] = useState(false);
  const [modalContent, setModalContent] = useState<ReactNode | null>(null);
  const [modalTitle, setModalTitle] = useState('');

  const handleCloseModal = () => {
    setIsModalOpen(false);
    setSelectedItem(null);
  };

  const handleOpenModal = (children: any, title: string) => {
    // setSelectedItem(item);
    setModalContent(children);
    setIsModalOpen(true);
    setModalTitle(title);
  }

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
              <td><button onClick={() => handleOpenModal(<FormAudioElem teatroId={id} accion='mod' marca={mic.marca} modelo={mic.modelo} tipoElemento={index} cantidad={mic.cantidad ?? 0}/>, 'Modificar Elemento')}>Modificar</button></td>
            </tr>
          ))}
        </tbody>
      </table>

      <Modal isOpen={isModalOpen} onClose={handleCloseModal} title={modalTitle}>
        {modalContent}
      </Modal>
    </>
  )
}
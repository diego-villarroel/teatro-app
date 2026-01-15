import './TeatroDash.css';
import { useState } from 'react';
import { Link } from 'react-router-dom';
import { Modal } from '../Modal/Modal';

interface AudioElem {
  marca: String,
  modelo: String,
  cantidad: Number,
  estado: Number
}

interface Data {
  nombre: String,
  mics: Array<AudioElem>,
  consolas: Array<AudioElem>,
  cajas: Array<AudioElem>,
}

interface Props {
  teatroData : Data;
}

export const TeatroDash = ({teatroData} : Props) => {
  const [selectedItem, setSelectedItem] = useState<AudioElem | null>(null);
  const [isModalOpen, setIsModalOpen] = useState(false);

  const handleOpenModal = (item: AudioElem) => {
    setSelectedItem(item);
    setIsModalOpen(true);
  };

  const handleCloseModal = () => {
    setIsModalOpen(false);
    setSelectedItem(null);
  };

  const getEstadoTexto = (estado: Number): string => {
    const estados: { [key: number]: string } = {
      1: 'Muy Malo',
      2: 'Malo',
      3: 'Regular',
      4: 'Bueno',
      5: 'Excelente'
    };
    return estados[Number(estado)] || 'Desconocido';
  };

  return (
    <div className="teatro-dash">
      <h3>{teatroData.nombre}</h3>
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
          {teatroData.mics.map((mic, index) => (
            <tr key={index}>
              <td>{mic.marca}</td>
              <td>{mic.modelo}</td>
              <td>{String(mic.cantidad)}</td>
              <td><div className={`estado-${mic.estado}`}>&nbsp;</div></td>
              <td>
                <button onClick={() => handleOpenModal(mic)}>Detalle</button>
                <button onClick={() => handleOpenModal(mic)}>Modificar</button>
                <button onClick={() => handleOpenModal(mic)}>Eliminar</button>
              </td>
            </tr>
          ))}
          {teatroData.consolas.map((consola, index) => (
            <tr key={index}>
              <td>{consola.marca}</td>
              <td>{consola.modelo}</td>
              <td>{String(consola.cantidad)}</td>
              <td><div className={`estado-${consola.estado}`}>&nbsp;</div></td>
              <td>
                <button onClick={() => handleOpenModal(consola)}>Detalle</button>
                <button onClick={() => handleOpenModal(consola)}>Modificar</button>
                <button onClick={() => handleOpenModal(consola)}>Eliminar</button>
              </td>
            </tr>
          ))}
          {teatroData.cajas.map((caja, index) => (
            <tr key={index}>
              <td>{caja.marca}</td>
              <td>{caja.modelo}</td>
              <td>{String(caja.cantidad)}</td>
              <td><div className={`estado-${caja.estado}`}>&nbsp;</div></td>
              <td>
                <button onClick={() => handleOpenModal(caja)}>Detalle</button>
                <button onClick={() => handleOpenModal(caja)}>Modificar</button>
                <button onClick={() => handleOpenModal(caja)}>Eliminar</button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
      <div className="button-row">
        <Link to='/audio-elem?action=add'><button>Agregar Nuevo <br /> Elemento de Audio</button></Link>
        <Link to='/'><button>Volver</button></Link>
      </div>
      <Modal 
        isOpen={isModalOpen} 
        onClose={handleCloseModal}
        title={selectedItem ? `Detalle: ${selectedItem.marca} ${selectedItem.modelo}` : 'Detalle'}
      >
        {selectedItem && (
          <div>
            <p><strong>Marca:</strong> {selectedItem.marca}</p>
            <p><strong>Modelo:</strong> {selectedItem.modelo}</p>
            <p><strong>Cantidad:</strong> {String(selectedItem.cantidad)}</p>
            <p><strong>Estado:</strong> {getEstadoTexto(selectedItem.estado)}</p>
          </div>
        )}
      </Modal>
    </div>
  )
}
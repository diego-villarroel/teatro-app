import './TeatroDash.css';
import { useEffect, useState } from 'react';
import { Link, useParams } from 'react-router-dom';
import { getSalas, getTeatro } from '../../services/teatros';
import { TablaAudioElements } from '../TablaAudioElements/TablaAudioElements';
import { TablaPersonal } from '../TablaPesronal/TablaPersonal';
import { Codi } from '../Codi/Codi';

interface Teatro {
  id: number;
  nombre: string
}

interface Sala {
  id: number;
  nombre: string
}

export const TeatroDash = () => {
  const [activeTab, setActiveTab] = useState<'elementos' | 'personal' | 'CODI'>('elementos');
  const [filtroSala, setFiltroSala] = useState(0);
  
  const teatro_id = useParams();
  const [teatro, setTeatro ] = useState<Teatro | null>(null);
  const [salas, setSalas] = useState([]);

  useEffect(() => {  
    if (!teatro_id.teatroId) {
      console.error('teatroId no encontrado en la URL');
      return;
    }
    
    const teatroIdNum = parseInt(teatro_id.teatroId);
    if (isNaN(teatroIdNum)) {
      console.error('teatroId no es un número válido');
      return;
    }
    
    getTeatro(teatroIdNum).then((teatro) => {
      setTeatro(teatro);
    });
    getSalas(teatroIdNum, 0).then((new_salas) => {
      setSalas(new_salas);
    })
  }, [filtroSala]);

  const handleFiltro = (salaId: number) => {
    setFiltroSala(salaId);
  }

   // Validar que teatro no sea null antes de renderizar
   if (!teatro) {
    return (
      <div className="teatro-dash">
        <p>Cargando...</p>
      </div>
    );
  }  
  
  return (
    <div className="teatro-dash">
      <h3>{teatro.nombre}</h3>
      <div className="tabs-container">
        <div className="tabs-header">
          <button 
            className={`tab-button ${activeTab === 'elementos' ? 'active' : ''}`}
            onClick={() => setActiveTab('elementos')}
          >
            Elementos
          </button>
          <button 
            className={`tab-button ${activeTab === 'personal' ? 'active' : ''}`}
            onClick={() => setActiveTab('personal')}
          >
            Personal
          </button>
          <button 
            className={`tab-button ${activeTab === 'CODI' ? 'active' : ''}`}
            onClick={() => setActiveTab('CODI')}
          >
            CODI
          </button>
        </div>

        <div className="tabs-content">
          {activeTab === 'elementos' && (
            <div className="tab-panel table-container">
              <TablaAudioElements id={teatro.id} sala={filtroSala}/>
            </div>
          )}
          
          {activeTab === 'personal' && (
            <div className="tab-panel table-container">
              <TablaPersonal id={teatro.id} />
            </div>
          )}
          
          {activeTab === 'CODI' && (
            <div className="tab-panel table-container">
              <Codi id_teatro={teatro.id} sala={filtroSala} />
            </div>
          )}
          <div className="button-col">
            <button onClick={() => handleFiltro(0)}>Todo</button>
            {salas.map((sala: Sala) => (
                <button className='filtro_sala' style={{'margin':'.7rem 0 0 0'}} onClick={() => handleFiltro(sala.id)}>{sala.nombre}</button>
            ))}
          </div>
        </div>
      </div>
      <div className="button-row">
        <button>Add Elemento</button>
        <button>Add Personal</button>
        <button>Cargar Codi</button>
        <Link to='/'><button>Volver</button></Link>
      </div>
    </div>
  )
}
import { useEffect, useState } from "react";
import { getCargos, getEstadoPersonal, getHorarios, getPersonal } from "../../services/personal";

interface Hora {
  id: number,
  nombre: String,
  horario: String
}

interface Cargo {
  id: number,
  nombre: String
}

interface Estado {
  id: Number,
  nombre: String
}

export const TablaPersonal = ({id} : {id: number}) => {
  const [horarios, setHorarios] = useState([]);
  const [cargos, setCargos] = useState([]);
  const [estadoPersonal, setEstadoPersonal] = useState([]); 

  useEffect(() => {
    getHorarios().then((new_horarios) => {
      setHorarios(new_horarios);
    });
    getCargos().then((new_cargos) => {
      setCargos(new_cargos);
    });
    getEstadoPersonal().then((new_estados) => {
      setEstadoPersonal(new_estados);
    })
  },[]);
  
  const [personal, setPersonal] = useState([]);

  useEffect(() => {
    getPersonal(id).then((personal) => {
      setPersonal(personal);
    });
  }, [id]);
  
  return (
    <div>
      <table className="teatro-table">
        <thead>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Horario</th>
          <th>Cargo</th>
          <th>Estado</th>
          <th>Acciones</th>
        </thead>
        <tbody>
          {personal.map((persona: any) => (
            <tr>
              <td>{persona.nombre}</td>
              <td>{persona.apellido}</td>
              <td>{horarios.map((hora: Hora) => hora.id == persona.horario ? hora.nombre+' ('+hora.horario+')' : '')}</td>
              <td>{cargos.map((cargo: Cargo) => cargo.id == persona.cargo ? cargo.nombre : '')}</td>
              <td>{estadoPersonal.map((estado : Estado) => estado.id == persona.estado ? estado.nombre : '')}</td>
              <td><button>Modificar</button></td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  )
}
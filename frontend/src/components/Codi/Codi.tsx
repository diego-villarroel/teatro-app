import { useEffect, useState } from "react";
import { getSalas } from "../../services/teatros";

interface CodiProps {
  id_teatro: number,
  sala: number
}

export const Codi = ({id_teatro, sala }: CodiProps) => {
  const [salas, setSalas] = useState([]);

  useEffect(() => {
    getSalas(id_teatro, sala).then((new_salas) => {
      setSalas(new_salas);
    })
  }, [sala])
  return (
    <>
      <table className="teatro-table">
        <thead>
          <tr>
            <th></th>
            {salas.map((sala: any) => (
              <th>{sala.nombre}</th>
            ))}
          </tr>
        </thead>
        <tbody>
          <tr>
            <td className="codi-cell">Martes</td>
            <td className="codi-cell"> - </td>
            <td className="codi-cell"> - </td>
            <td className="codi-cell"> Testeo de patchera, chequeo de Computadora y Dante</td>
            <td className="codi-cell"> - </td>
            <td className="codi-cell"> -  </td>
          </tr>
          <tr>
            <td className="codi-cell">Miercoles</td>
            <td className="codi-cell"> - </td>
            <td className="codi-cell"> Limpieza y ordenar Río, chequeo de Computaroda y Dante </td>
            <td className="codi-cell"> - </td>
            <td className="codi-cell"></td>
            <td className="codi-cell"></td>
          </tr>
          <tr>
            <td className="codi-cell">Jueves</td>
            <td className="codi-cell"> - </td>
            <td className="codi-cell"> Limpieza y ordenar Río, chequeo de Computaroda y Dante </td>
            <td className="codi-cell"> - </td>
            <td className="codi-cell"> - </td>
            <td className="codi-cell"> - </td>
          </tr>
        </tbody>
      </table>
    </>
  )
}
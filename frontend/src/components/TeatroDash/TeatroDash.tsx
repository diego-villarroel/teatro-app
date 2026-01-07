import './TeatroDash.css'

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
          </tr>
        </thead>
        <tbody>
          {teatroData.mics.map((mic, index) => (
            <tr key={index}>
              <td>{mic.marca}</td>
              <td>{mic.modelo}</td>
              <td>{String(mic.cantidad)}</td>
              <td><div className={`estado-${mic.estado}`}>&nbsp;</div></td>
            </tr>
          ))}
          {teatroData.consolas.map((consola, index) => (
            <tr key={index}>
              <td>{consola.marca}</td>
              <td>{consola.modelo}</td>
              <td>{String(consola.cantidad)}</td>
              <td><div className={`estado-${consola.estado}`}>&nbsp;</div></td>
            </tr>
          ))}
          {teatroData.cajas.map((caja, index) => (
            <tr key={index}>
              <td>{caja.marca}</td>
              <td>{caja.modelo}</td>
              <td>{String(caja.cantidad)}</td>
              <td><div className={`estado-${caja.estado}`}>&nbsp;</div></td>
            </tr>
          ))}
        </tbody>
      </table>

    </div>
  )
}
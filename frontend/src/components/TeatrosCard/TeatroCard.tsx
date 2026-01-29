import { Link } from "react-router-dom";

// Definir una interfaz para el teatro
interface Teatro {
  id: string | number;
  nombre: string;
  mics: string | number;
  consolas: string | number;
  cajas: string | number;
  personal: string | number;
  otros: string | number;
}

// Definir una interfaz para las props del componente
interface TeatroProps {
  teatro: Teatro;
}

export const TeatroCard = ({teatro}: TeatroProps) => {
  return (
    <div className="teatroCard card">
      <h3>{teatro.nombre}</h3>
      <p>Consolas: {teatro.consolas} || Mics: {teatro.mics} || Cajas: {teatro.cajas}</p>
      <p>Personal: {teatro.personal}</p>
      <p>Otros Elementos: {teatro.otros}</p>
      <Link to={'/admin-teatro/teatro/'+teatro.id}><button>Ingresar</button></Link>
    </div>
  );
}
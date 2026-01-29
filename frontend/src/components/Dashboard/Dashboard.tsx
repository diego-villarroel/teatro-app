import { useEffect, useState } from "react";
import { TeatroCard } from "../TeatrosCard/TeatroCard";
import { getTeatros } from "../../services/teatros";
import './dashboard.css'

export const Dashboard = () => {
  const [teatros, setTeatros] = useState([]);
  useEffect(() => {
    getTeatros().then((teatros) => {
      setTeatros(teatros);
    });
  }, []);
  return (
    <div className="dash">
			{teatros.map((teatro: any) => (        
				<TeatroCard key={teatro.id} teatro={teatro}></TeatroCard>
			))}
    </div>
  );
}
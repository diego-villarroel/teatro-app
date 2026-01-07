import { TeatroCard } from "../TeatrosCard/TeatroCard";
import './dashboard.css'

export const Dashboard = () => {
  const teatros = [
    {nombre:'San Martin', mics:20, consolas:5, cajas:10, otros:7, personal:17},
    {nombre:'Alvear', mics:20, consolas:5, cajas:10, otros:7, personal:7},
    {nombre:'Regio', mics:20, consolas:5, cajas:10, otros:7, personal:7},
    {nombre:'La Rivera', mics:20, consolas:5, cajas:10, otros:7, personal:7},
    {nombre:'Sarmiento', mics:20, consolas:5, cajas:10, otros:7, personal:7},
  ]
  return (
    <div className="dash">
			{teatros.map((teatro, index) => (
				<TeatroCard key={index} teatro={teatro}></TeatroCard>
			))}
    </div>
  );
}
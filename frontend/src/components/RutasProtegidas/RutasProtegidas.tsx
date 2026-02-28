import type { ReactNode } from 'react';
import { Navigate } from 'react-router-dom';
import { useAuthContext } from '../../context/AuthContext/useAuthContext';

export const RutasProtegidas = ({ children }: { children: ReactNode }) => {
  const { user } = useAuthContext();
  
  if (!user) {
    return <Navigate to="/login" replace></Navigate>;
  }

  return children;
}

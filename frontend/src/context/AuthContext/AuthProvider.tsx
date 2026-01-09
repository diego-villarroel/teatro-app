import { useState } from 'react';
import type { ReactNode } from 'react';
import { AuthContext } from './AuthContext';

interface AuthProviderProps {
  children: ReactNode;
}

export const AuthProvider = ({ children }: AuthProviderProps) => {
  const [user, setUser] = useState(() => {
    const saved = sessionStorage.getItem('session');

    if (saved) {
      return JSON.parse(saved);
    } else {
      return null;
    }
  });

  const login = (name: string, password:string): boolean => {
    if (name === 'admin' && password === '1234') {
      const session = { name };
      setUser(session);
      sessionStorage.setItem('session', JSON.stringify(session));
      return true;
    }
    return false;
  }

  const logout = () => {
    sessionStorage.removeItem('session');
    setUser(null);
    alert('Cerrando Sesión');
  }

  return(
    <AuthContext.Provider value={{ user, login, logout }}>
      {children}
    </AuthContext.Provider>
  )
}
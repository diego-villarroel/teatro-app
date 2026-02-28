import { createContext } from 'react';

interface AuthContextType {
  user: { name: string | null };
  login: (name: string, password: string) => boolean;
  logout: () => void;
}

export const AuthContext = createContext<AuthContextType>({
  user: { name: null },
  login: () => false,
  logout: () => {}
});
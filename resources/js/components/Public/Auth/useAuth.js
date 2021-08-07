import { useState } from 'react';
export const useAuth = () => {

    const [hidenLogin, setHidenLogin] = useState(true);
    const [hidenReg, setHidenReg] = useState(true);

    const handleShowLogin = () => {
      setHidenLogin(!hidenLogin);
      setHidenReg(true)
    }

    const handleShowReg = () => {
      setHidenLogin(true);
      setHidenReg(!hidenReg)
    }

    return {
            hidenLogin,
            hidenReg,
            handleShowLogin,
            handleShowReg
        }
}
import React from 'react';
import Login from '../login';
import Register from '../registre';
import { useHukAuch } from './useHukAuch';
import { Button, Paper } from '@material-ui/core';
export default function Auch(){
    const {handleShowLogin, handleShowReg, hidenLogin, hidenReg} = useHukAuch();
    return  <>
                <div className='toolbar__group'>
                    <Button color="inherit" onClick={handleShowLogin} >Вход</Button>
                    <Button color="inherit" onClick={handleShowReg} >Регистрация</Button>
                </div>
                <Paper hidden={hidenLogin} className="toolbar__auth" elevation={3}>
                    <Login/>
                </Paper>
                <Paper hidden={hidenReg} className="toolbar__auth" elevation={3}>
                    <Register/>
                </Paper>
            </>
}

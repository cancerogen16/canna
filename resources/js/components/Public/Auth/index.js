import React from 'react';

import {useAuth} from './useAuth';
import {Button, Paper} from '@material-ui/core';
import Login from '../Login';
import Register from '../Register';

export default function Auth() {

    const {handleShowLogin, handleShowReg, hidenLogin, hidenReg} = useAuth();

    return <>
        <div className='toolbar__group'>
            <Button color="inherit" onClick={handleShowLogin}>Вход</Button>
            <Button color="inherit" onClick={handleShowReg}>Регистрация</Button>
        </div>
        <Paper hidden={hidenLogin} className="toolbar__auth" elevation={3}>
            <Login/>
        </Paper>
        <Paper hidden={hidenReg} className="toolbar__auth" elevation={3}>
            <Register/>
        </Paper>
    </>
}

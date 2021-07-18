import { AppBar, IconButton, Toolbar, Typography, Button, Paper } from '@material-ui/core';
import React, { useEffect, useState } from 'react';
import Login from '../login';
import Register from '../registre';


export default function Header() {
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

    return (<>
        <AppBar className="header" position="static">
        <Toolbar className="toolbar">
          <Typography variant="h6" >
            News
          </Typography>
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
        </Toolbar>
        
      </AppBar>
      
      
      </>
    );
}
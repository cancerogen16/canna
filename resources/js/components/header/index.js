import { AppBar, IconButton, Toolbar, Typography, Button, Paper } from '@material-ui/core';
import React, { useEffect, useState } from 'react';
import Login from '../login';
import Register from '../registre';


export default function Header() {
    const [hidenLogin, setHidenLogin] = useState(true);
    const [hidenReg, setHidenReg] = useState(true);


    return (<>
        <AppBar position="static">
        <Toolbar className="toolbar">
          <Typography variant="h6" >
            News
          </Typography>
          <div className='toolbar__group'>
            <Button color="inherit" onClick={() => setHidenLogin(!hidenLogin)} >Вход</Button>
            <Button color="inherit" onClick={() => setHidenReg(!hidenReg)} >Регистрация</Button>
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
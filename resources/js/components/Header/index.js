import {AppBar, Toolbar, Typography, Button} from '@material-ui/core';
import React from 'react';




export default function Header(props) {
    
    return (<>
        <AppBar className="header" position="static">
        <Toolbar className="toolbar">
          <Typography variant="h6"  >
            Canna
          </Typography>
            <Button color="inherit" href="/" >
                Главная
            </Button>
            <Button color="inherit" href="/salons" >
                Каталог
            </Button>
            <Button color="inherit" href="/actions" >
                Акции
            </Button>
            <Button color="inherit" href="/user" >
                Профиль
            </Button>
            <Button color="inherit" href="/dashboard" >
                Салон
            </Button>
          {props.children}
        </Toolbar>

      </AppBar>
      
      </>
    );
}
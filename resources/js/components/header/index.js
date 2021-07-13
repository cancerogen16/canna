import { AppBar, IconButton, Toolbar, Typography, Button } from '@material-ui/core';
import React, { useEffect } from 'react';


export default function Header() {
    
    return (
        <AppBar position="static">
        <Toolbar>
          <IconButton edge="start"  color="inherit" aria-label="menu">
            
          </IconButton>
          <Typography variant="h6" >
            News
          </Typography>
          <Button color="inherit">Login</Button>
        </Toolbar>
      </AppBar>
    );
}
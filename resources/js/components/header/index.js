import { AppBar, Toolbar, Typography } from '@material-ui/core';
import React from 'react';



export default function Header(props) {
    
    return (<>
        <AppBar className="header" position="static">
        <Toolbar className="toolbar">
          <Typography variant="h6" >
            Canna
          </Typography>
          {props.children}
        </Toolbar>
        
      </AppBar>
      
      
      </>
    );
}
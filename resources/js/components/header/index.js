import {AppBar, Toolbar, Typography, Button, Link} from '@material-ui/core';
import Buttons from './buttons';
import React from 'react';




export default function Header(props) {
    
    return (<>
        <AppBar className="header" position="static">
        <Toolbar className="toolbar">
          <Typography variant="h6"  >
            Canna
          </Typography>
            <Buttons/>
          {props.children}
        </Toolbar>

      </AppBar>
      
      </>
    );
}
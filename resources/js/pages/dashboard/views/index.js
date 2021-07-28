import { Button, Container, Dialog, DialogActions, DialogContent, DialogContentText, DialogTitle, Grid } from '@material-ui/core'
import React from 'react'


export default function Page(props) {

    

    return (<Container maxWidth="lg">
        <Grid container spacing={3}>
            <Grid item xs={9}>
                {console.log(props)}
            </Grid>
            <Grid item xs={3}>
                
            </Grid>
        </Grid>
            
    </Container>)
}
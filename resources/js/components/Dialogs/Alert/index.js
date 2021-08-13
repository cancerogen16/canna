import {Button, Dialog, DialogActions, DialogContent, DialogContentText, DialogTitle} from '@material-ui/core'
import React from 'react'

export default function Alert(props) {
    return <Dialog
        open={props.open}
        aria-labelledby="alert-dialog-title"
        aria-describedby="alert-dialog-description"
    >
        <DialogTitle id="alert-dialog-title">{props.title}</DialogTitle>
        <DialogContent>
            <DialogContentText id="alert-dialog-description">
                {props.children}
            </DialogContentText>
        </DialogContent>
        <DialogActions>
            <Button onClick={props.handleYes} color="primary">
                Да
            </Button>
            <Button onClick={props.handleNot} color="primary">
                Нет
            </Button>
        </DialogActions>
    </Dialog>
}

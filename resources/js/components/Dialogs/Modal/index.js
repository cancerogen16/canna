import React from 'react';
import Button from '@material-ui/core/Button';
import Dialog from '@material-ui/core/Dialog';
import DialogTitle from '@material-ui/core/DialogTitle';
import DialogContent from '@material-ui/core/DialogContent';
import DialogActions from '@material-ui/core/DialogActions';



export default function Modal(props) {
  
  return (
    <div>
      <Dialog onClose={props.onClose} aria-labelledby="customized-dialog-title" open={props.open}>
        <DialogTitle id="customized-dialog-title" onClose={props.onClose}>
          {props.title}
        </DialogTitle>
        <DialogContent dividers>
          {props.children}
        </DialogContent>
        <DialogActions>
          <Button autoFocus onClick={props.onClose} color="primary">
            {props.closeButton}
          </Button>
        </DialogActions>
      </Dialog>
    </div>
  );
}
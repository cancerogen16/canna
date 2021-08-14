import { Button } from '@material-ui/core';
import { SnackbarProvider, useSnackbar } from 'notistack';
import React, { useEffect } from 'react'
import { useSelector } from 'react-redux';
import { useSnack } from '../../../store/error/useSnack';

export default function Alert (props){
    const err = useSelector(state => state.error);
    const {snack} = useSnack();
    
    useEffect(() => {
        if(err.length > 0){
            err.map((item, index) => {
              snack(item.message, 'error', index +1);
            })
          }
    })
    return <>{props.children}</>            
}

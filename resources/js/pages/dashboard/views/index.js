import { Button, Container, Dialog, DialogActions, DialogContent, DialogContentText, DialogTitle, Grid } from '@material-ui/core'
import React, { useEffect } from 'react'
import { useDispatch, useSelector } from 'react-redux'
import { fetchSalonsOneId } from '../../../store/salon/thunks';
import { updateSalonUser, updateSalonUserFetch } from '../../../store/user/action';


export default function Page(props) {
    const dispatch = useDispatch();
    const user = useSelector(state => state.user)
    const salon = useSelector(state => state.salon)
    
    useEffect(() => {
        
        dispatch(fetchSalonsOneId(user.salon));
        

    }, [])
    
    return <></>
}
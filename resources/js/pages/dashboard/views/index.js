import React, { useEffect, useState } from 'react'
import { useDispatch, useSelector } from 'react-redux'
import FormSalon from '../../../components/Dashboard/FormSalon';
import Salon from '../../../components/Public/Salon';
import {fetchSalonsOneId } from '../../../store/salon/thunks';



export default function Page(props) {
    const dispatch = useDispatch();
    const user = useSelector(state => state.user)
    const salon = useSelector(state => state.salon)
    useEffect(() => {
        if(user.salon)
            dispatch(fetchSalonsOneId(user.salon))
        
    },[])

    if(!!user.salon){
        return <Salon salon={salon}/>
    }
    return <FormSalon {...props}/>
}
import React, { useEffect, useState } from 'react'
import { useDispatch, useSelector } from "react-redux";
import { fetchMastersOfSalon } from "../../../store/master/thunks";
import { fetchRecords } from "../../../store/records/thunks";
import { fetchSalonsOneId } from "../../../store/salon/thunks";

export default function useSalon(props){
    const [value, setValue] = useState(0);
    const [open, setOpen] = useState(false);

    const masters = useSelector(state => state.masters);
    const salon = useSelector(state => state.salon);
    const records = useSelector(state => state.records)

    const dispatch = useDispatch();
    
    
    const handleClickOpen = () => {
        dispatch(fetchRecords(1));
        setOpen(true);
    };

    const handleClose = () => {
        setOpen(false);
    };

    const handleChange = (event, newValue) => {
        setValue(newValue);
    };

    useEffect(() => {

        dispatch(fetchMastersOfSalon(props.match.params.id));
        dispatch(fetchSalonsOneId(props.match.params.id))
        
    }, [])

    return {
        value,
        masters,
        salon,
        open,
        records,
        handleClickOpen,
        handleClose,
        handleChange
    }
}
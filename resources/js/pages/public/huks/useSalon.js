import React, { useEffect, useState } from 'react'
import { useDispatch, useSelector } from "react-redux";
import { fetchRecords } from "../../../store/records/thunks";
import {fetchSalonInfo} from "../../../store/salon/thunks";
import { fetchServicesByMasterId, fetchServicesBySalonId } from '../../../store/services/thunks';

export default function useSalon(props){

    const [value, setValue] = useState(0);
    const masters = useSelector(state => state.masters);
    const salon = useSelector(state => state.salon);
    const services = useSelector(state => state.services);
    const actions = useSelector(state => state.actions);
    const dispatch = useDispatch();
    
    const handleClickMaster = (id) => {
        dispatch(fetchServicesByMasterId(id));
    }

    const handleClickSalon = (id) => {
        dispatch(fetchServicesBySalonId(id));
    }

    const handleChange = (event, newValue) => {
        setValue(newValue);
    };

    useEffect(() => {
        dispatch(fetchSalonInfo(props.match.params.id))
    }, [])

    return {
        value,
        salon,
        services,
        masters,
        actions,
        handleChange,
        handleClickMaster,
        handleClickSalon
    }
}
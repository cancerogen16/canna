import React, {useEffect, useState} from 'react'
import {useDispatch, useSelector} from "react-redux";
import {fetchMastersOfSalon} from "../../../store/master/thunks";
import {fetchRecords} from "../../../store/records/thunks";
import {fetchSalonInfo} from "../../../store/salon/thunks";
import {fetchServicesByMasterId, fetchServicesBySalonId} from '../../../store/services/thunks';

export default function useSalon(props) {
    const [value, setValue] = useState(0);
    const [open, setOpen] = useState(false);

    const masters = useSelector(state => state.masters);
    const salon = useSelector(state => state.salon);
    const records = useSelector(state => state.records);
    const services = useSelector(state => state.services);

    const dispatch = useDispatch();

    const handleClickMaster = (id) => {
        dispatch(fetchServicesByMasterId(id));
    }

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
        dispatch(fetchSalonInfo(props.match.params.id))
        dispatch(fetchServicesBySalonId(props.match.params.id))
    }, [])

    return {
        value,
        masters,
        salon,
        open,
        records,
        services,
        handleClickOpen,
        handleClose,
        handleChange,
        handleClickMaster,
    }
}
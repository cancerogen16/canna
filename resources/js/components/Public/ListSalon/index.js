import {Grid} from '@material-ui/core';
import {makeStyles} from '@material-ui/core/styles';
import React, {useEffect} from 'react';
import {useDispatch, useSelector} from 'react-redux';
import {fetchSalonsAll} from '../../../store/salons/thunks';

import CardSalon from './CardSalon';

function rand() {
    return Math.round(Math.random() * 20) - 10;
}

function getModalStyle() {
    const top = 50 + rand();
    const left = 50 + rand();

    return {
        top: `${top}%`,
        left: `${left}%`,
        transform: `translate(-${top}%, -${left}%)`,
    };
}

const useStyles = makeStyles((theme) => ({
    paper: {
        position: 'absolute',
        width: 400,
        backgroundColor: theme.palette.background.paper,
        border: '2px solid #000',
        boxShadow: theme.shadows[5],
        padding: theme.spacing(2, 4, 3),
    },
}));

export default function ListSalon() {
    const dispatch = useDispatch();


    const salons = useSelector(state => state.salons);
    const handleOpen = () => {
        setOpen(true);
    };

    const handleClose = () => {
        setOpen(false);
    };

    useEffect(() => {
        dispatch(fetchSalonsAll());
    }, []);
    return (
        <Grid container spacing={3}>
            {salons.map(salon => <Grid key={salon.id} item xs={6}> <CardSalon key={salon.id} salon={salon}/></Grid>)}
        </Grid>


    );
}
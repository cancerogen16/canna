import { Button } from '@material-ui/core';
import { makeStyles } from '@material-ui/core/styles';
import React from 'react';

const useStyles = makeStyles((theme) => ({
    margin: {
        margin: theme.spacing(1),
    },
    extendedIcon: {
        marginRight: theme.spacing(1),
    },
}));

export default function Buttons() {
    const classes = useStyles();

    return (
        <div>
            <Button color="inherit" href="/" className={classes.margin}>
                Главная
            </Button>
            <Button color="inherit" href="/salons" className={classes.margin}>
                Каталог
            </Button>
            <Button color="inherit" href="/actions" className={classes.margin}>
                Акции
            </Button>
            <Button color="inherit" href="/user" className={classes.margin}>
                Профиль
            </Button>
            <Button color="inherit" href="/dashboard" className={classes.margin}>
                Салон
            </Button>
    </div>
    );

}
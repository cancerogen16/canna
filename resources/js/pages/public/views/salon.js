import { Button, Card, Container, Grid, List, ListItem } from '@material-ui/core'
import React, { Component, useEffect } from 'react'
import { useDispatch, useSelector } from 'react-redux';
import DialogWindow from '../../../components/dialog';
import Preview from '../../../components/masters/preview';
import priviewMaster from '../../../components/masters/preview/style';
import Salon from '../../../components/salon'
import styleSalon from '../../../components/salon/style';
import { SimpleTabs, TabPanel } from '../../../components/tabs';
import { fetchMasters, fetchMastersOfSalon } from '../../../store/master/action';
import { fetchRecords } from '../../../store/records/action';
import { fetchSalonsOneId } from '../../../store/salon/action';

export default function Page(props) {
    const [value, setValue] = React.useState(0);
    const masters = useSelector(state => state.masters);
    const salon = useSelector(state => state.salon);
    const classes = priviewMaster();
    const dispatch = useDispatch();
    
    const [open, setOpen] = React.useState(false);
    const records = useSelector(state => state.records)
    const handleClickOpen = () => {
        dispatch(fetchRecords(1));
        setOpen(true);
        //console.log(records)
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
    console.log(salon)
    return (
        <Grid container spacing={3}>
            <Grid item xs={12}>
                <Salon salon={salon}/>
                <SimpleTabs value={value} handleChange={handleChange} tabs={[{label: 'Услуги', index: 0}, {label: 'Мастера', index: 1}]}>
                <TabPanel value={value} index={0}>
                        Услуги
                    </TabPanel>
                    <TabPanel value={value} index={1}>
                        <List>
                            {masters.map(master =>{
                                return  <ListItem className={classes.root}   key={master.id} button>
                                            <Preview  master={master}>
                                                <Button onClick={ handleClickOpen} >Записаться</Button>
                                            </Preview>
                                        </ListItem>
                            })}
                        </List>
                    </TabPanel>
                </SimpleTabs>
                <DialogWindow open={open} onClose={handleClose} closeButton={'Закрыть'}>
                            {records.map(record => {
                                let date = new Date(record.start_datetime);
                                return <Card>{`${date.getUTCHours()}:${date.getUTCMinutes()}`}</Card>
                            })}
                </DialogWindow>
            </Grid>
        </Grid>)
}
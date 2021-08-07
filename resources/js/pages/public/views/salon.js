import { Button, Card, Grid, List, ListItem } from '@material-ui/core'
import React from 'react';
import useSalon from '../huks/useSalon';
import priviewMaster from '../../../components/Public/MasterPreview/style';
import MasterPreview from '../../../components/Public/MasterPreview';
import Salon from '../../../components/Public/Salon';
import { SimpleTabs, TabPanel } from '../../../components/Tabs';
import Modal from '../../../components/Dialogs/Modal';


export default function Page(props) {
    const {
        value,
        masters,
        salon,
        open,
        records,
        handleClickOpen,
        handleClose,
        handleChange
    } = useSalon(props);
    const classes = priviewMaster();
    
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
                                            <MasterPreview   master={master}>
                                                <Button onClick={ handleClickOpen} >Записаться</Button>
                                            </MasterPreview >
                                        </ListItem>
                            })}
                        </List>
                    </TabPanel>
                </SimpleTabs>
                <Modal open={open} onClose={handleClose} closeButton={'Закрыть'}>
                            {records.map(record => {
                                let date = new Date(record.start_datetime);
                                return <Card>{`${date.getUTCHours()}:${date.getUTCMinutes()}`}</Card>
                            })}
                </Modal>
            </Grid>
        </Grid>)
}
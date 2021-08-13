import {Card, Grid, List, ListItem} from '@material-ui/core'
import React from 'react';
import useSalon from '../huks/useSalon';
import priviewMaster from '../../../components/Public/MasterPreview/style';
import MasterPreview from '../../../components/Public/MasterPreview';
import ServicePreview from '../../../components/Public/ServicePreview'
import Salon from '../../../components/Public/Salon';
import {SimpleTabs, TabPanel} from '../../../components/Tabs';
import Modal from '../../../components/Dialogs/Modal';
import ControlledAccordions from '../../../components/Public/ControlledAccordions';


export default function Page(props) {
    const {
        value,
        masters,
        salon,
        open,
        records,
        services,
        handleClickOpen,
        handleClose,
        handleChange,
        handleClickMaster
    } = useSalon(props);
    const classes = priviewMaster();

    return (
        <Grid container spacing={3}>
            <Grid item xs={12}>
                <Salon salon={salon}/>
                <SimpleTabs value={value} handleChange={handleChange}
                            tabs={[{label: 'Услуги', index: 0}, {label: 'Мастера', index: 1}]}>
                    <TabPanel value={value} index={0}>
                        {services.map(service => {
                            return <ListItem className={classes.root} key={service.id} button>
                                <ControlledAccordions
                                    heading={<ServicePreview service={service}/>}
                                    //content={<ServicePreview />}
                                />
                            </ListItem>
                        })}
                    </TabPanel>
                    <TabPanel value={value} index={1}>
                        <List>
                            {masters.map(master => {
                                return <ListItem className={classes.root} key={master.id} button>
                                    <ControlledAccordions onClick={() => handleClickMaster(master.id)}
                                                          heading={<MasterPreview master={master}/>}
                                        //content={<ServicePreview />}
                                    />
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
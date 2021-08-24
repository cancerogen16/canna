import {Button, Chip, Grid, List, ListItem, MenuItem, TextField} from '@material-ui/core'
import React from 'react';
import useSalon from '../huks/useSalon';
import priviewMaster from '../../../components/Public/MasterPreview/style';
import MasterPreview from '../../../components/Public/MasterPreview';
import ServicePreview from '../../../components/Public/ServicePreview';
import DiscountPreview from '../../../components/Public/DiscountPreview';
import Salon from '../../../components/Public/Salon';
import {SimpleTabs, TabPanel} from '../../../components/Tabs';
import Modal from '../../../components/Dialogs/Modal';
import ControlledAccordions from '../../../components/Public/ControlledAccordions';
import FormRecord from '../../../components/Dashboard/FormRecord';
import useRecord from '../huks/useRecord';


export default function Page(props) {
    const {
        value,
        salon,
        services,
        masters,
        actions,
        handleChange
    } = useSalon(props);
    const {
        open,
        cretendials,
        times,
        handleClose,
        handleRecord,
        handleEditRecordForm,
    } = useRecord();

    const classes = priviewMaster();
    
    return (
        <Grid container spacing={3}>
            <Grid item xs={12}>
                <Salon salon={salon}/>
                <SimpleTabs value={value} handleChange={handleChange}
                            tabs={[
                                {label: 'Услуги', index: 0},
                                {label: 'Мастера', index: 1},
                                {label: 'Акции', index: 2}
                            ]}>
                    <TabPanel value={value} index={0}>
                        {services.map(service => {
                            return <ListItem  className={classes.root} key={service.id} button>
                                    <ControlledAccordions
                                         heading={<ServicePreview  service={service}><Button onClick={(e) => handleRecord(e, '', service.id)}>Записаться</Button></ServicePreview>}
                                         
                                    />
                            </ListItem>
                        })}
                    </TabPanel>
                    <TabPanel value={value} index={1}>
                        <List>
                            {masters.map(master => {
                                return <ListItem className={classes.root} key={master.id} button>
                                    
                                    <ControlledAccordions 
                                            heading={<MasterPreview master={master}>
                                                        <Button onClick={(e) => handleRecord(e, master.id, '')}>Записаться</Button>
                                                    </MasterPreview>}
                                            content={master.description}
                                    />
                                </ListItem>
                            })}
                        </List>
                    </TabPanel>
                    <TabPanel value={value} index={2}>
                        <List>
                            {actions.map(action => {
                                return <ListItem className={classes.root} key={action.id} button>
                                    <ControlledAccordions
                                        heading={<DiscountPreview action={action}/>}
                                    />
                                </ListItem>
                            })}
                        </List>
                    </TabPanel>
                </SimpleTabs>
                <Modal open={open} onClose={handleClose} closeButton={'Закрыть'}>
                    <FormRecord label='Мастер' name="master" value={cretendials.master_id}onChange={(e) =>  handleEditRecordForm(e)} selectes={masters} >
                        {masters.map(master => <MenuItem key={master.id} value={master.id}>
                                {master.name}
                            </MenuItem>
                        )}
                    </FormRecord>
                    <FormRecord label='Услуга' name='service' value={cretendials.service_id} onChange={(e) =>  handleEditRecordForm(e)}>
                        {services.map(service => <MenuItem key={service.id} value={service.id}>
                                {service.title}
                            </MenuItem> 
                        )}
                    </FormRecord>
                    <TextField
                        onChange={handleEditRecordForm}
                        name="date"
                        id="date"
                        label="Birthday"
                        type="date"
                        defaultValue={cretendials.date}
                        //className={classes.textField}
                        InputLabelProps={{
                        shrink: true,
                        }}
                    />
                    <ul>
                        {times.map(time => <li key={time.id}>
                            <Chip
                                
                                label={time.start_datetime}
                                
                                //className={classes.chip}
                            />
                        </li>)}
                    </ul>
                    
                </Modal>
            </Grid>
        </Grid>)
}
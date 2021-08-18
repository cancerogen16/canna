import { Button, Divider, List, ListItem } from '@material-ui/core'
import { SettingsInputAntennaTwoTone } from '@material-ui/icons'
import React, { useRef, useState } from 'react'
import { useDispatch, useSelector } from 'react-redux'
import FormMaster from '../../../components/Dashboard/FormMaster'
import useFormMaster from '../../../components/Dashboard/FormMaster/useFormMaster'
import Modal from '../../../components/Dialogs/Modal'
import MasterPreview from '../../../components/Public/MasterPreview'
import priviewMaster from '../../../components/Public/MasterPreview/style'
import { delMaster } from '../../../store/master/action'
import styleMasters from '../styles/masters'


export default function Page(props) {
    const {handleSubmit, setCredentials, credentials} = useFormMaster()
    const dispatch = useDispatch();
    const [open, setOpen] = useState(false);
    const classes = priviewMaster();
    const masters = useSelector(state => state.masters);
    const pageStyle = styleMasters();
    const closeModal = () => setOpen(!open);
    const openModal = (master) => {
        setOpen(!open);
        setCredentials({...credentials, ...master});
    }

    return  <div className={pageStyle.root}>
                <Button className={pageStyle.addBtn} onClick={closeModal}>Добавить</Button>
                <List>
                    {console.log(credentials)}
                {masters.map(master =>{
                    return  <ListItem key={master.id} className={classes.root}  button>
                        <MasterPreview   master={master}>
                            <Button onClick={() => openModal(master)}>Редактировать</Button>
                            <Button onClick={() => dispatch(delMaster(master.id))}>Удалить</Button>
                        </MasterPreview>
                            </ListItem>
                    
                })}

            </List>
            <Modal 
                open={open}
                title="Укажите информацию о сотруднике"
            >
                <FormMaster
                    submit={(e) => handleSubmit(e, closeModal)} 
                    close={closeModal} 
                />
            </Modal>
            </div>
}
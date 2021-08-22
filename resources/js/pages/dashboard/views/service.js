import { Button, Divider, List, ListItem } from '@material-ui/core'
import { SettingsInputAntennaTwoTone, SystemUpdateOutlined } from '@material-ui/icons'
import React, { useRef, useState } from 'react'
import { useDispatch, useSelector } from 'react-redux'
import FormService from '../../../components/Dashboard/FormService'
import useFormService from '../../../components/Dashboard/FormService/useFormService'
import Modal from '../../../components/Dialogs/Modal'
import ServicePreview from '../../../components/Public/ServicePreview'
import priviewService from '../../../components/Public/ServicePreview/style'
import { delService } from '../../../store/services/action'
import { fetchDeleteService } from '../../../store/service/thunks'
import styleServices from '../styles/service'


export default function Page(props) {
    const formService = useFormService();
    const {handleSubmit, closeModal, openModal, open, setUpdate} = formService;
    const dispatch = useDispatch();
    const classes = priviewService();
    const services = useSelector(state => state.services);
    const pageStyle = styleServices();



    return  <div className={pageStyle.root}>
        <Button className={pageStyle.addBtn} onClick={closeModal}>Добавить</Button>
        <List>
            {services.map(service =>{
                return  <ListItem key={service.id} className={classes.root}  button>
                    <ServicePreview   service={service}>
                        <Button onClick={() => openModal(service, () => setUpdate(true))}>Редактировать</Button>
                        <Button onClick={() => dispatch(fetchDeleteService(service.id))}>Удалить</Button>
                    </ServicePreview>
                </ListItem>
            })}
        </List>
        <Modal
            open={open}
            title="Укажите информацию об услуге"
        >
            <FormService
                useHuck={formService}
                submit={(e) => handleSubmit(e, closeModal)}
                close={closeModal}
            />
        </Modal>
    </div>
}
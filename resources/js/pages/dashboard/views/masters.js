import {Button, List, ListItem} from '@material-ui/core'
import React from 'react'
import {useDispatch, useSelector} from 'react-redux'
import FormMaster from '../../../components/Dashboard/FormMaster'
import useFormMaster from '../../../components/Dashboard/FormMaster/useFormMaster'
import Modal from '../../../components/Dialogs/Modal'
import MasterPreview from '../../../components/Public/MasterPreview'
import priviewMaster from '../../../components/Public/MasterPreview/style'
import {fetchDeleteMaster} from '../../../store/master/thunks'
import styleMasters from '../styles/masters'

export default function Page(props) {
    const formMaster = useFormMaster();
    const {handleSubmit, closeModal, openModal, open, setUpdate} = formMaster;
    const dispatch = useDispatch();
    const classes = priviewMaster();
    const masters = useSelector(state => state.masters);
    const pageStyle = styleMasters();

    return <div className={pageStyle.root}>
        <Button className={pageStyle.addBtn} onClick={closeModal}>Добавить</Button>
        <List>
            {masters.map(master => {
                return <ListItem key={master.id} className={classes.root} button>
                    <MasterPreview master={master}>
                        <Button onClick={() => openModal(master, () => setUpdate(true))}>Редактировать</Button>
                        <Button onClick={() => dispatch(fetchDeleteMaster(master.id))}>Удалить</Button>
                    </MasterPreview>
                </ListItem>
            })}
        </List>
        <Modal
            open={open}
            title="Укажите информацию о сотруднике"
        >
            <FormMaster
                useHuck={formMaster}
                submit={(e) => handleSubmit(e, closeModal)}
                close={closeModal}
            />
        </Modal>
    </div>
}
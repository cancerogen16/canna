import {Button, List, ListItem} from '@material-ui/core'
import React from 'react'
import {useDispatch, useSelector} from 'react-redux'
import ServicePreview from '../../../components/Public/ServicePreview'
import priviewService from '../../../components/Public/ServicePreview/style'
import {delServices} from '../../../store/services/action'

export default function Page(props) {
    const dispatch = useDispatch();
    const classes = priviewService()
    const services = useSelector(state => state.services);
    return <List>

        {services.map(service => {
            return <ListItem key={service.id} className={classes.root} button>
                <ServicePreview service={service}>
                    <Button>Редактировать</Button>
                    <Button onClick={() => dispatch(delServices(service.id))}>Удалить</Button>
                </ServicePreview>
            </ListItem>

        })}

    </List>
}
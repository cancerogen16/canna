import { Button, Divider, List, ListItem } from '@material-ui/core'
import React from 'react'
import { useDispatch, useSelector } from 'react-redux'
import Preview from '../../../components/actions/preview'
import { delAction} from '../../../store/action/action'
import styleActions from '../styles/actions'


export default function Page(props) {
    const dispatch = useDispatch();
    const classes = styleActions()
    const actions = useSelector(state => state.actions);
    return <List>

        {actions.map(action =>{
            return  <ListItem key={action.id} className={classes.root}  button>
                <Preview   action={action}>
                    <Button>Редактировать</Button>
                    <Button onClick={() => dispatch(delAction(action.id))}>Удалить</Button>
                </Preview>
            </ListItem>

        })}

    </List>
}
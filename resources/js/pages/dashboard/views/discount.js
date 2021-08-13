import {Button, List, ListItem} from '@material-ui/core'
import React from 'react'
import {useDispatch, useSelector} from 'react-redux'
import DiscountPreview from '../../../components/Public/DiscountPreview'
import discountPreview from '../../../components/Public/DiscountPreview/style'
import {delAction} from '../../../store/action/action'

export default function Page(props) {
    const dispatch = useDispatch();
    const classes = discountPreview()
    const actions = useSelector(state => state.actions);
    return <List>

        {actions.map(action => {
            return <ListItem key={action.id} className={classes.root} button>
                <DiscountPreview action={action}>
                    <Button>Редактировать</Button>
                    <Button onClick={() => dispatch(delAction(action.id))}>Удалить</Button>
                </DiscountPreview>
            </ListItem>
        })}

    </List>
}
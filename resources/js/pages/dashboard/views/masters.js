import {List, ListItem} from '@material-ui/core'
import React from 'react'
import {useDispatch, useSelector} from 'react-redux'

export default function Page(props) {
    const dispatch = useDispatch();

    const masters = useSelector(state => state.masters);
    return <List>

        {masters.map(master => {
            return <ListItem key={master.id} className={classes.root} button>

            </ListItem>

        })}

    </List>
}
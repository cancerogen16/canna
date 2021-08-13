import {Divider, Link, List, ListItem, ListItemText} from '@material-ui/core'
import React from 'react'

export default function Navigation(props) {
    return <>
        <List>
            {props.items.map(item => {
                return <div key={item.href}>
                    <Divider/>
                    <Link href={item.href}>
                        <ListItem button>
                            <ListItemText primary={item.title}/>
                        </ListItem>
                    </Link>
                </div>
            })}
        </List>
    </>
}
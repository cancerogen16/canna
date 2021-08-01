import { Divider, Link, List, ListItem, ListItemIcon, ListItemText } from '@material-ui/core'
import React from 'react'




export default function Navigation (props){
    return  <>
            
                <List>
                <Divider />
                    <Link href="/dashboard">
                        <ListItem button>
                            <ListItemText primary={"Мой салон"} />
                        </ListItem>
                    </Link>
                <Divider />
                    <Link href="/dashboard/masters">
                        <ListItem button>
                            <ListItemText primary={"Сотрудники"} />
                        </ListItem>
                    </Link>
                    <Divider />
                    <Link href="/dashboard/masters">
                        <ListItem button>
                            <ListItemText primary={"Акции"} />
                        </ListItem>
                    </Link>
                    <Divider />
                    <Divider />
                    <Link href="/dashboard/masters">
                        <ListItem button>
                            <ListItemText primary={"Акции"} />
                        </ListItem>
                    </Link>
                    <Divider />
                    <Divider />
                    <Link href="/dashboard/masters">
                        <ListItem button>
                            <ListItemText primary={"Акции"} />
                        </ListItem>
                    </Link>
                    <Divider />
                </List>
            </>
}
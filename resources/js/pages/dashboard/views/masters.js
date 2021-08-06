import { Button, Divider, List, ListItem } from '@material-ui/core'
import React from 'react'
import { useDispatch, useSelector } from 'react-redux'
import { delMaster } from '../../../store/master/action'


export default function Page(props) {
    const dispatch = useDispatch();
   
    const masters = useSelector(state => state.masters);
    return <List>
                
                {masters.map(master =>{
                    return  <ListItem key={master.id} className={classes.root}  button>
                                    
                            </ListItem>
                    
                })}

            </List>
}
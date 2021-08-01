import { Button, Divider, List, ListItem } from '@material-ui/core'
import React from 'react'
import { useDispatch, useSelector } from 'react-redux'
import Preview from '../../../components/masters/preview'
import { delMaster } from '../../../store/master/action'
import styleMasters from '../styles/masters'


export default function Page(props) {
    const dispatch = useDispatch();
    const classes = styleMasters()
    const masters = useSelector(state => state.masters);
    return <List>
                
                {masters.map(master =>{
                    return  <ListItem key={master.id} className={classes.root}  button>
                                    <Preview   master={master}>
                                        <Button>Редактировать</Button>
                                        <Button onClick={() => dispatch(delMaster(master.id))}>Удалить</Button>
                                    </Preview>
                            </ListItem>
                    
                })}

            </List>
}
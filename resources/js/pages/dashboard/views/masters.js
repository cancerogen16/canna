import { Button, Divider, List, ListItem } from '@material-ui/core'
import React from 'react'
import { useDispatch, useSelector } from 'react-redux'
import MasterPreview from '../../../components/Public/MasterPreview'
import priviewMaster from '../../../components/Public/MasterPreview/style'
import { delMaster } from '../../../store/master/action'


export default function Page(props) {
    const dispatch = useDispatch();
    const classes = priviewMaster();
    const masters = useSelector(state => state.masters);
    return <List>
                
                {masters.map(master =>{
                    return  <ListItem key={master.id} className={classes.root}  button>
                        <MasterPreview   master={master}>
                            <Button>Редактировать</Button>
                            <Button onClick={() => dispatch(delMaster(master.id))}>Удалить</Button>
                        </MasterPreview>
                            </ListItem>
                    
                })}

            </List>
}
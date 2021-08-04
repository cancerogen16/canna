import { Avatar, Button, Divider, Drawer } from '@material-ui/core'
import priviewAction from './style';
import React from 'react'
import { useDispatch } from 'react-redux';
import { delAction } from '../../../store/action/action';





export default function Preview (props){

    const {action} = props;
    const classes = priviewAction();
    return  <>

        <div className={classes.root}>
            <Avatar className={classes.ava} alt={action.name} src={action.photo} />
            <div className={classes.info}>
                <span className={classes.name}>{action.name}</span>
                <span className={classes.spec}>{action.position}</span>
            </div>
        </div>
        <div className={classes.btns}>
            {props.children}
        </div>
    </>

}
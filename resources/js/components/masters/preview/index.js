import { Avatar, Button, Divider, Drawer } from '@material-ui/core'
import priviewMaster from './style';
import React from 'react'
import { useDispatch } from 'react-redux';
import { delMaster } from '../../../store/master/action';





export default function Preview (props){

    const {master} = props;
    const classes = priviewMaster();
    return  <>
            
            <div className={classes.root}>
                <Avatar className={classes.ava} alt={master.name} src={master.photo} />
                <div className={classes.info}>
                    <span className={classes.name}>{master.name}</span>
                    <span className={classes.spec}>{master.position}</span>
                </div>
            </div>
            <div className={classes.btns}>
                    {props.children}
                </div>
            </>
                
}
import { Avatar } from '@material-ui/core'
import priviewMaster from './style';
import React from 'react'





export default function MasterPreview (props){

    const {master} = props;
    const classes = priviewMaster();
    
    return  <>
            
            <div onClick={props.onClick} className={classes.root}>
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
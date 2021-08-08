import { Avatar } from '@material-ui/core'
import priviewService from './style';
import React from 'react'





export default function ServicePreview (props){

    const {service} = props;
    const classes = priviewService();
    
    return  <>
            
            <div className={classes.root}>
                <Avatar className={classes.ava} alt={service.title} src={service.image} />
                <div className={classes.info}>
                    <span className={classes.name}>{service.title}</span>
                    <span className={classes.spec}>{service.description}</span>
                </div>
                <div>
                    <p >Цена: {service.price} руб.</p>
                    <p>Продолжительность услуги: {service.duration} ч.</p>
                </div>
            </div>
            
            
            </>
                
}
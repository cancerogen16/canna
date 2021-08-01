import { Avatar, Divider, Link, List, ListItem, ListItemIcon, ListItemText } from '@material-ui/core'
import React from 'react'
import { useSelector } from 'react-redux';
import Preview from '../masters/preview';
import {SimpleTabs, TabPanel } from '../tabs';
import styleSalon from './style';



export default function Salon (props){
   
    const classes = styleSalon();
    return  <>
                <div className={classes.header}>
                    <Avatar className={classes.ava} alt="Remy Sharp" src="/static/images/avatar/1.jpg" />
                    <h2>Новый салон</h2>
                </div>
                <div className={classes.info}>
                    <img className={classes.img} src='/img/1.jpg'/>
                    <div className={classes.contact}>
                        <span className={classes.contactItem}>Телефон: </span>
                        <span className={classes.contactItem}>Адрес: </span>
                        <span className={classes.contactItem}>График работы: </span>
                    </div>
                </div>
                <div className={classes.about}>
                    <h3 >О нас</h3>
                    <p></p>
                </div>
            </>
}
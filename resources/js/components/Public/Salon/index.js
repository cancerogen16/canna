import {Avatar} from '@material-ui/core'
import React from 'react'
import styleSalon from './style';

export default function Salon(props) {
    const {title, main_photo, city, address, phone, description} = props.salon
    const classes = styleSalon();

    return <>
        <div className={classes.header}>
            <Avatar className={classes.ava} alt={title} src="/"/>
            <h2>{title}</h2>
        </div>
        <div className={classes.info}>
            <img className={classes.img} src={main_photo}/>
            <div className={classes.contact}>
                <span className={classes.contactItem}>Телефон: <span>{phone}</span></span>
                <span className={classes.contactItem}>Город: <span>{city}</span></span>
                <span className={classes.contactItem}>Адрес: <span>{address}</span></span>
            </div>
        </div>
        <div className={classes.about}>
            <h3>О нас</h3>
            <div>{description}</div>
        </div>
    </>
}
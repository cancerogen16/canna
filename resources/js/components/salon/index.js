import { Avatar, Button, Divider, IconButton, Link, List, ListItem, ListItemIcon, ListItemText } from '@material-ui/core'
import React, { useEffect, useState } from 'react'
import { useDispatch, useSelector } from 'react-redux';
import Preview from '../masters/preview';
import {SimpleTabs, TabPanel } from '../tabs';
import styleSalon from './style';
import EditIcon from '@material-ui/icons/Edit';
import { fetchCreateSalon } from '../../store/salon/action';



export default function Salon (props){
    const dispatch = useDispatch();
    
    const [contenteditable, setContenteditable] = useState(false);
    const [salon, setSalon] = useState({...props.salon});
    const {user_id,title, slug, main_photo, city, address,rating, phone, description} = salon
    const classes = styleSalon();
    const user = useSelector(state => state.user)
    useEffect(() => {
       
    }, [])

    const editField = (e) => {
         switch(e.target.id){
             case 'title':
                 setSalon({...salon, title: e.target.textContent})
                 break;
            case 'phone':
                setSalon({...salon, phone: e.target.textContent})
                break;
            case 'city':
                setSalon({...salon, city: e.target.textContent})
                break;
            case 'adress':
                setSalon({...salon, address: e.target.textContent})
                break;
            case 'desc':
                setSalon({...salon, description: e.target.textContent})
                break;
         }
        
    }

    const handleSave = () => {
            setSalon({
                ...salon,
                user_id: user.id,
                slug: '22ww',
                rating: 0
            })
            
            dispatch(fetchCreateSalon(salon));
    }
    console.log(salon);
    return  <>
                <div className={classes.header}>
                    <Avatar className={classes.ava} alt={title} src="" />
                    <h2 id='title' contentEditable={contenteditable} onBlur={editField} >{title}</h2>
                    {props.edit
                        ? <IconButton onClick={() => setContenteditable(!contenteditable)} color="primary" aria-label="upload picture" component="span">
                            <EditIcon />
                         </IconButton>
                        :null   
                    }
                    
                </div>
                <div className={classes.info}>
                    <img className={classes.img} src={main_photo}/>
                    <div className={classes.contact}>
                        <span className={classes.contactItem}>Телефон: <span id="phone" contentEditable={contenteditable} onBlur={editField}>{phone}</span></span>
                        <span className={classes.contactItem}>Город: <span id="city" onBlur={editField} contentEditable={contenteditable}>{city}</span></span>
                        <span className={classes.contactItem}>Адрес: <span id="adress" onBlur={editField} contentEditable={contenteditable}>{address}</span>{address}</span>
                    </div>
                </div>
                <div className={classes.about}>
                    <h3 >О нас</h3>
                    <div id='desc' onBlur={editField} contentEditable={contenteditable}>{description}</div>
                </div>
                {props.edit
                    ?<Button onClick={handleSave}>Сохранить</Button>
                    :null
                }
                
            </>
}
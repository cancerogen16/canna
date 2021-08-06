import { Avatar, Button, Divider, IconButton, Link, List, ListItem, ListItemIcon, ListItemText } from '@material-ui/core'
import React, { useEffect, useReducer, useState } from 'react'
import { useDispatch, useSelector } from 'react-redux';
import Preview from '../masters/preview';
import {SimpleTabs, TabPanel } from '../tabs';
import styleSalon from './style';
import EditIcon from '@material-ui/icons/Edit';
import { fetchCreateSalon } from '../../store/salon/action';



export default function Salon (props){
    const dispatch = useDispatch();
    
    const [contenteditable, setContenteditable] = useState(false);
    //const [salon, setSalon] = useState({...props.salon});
    console.log('salon',props)
    const {title, main_photo, city, address, phone, description} = props.salon
    const classes = styleSalon();
    const user = useSelector(state => state.user)
    useEffect(() => {
       
    }, [])

    const editField = (e) => {
         switch(e.target.id){
             case 'title':
                 title = e.target.textContent
                 break;
            case 'phone':
                phone = e.target.textContent
                break;
            case 'city':
                city = e.target.textContent
                break;
            case 'adress':
                address = e.target.textContent
                break;
            case 'desc':
                description = e.target.textContent
                break;
         }
        
    }

    const handleSave = () => {
            console.log('salon',{user_id: user.id,title, main_photo, city, address, phone, description})
            //dispatch(fetchCreateSalon({user_id: user.id,title, main_photo, city, address, phone, description}));
    }
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
                        <span className={classes.contactItem}>Адрес: <span id="adress" onBlur={editField} contentEditable={contenteditable}>{address}</span></span>
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
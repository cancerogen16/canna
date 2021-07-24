import React, { useEffect, useState } from 'react'
import { Button } from '@material-ui/core';
import { ValidatorForm, TextValidator } from 'react-material-ui-form-validator';


import firebase from 'firebase/app';
import "firebase/analytics";

// Add the Firebase products that you want to use
import "firebase/auth";
import "firebase/firestore";
import { useDispatch } from 'react-redux';
import { authLogin } from '../../store/auth/actions';




export default function Register (){
    

    const dispatch = useDispatch();
    
    const [submitted, setSubmitted] = useState(false);
    const [credentials, setCredentials] = useState({
        name: '',
        email: '',
        password: '',
        repeatPassword: ''
    });

    const handleSubmit = () => {
        setSubmitted(true);
    }

    const handlerOnChangeField = (e) => {
        switch (e.target.name){
            case 'email':
                setCredentials({
                    ...credentials,
                    email: e.target.value
                })
                break;
            case 'password': 
                setCredentials({
                    ...credentials,
                    password: e.target.value
                })
            break;
            case 'name': 
                setCredentials({
                    ...credentials,
                    name: e.target.value
                })
            break;
            case 'repeatPassword': 
                setCredentials({
                    ...credentials,
                    repeatPassword: e.target.value
                })
            break;
        }
    }
    
    
    
    
    useEffect(() => {
        setTimeout(() => setSubmitted(false), 1000)
        if (!ValidatorForm.hasValidationRule('isPasswordMatch')) {
            ValidatorForm.addValidationRule('isPasswordMatch', (value) => {
                const {password} = credentials
                return value == password;
            });
        }

        return () => {
            if (ValidatorForm.hasValidationRule('isPasswordMatch')) {
                ValidatorForm.removeValidationRule('isPasswordMatch');
            }
          }
    })
   
    
    return (<ValidatorForm
        className="form_registre"
        //ref="/"
        onSubmit={handleSubmit}
    >
        <TextValidator
            className="form_registre__item"
            label="Имя"
            onChange={handlerOnChangeField}
            name="name"
            value={credentials.name}
            validators={['required']}
            errorMessages={['Поле обязательно для заполнения']}
        />
        <TextValidator
            className="form_registre__item"
            label="E-mail"
            onChange={handlerOnChangeField}
            name="email"
            value={credentials.email}
            validators={['required', 'isEmail']}
            errorMessages={['Поле обязательно для заполнения', 'Номер должен быть в фортмате +7(999) 999 99 99']}
        />
        <TextValidator
            className="form_registre__item"
            label="Пароль"
            onChange={handlerOnChangeField}
            name="password"
            type="password"
            value={credentials.password}
            validators={['required',]}
            errorMessages={['Укажите пароль' ]}
        />
        <TextValidator
            className="form_registre__item"
            label="Повторите пароль"
            onChange={handlerOnChangeField}
            name="repeatPassword"
            type="password"
            value={credentials.repeatPassword}
            validators={['isPasswordMatch', 'required']}
            errorMessages={['Пароли не совпадают','Поле обязательно для заполнения']}
        />
        <br />
        <Button
            className="form_registre__item"
            color="primary"
            variant="contained"
            type="submit"
            disabled={submitted}
        >
            {
                (submitted && 'Отправлено!')
                || (!submitted && 'Зарегистрироваться')
            }
        </Button>
    </ValidatorForm>)
            
}
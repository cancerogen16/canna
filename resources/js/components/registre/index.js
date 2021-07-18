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
        phone: '',
        password: '',
        repeatPassword: ''
    });

    const handleSubmit = () => {
        setSubmitted(true, () => {
            setTimeout(() => setSubmitted(false), 1000);
        })
        firebase.auth().c(credentials.email, credentials.password)
        .then((userCredential) => {
          
          var user = userCredential.user;
          //dispatch(authLogin(user.uid));
          console.log('sds',user.uid)
        })
        .catch((error) => {
            console.log(error)
          var errorCode = error.code;
          var errorMessage = error.message;
        
        });
    }

    const handlerOnChangeField = (e) => {
        switch (e.target.name){
            case 'phone':
                setCredentials({
                    ...credentials,
                    phone: e.target.value
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
            label="Телефон"
            onChange={handlerOnChangeField}
            name="phone"
            value={credentials.phone}
            validators={['required', 'matchRegexp:^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{5,6}$']}
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
            label="Повтоите пароль"
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
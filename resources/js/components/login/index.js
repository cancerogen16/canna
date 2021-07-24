import React, { useEffect, useState } from 'react'
import { Button} from '@material-ui/core';
import { ValidatorForm, TextValidator } from 'react-material-ui-form-validator';
import { useDispatch, useSelector } from 'react-redux';
import { authLogin } from '../../store/auth/actions';
import { Redirect } from 'react-router-dom';


export default function Login (){

    const dispatch = useDispatch();
    const auth = useSelector(state => state.auth);
    const [submitted, setSubmitted] = useState(false);

    const [credentials, setCredentials] = useState({
        email: '',
        password: '',
        remember: false,
        
    });
    useEffect(() => {
        setTimeout(() => setSubmitted(false), 1000)
    })
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
            case 'remember': 
                setCredentials({
                    ...credentials,
                    remember: !credentials.remember
                })
            break;
        }
    }
    
    if(auth.isAuthenticated){
        return <Redirect to={{
            pathname: '/profile',
        }}/>
    }

    return (
        <ValidatorForm 
            className='form_login'
            //ref="/"
            onSubmit={handleSubmit}
        >
            <TextValidator
                className="form_login__item"
                label="E-mail"
                onChange={handlerOnChangeField}
                name="email"
                value={credentials.email}
                type="email"
                //validators={['required', 'matchRegexp:^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{5,6}$']} Валидация по телефону, оставлена на будущие
                validators={['required', 'isEmail']}
                errorMessages={['Поле обязательно для заполнения', 'Некорректный e-mail']}
            />
            <br />
            <TextValidator
                className="form_login__item"
                label="Пароль"
                onChange={handlerOnChangeField}
                name="password"
                type="password"
                value={credentials.password}
                validators={['required']}
                errorMessages={['Поле обязательно для заполнения']}
            />
            <br />
            <Button
                className="form_login__item"
                color="primary"
                variant="contained"
                type="submit"
                disabled={submitted}
            >
                {
                    (submitted && 'Отправлено!')
                    || (!submitted && 'Войти')
                }
            </Button>
        </ValidatorForm>
    );
}
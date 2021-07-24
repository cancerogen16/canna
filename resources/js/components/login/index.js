import React from 'react'
import { Button} from '@material-ui/core';
import { ValidatorForm, TextValidator } from 'react-material-ui-form-validator';
import {useHukLogin} from '../../store/auth/huks/useHukLogin';


export default function Login (){

    
    

    const {
        handlerOnChangeField,
        credentials,
        setCredentials,
        handleSubmit,
        submitted,
        setSubmitted
    } = useHukLogin();

    

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
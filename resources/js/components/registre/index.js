import React from 'react'
import { Button } from '@material-ui/core';
import { TextValidator } from 'react-material-ui-form-validator';
import { useHukReg } from '../../store/auth/huks/useHukReg';




export default function Register (){
    

    const {
        handleSubmit,
        handlerOnChangeField,
        submitted,
        credentials,
        ValidatorForm
    } = useHukReg();
    
    return (
    <ValidatorForm
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
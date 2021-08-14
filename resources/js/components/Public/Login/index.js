import React from 'react'
import { Button} from '@material-ui/core';
import { ValidatorForm, TextValidator } from 'react-material-ui-form-validator';
import { useLogin } from './useLogin';
import { formLogin } from './style';



export default function Login (props){
    const classes = formLogin();
    const {
        handlerOnChangeField,
        credentials,
        handleSubmit,
        submitted,
    } = useLogin(props);

    
    return (
        <ValidatorForm 
            className={classes.root}
            onSubmit={handleSubmit}
        >
            <TextValidator
                className={classes.item}
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
                className={classes.item}
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
                className={classes.item}
                color="primary"
                variant="contained"
                type="submit"
            >
                Войти
            </Button>
        </ValidatorForm>
    );
}

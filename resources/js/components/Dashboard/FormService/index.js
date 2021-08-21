import React, { useRef } from 'react'
import { TextValidator, ValidatorForm } from 'react-material-ui-form-validator'
import { Dialog, Button, DialogContent, DialogContentText, DialogTitle, DialogActions, TextField } from '@material-ui/core'
import formService from './style';
import useFormService from './useFormService'

export default function FormService (props){
    const classes = formService();
    const {
        handlerOnChangeField,
        handleSubmit,
        submitted,
        credentials,
        open,
    } = props.useHuck
    return  <ValidatorForm
        className={classes.root}
        onSubmit={props.submit}
    >
        <TextValidator
            className={classes.item}
            label="Название услуги"
            onChange={handlerOnChangeField}
            name="title"
            value={credentials.title}
            validators={['required']}
            errorMessages={['Поле обязательно для заполнения']}
        />
        <TextValidator
            className={classes.item}
            label="Стоимость"
            onChange={handlerOnChangeField}
            name="price"
            value={credentials.price}
            validators={['required']}
            errorMessages={['Поле обязательно для заполнения']}
        />
        <TextValidator
            className={classes.item}
            label="Продолжительность"
            onChange={handlerOnChangeField}
            name="duration"
            value={credentials.duration}
            validators={['required']}
            errorMessages={['Поле обязательно для заполнения']}
        />

        <input
            type="file"
            name='photo'
            onChange={handlerOnChangeField}
        />
        <TextField
            className={classes.areal}
            label="Описание"
            name='description'
            multiline
            maxRows={4}
            value={credentials.description}
            onChange={handlerOnChangeField}
        />
        <br/>

        <Button
            className={classes.item}
            color="primary"
            variant="contained"
            type="submit"
        >
            Сохранить
        </Button>
        <Button
            onClick={props.close}
            className={classes.item}
            color="secondary"
            variant="contained"
        >
            Отмена
        </Button>
    </ValidatorForm>
}
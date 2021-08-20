import React from 'react'
import {TextValidator, ValidatorForm} from 'react-material-ui-form-validator'
import {Button, TextField} from '@material-ui/core'
import formMaster from './style';

export default function FormMaster(props) {
    const classes = formMaster();
    const {
        handlerOnChangeField,
        handleSubmit,
        submitted,
        credentials,
        open,
    } = props.useHuck
    return <ValidatorForm
        className={classes.root}
        onSubmit={props.submit}
    >
        <TextValidator
            className={classes.item}
            label="Имя"
            onChange={handlerOnChangeField}
            name="name"
            value={credentials.name}
            validators={['required']}
            errorMessages={['Поле обязательно для заполнения']}
        />
        <TextValidator
            className={classes.item}
            label="Должность"
            onChange={handlerOnChangeField}
            name="position"
            value={credentials.position}
            validators={['required']}
            errorMessages={['Поле обязательно для заполнения']}
        />
        <TextValidator
            className={classes.item}
            label="Опыт работы"
            onChange={handlerOnChangeField}
            name="experience"
            value={credentials.experience}
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
import React from 'react'
import {TextValidator, ValidatorForm} from 'react-material-ui-form-validator'
import {Button, Dialog, DialogContent, DialogTitle, TextField} from '@material-ui/core'
import formSalon from './style';
import useFormSalon from './useFormSalon'

export default function FormSalon(props) {
    const classes = formSalon()
    const {
        handlerOnChangeField,
        handleSubmit,
        submitted,
        credentials,
        open,
    } = useFormSalon(props)

    return (<Dialog
            open={open}
            aria-labelledby="alert-dialog-title"
            aria-describedby="alert-dialog-description"
        >
            <DialogTitle id="alert-dialog-title">Укажите информацию о своем салоне</DialogTitle>
            <DialogContent>
                <ValidatorForm
                    className={classes.root}
                    //ref="/"
                    onSubmit={handleSubmit}
                >
                    <TextValidator
                        className={classes.item}
                        label="Название салона"
                        onChange={handlerOnChangeField}
                        name="title"
                        value={credentials.title}
                        validators={['required']}
                        errorMessages={['Поле обязательно для заполнения']}
                    />
                    <TextValidator
                        className={classes.item}
                        label="Телефон"
                        onChange={handlerOnChangeField}
                        name="phone"
                        value={credentials.phone}
                        validators={['required']}
                        errorMessages={['Поле обязательно для заполнения']}
                    />
                    <TextValidator
                        className={classes.item}
                        label="Город"
                        onChange={handlerOnChangeField}
                        name="city"
                        value={credentials.city}
                        validators={['required']}
                        errorMessages={['Поле обязательно для заполнения']}
                    />
                    <TextValidator
                        className={classes.item}
                        label="Адрес"
                        onChange={handlerOnChangeField}
                        name="address"
                        value={credentials.address}
                        validators={['required',]}
                        errorMessages={['Поле обязательно для заполнения']}
                    />
                    <input
                        type="file"
                        name='main_photo'
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
                        disabled={submitted}
                    >
                        Сохранить
                    </Button>
                    <Button
                        onClick={() => props.history.push('/')}
                        className={classes.item}
                        color="secondary"
                        variant="contained"
                        disabled={submitted}
                    >
                        Отмена
                    </Button>
                </ValidatorForm>
            </DialogContent>

        </Dialog>

    )
}
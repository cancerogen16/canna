import React from 'react'
import { TextValidator, ValidatorForm } from 'react-material-ui-form-validator'
import { Dialog, Button, DialogContent, DialogContentText, DialogTitle, DialogActions, TextField } from '@material-ui/core'
import formMaster from './style';
import useFormMaster from './useFormMaster'

export default function FormMaster (props){
    const classes = formMaster()
    const {
        handlerOnChangeField,
        handleSubmit,
        submitted,
        credentials,
        open,
    } = useFormMaster(props)

    return  (<Dialog
            open={open}
            aria-labelledby="alert-dialog-title"
            aria-describedby="alert-dialog-description"
        >
            <DialogTitle id="alert-dialog-title">Укажите информацию о мастере</DialogTitle>
            <DialogContent>
                <ValidatorForm
                    className={classes.root}
                    //ref="/"
                    onSubmit={handleSubmit}
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
                        disabled={submitted}
                    >
                        Сохранить
                    </Button>
                    <Button
                        onClick={()=>  props.history.push('/')}
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
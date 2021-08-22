import React, {useState} from 'react'
import {TextValidator, ValidatorForm} from 'react-material-ui-form-validator'
import {Button, TextField, Typography} from '@material-ui/core'
import formService from './style';
import HTTP from "../../../utils/HTTP";


/*import React, { useRef } from 'react'
import { TextValidator, ValidatorForm } from 'react-material-ui-form-validator'
import { Dialog, Button, DialogContent, DialogContentText, DialogTitle, DialogActions, TextField } from '@material-ui/core'
import formService from './style';
import useFormService from './useFormService'*/

export default function FormService (props){
    const classes = formService();
    const {
        setImage,
        handlerOnChangeField,
        handleSubmit,
        submitted,
        credentials,
        open,
    } = props.useHuck;

    const [imagePreview, setImagePreview] = useState(credentials.photo);
    const [imageData, setImageData] = useState('');

    /* Отрисовка изображения для просмотра */
    const renderImage = (imageSrc) => {
        const src = imageSrc ? imageSrc : 'noimage.gif';

        return <img className="ava" src={'/images/origin/' + src} alt=""
                    style={{width: "100px", height: "100px"}}/>;
    };

    /* Выбор файла в поле name="image" */
    const handlerChangeImage = (files) => {
        if (files) {
            const image = files[0];

            setImageData(image);
        }
    }

    /* Загрузка изображения на сервер */
    const uploadImage = (e) => {
        e.preventDefault();

        const fData = new FormData();

        fData.append("image", imageData);

        HTTP.post('api/upload', fData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
            .then(res => {
                console.log("response", res);
                setImagePreview(res.data.image);
                setImage(res.data.image);
            })
            .catch(err => {
                console.error("Failure", err);
            })
    }


    return  <ValidatorForm
        className={classes.root}
        onSubmit={props.submit}
    >
        <TextValidator
            className={classes.item}
            label="Категория услуги"
            onChange={handlerOnChangeField}
            name="category_id"
            value={credentials.category_id}
            validators={['required']}
            errorMessages={['Поле обязательно для заполнения']}
        />
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

        <div className={classes.imageBox}>
            <Typography className={classes.imageBox__head}>
                Фото услуги
            </Typography>
            <div className={classes.imageBox__left}>
                <div className="result">{renderImage(imagePreview)}</div>
            </div>
            <div className={classes.imageBox__right}>
                <input
                    type="file"
                    name="image"
                    onChange={e => handlerChangeImage(e.target.files)}
                />
                <br/>
                <Button
                    onClick={uploadImage}
                    className={classes.uploadButton}
                    color="primary"
                    variant="contained"
                >
                    Загрузить изображение
                </Button>
            </div>
        </div>
        <TextField
            className={classes.areal}
            label="Краткое описание"
            name='excerpt'
            multiline
            maxRows={4}
            value={credentials.excerpt}
            onChange={handlerOnChangeField}
        />
        <br/>
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
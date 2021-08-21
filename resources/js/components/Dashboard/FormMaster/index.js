import React, {useState} from 'react'
import {TextValidator, ValidatorForm} from 'react-material-ui-form-validator'
import {Button, TextField, Typography} from '@material-ui/core'
import formMaster from './style';
import HTTP from "../../../utils/HTTP";

export default function FormMaster(props) {
    const [selectedImage, setSelectedImage] = useState('');
    const [imageData, setImageData] = useState('');

    /* Изменение значения в скрытом поле name="photo" */
    const setImage = (src, oldImage) => {
        return src ? src : oldImage;
    };

    /* Отрисовка изображения для просмотра */
    const renderImage = (src, oldImage) => {
        const newImage = src ? src : oldImage;

        return <img className="ava" src={'/images/origin/' + newImage} alt="" style={{width: "100px", height: "100px"}}/>;
    };

    /* Выбор файла в поле name="image" */
    const handlerChangeImage = (files) => {
        setSelectedImage('');

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
                setSelectedImage(res.data.image);

            })
            .catch(err => {
                console.error("Failure", err);
            })
    }

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
        <div className={classes.imageBox}>
            <Typography className={classes.imageBox__head}>
                Фото
            </Typography>
            <div className={classes.imageBox__left}>
                <TextField
                    name="photo"
                    type="hidden"
                    value={setImage(selectedImage, credentials.photo)}
                    onChange={handlerOnChangeField}
                />
                <div className="result">{renderImage(selectedImage, credentials.photo)}</div>
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
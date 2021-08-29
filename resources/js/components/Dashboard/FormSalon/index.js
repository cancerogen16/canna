import React, {useState} from 'react'
import { TextValidator, ValidatorForm } from 'react-material-ui-form-validator'
import { Dialog, Button, DialogContent, DialogContentText, DialogTitle, DialogActions, TextField } from '@material-ui/core'
import formSalon from './style';
import useFormSalon from './useFormSalon'
import HTTP from "../../../utils/HTTP";
export default function FormSalon (props){
    const classes = formSalon()
    const {
        setImage,
        handlerOnChangeField,
        handleSubmit,
        submitted,
        credentials,
        open,
    } = useFormSalon(props)

    const [imagePreview, setImagePreview] = useState(credentials.main_photo);
    const [imageData, setImageData] = useState('');

    /* Отрисовка изображения для просмотра */
    const renderImage = (imageSrc) => {
        let src = imageSrc ? imageSrc : 'noimage.gif';
        if (src.indexOf('http') === -1) {
            src = '/images/origin/' + src;
        }

        return <img className="ava" src={src} alt=""
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

    return  (<Dialog
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
                        errorMessages={['Поле обязательно для заполнения' ]}
                    />
                    <div className={classes.imageBox}>
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
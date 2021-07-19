import React, { useState } from 'react'
import { Button} from '@material-ui/core';
import { ValidatorForm, TextValidator } from 'react-material-ui-form-validator';



import firebase from 'firebase/app';
import "firebase/analytics";

// Add the Firebase products that you want to use
import "firebase/auth";
import "firebase/firestore";
import { useDispatch, useSelector } from 'react-redux';
import { authLogin } from '../../store/auth/actions';
import { Redirect } from 'react-router-dom';
import { editProfile } from '../../store/profile/action';



var firebaseConfig = {
    apiKey: "AIzaSyBwf9H3J5uI3W_WGpKcM8le2XDbwBOl9tc",
    authDomain: "test-5b0ea.firebaseapp.com",
    projectId: "test-5b0ea",
    storageBucket: "test-5b0ea.appspot.com",
    messagingSenderId: "964341762176",
    appId: "1:964341762176:web:15d74d02c7b86236623e65",
    measurementId: "G-25CTYC0L3B",
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();


export default function Login (){

    const dispatch = useDispatch();
    const auth = useSelector(state => state.auth);
    const [submitted, setSubmitted] = useState(false);

    const [credentials, setCredentials] = useState({
        phone: '',
        password: '',
        remember: false,
        
    });

    const handleSubmit = () => {
        setSubmitted(true, () => {
            setTimeout(() => setSubmitted(false), 1000);
        })
        firebase.auth().signInWithEmailAndPassword(credentials.phone, credentials.password)
        .then((userCredential) => {
          
          var user = userCredential.user;
          dispatch(authLogin(user.uid));
          console.log(user);
          dispatch(editProfile(user.email, user.uid));
        })
        .catch((error) => {
            console.log(error)
          var errorCode = error.code;
          var errorMessage = error.message;
        });
    }

    const handlerOnChangeField = (e) => {
        switch (e.target.name){
            case 'phone':
                setCredentials({
                    ...credentials,
                    phone: e.target.value
                })
                break;
            case 'password': 
                setCredentials({
                    ...credentials,
                    password: e.target.value
                })
            break;
            case 'remember': 
                setCredentials({
                    ...credentials,
                    remember: !credentials.remember
                })
            break;
        }
    }
    
    if(auth.isAuthenticated){
        return <Redirect to={{
            pathname: '/profile',
        }}/>
    }

    return (
        <ValidatorForm 
            className='form_login'
            //ref="/"
            onSubmit={handleSubmit}
        >
            <TextValidator
                className="form_login__item"
                label="Телефон"
                onChange={handlerOnChangeField}
                name="phone"
                value={credentials.phone}
                validators={['required', 'matchRegexp:^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{5,6}$']}
                errorMessages={['Поле обязательно для заполнения', 'Номер должен быть в фортмате +7(999) 999 99 99']}
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
                    (submitted && 'Отправленно!')
                    || (!submitted && 'Войти')
                }
            </Button>
        </ValidatorForm>
    );
}
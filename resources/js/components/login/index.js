import React, { useState } from 'react'
import { Button, Checkbox, FormControlLabel, TextField } from '@material-ui/core';
import PropTypes from 'prop-types'
import { Validator } from 'ree-validate'


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

    const validator = new Validator({
        email: 'required|email',
        password: 'required|min:6'
      }) 

    const dispatch = useDispatch();
    const auth = useSelector(state => state.auth);
    

    const [credentials, setCredentials] = useState({
        phone: '',
        password: '',
        remember: false,
    });

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
    const click = () => {



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
    
    if(auth.isAuthenticated){
        return <Redirect to={{
            pathname: '/profile',
        }}/>
    }
    
    return (<form className="form_login">
                <TextField id="filled-basic" onChange={handlerOnChangeField} type="phone"  label="Телефон" name="phone" variant="filled" />
                <TextField id="filled-basic" onChange={handlerOnChangeField} type="password"  label="Пароль" name="password" variant="filled" />
                <FormControlLabel control={<Checkbox onChange={handlerOnChangeField} name="remember" checked={credentials.remember} color="primary" />} label="Запомнить" />
                <Button variant="contained" onClick={click} color="primary">Войти</Button>
            </form>)
}
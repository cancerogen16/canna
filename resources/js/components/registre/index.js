import React, { useState } from 'react'
import { Button, Checkbox, FormControl, FormControlLabel, InputLabel, Select, TextField } from '@material-ui/core';


import firebase from 'firebase/app';
import "firebase/analytics";

// Add the Firebase products that you want to use
import "firebase/auth";
import "firebase/firestore";
import { useDispatch } from 'react-redux';
import { authLogin } from '../../store/auth/actions';



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


export default function Register (){

    const dispatch = useDispatch();
    

    const [credentials, setCredentials] = useState({
        type: 'salon',
        lastName: '',
        firstName: '',
        phone: '',
        email: '',
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
            case 'last-name': 
                setCredentials({
                    ...credentials,
                    lastName: e.target.value
                })
            break;
            case 'first-name': 
                setCredentials({
                    ...credentials,
                    firstName: e.target.value
                })
            break;
            case 'email': 
                setCredentials({
                    ...credentials,
                    email: e.target.value
                })
            break;
            case 'type': 
                console.log(e.target);
                setCredentials({
                    ...credentials,
                    type: e.target.value
                })
            break;
        }
    }
    const click = () => {

        

        firebase.auth().createUserWithEmailAndPassword(credentials.email, credentials.password)
        .then((userCredential) => {
          
          var user = userCredential.user;
          //dispatch(authLogin(user.uid));
          console.log('sds',user.uid)
        })
        .catch((error) => {
            console.log(error)
          var errorCode = error.code;
          var errorMessage = error.message;
          // ..
        });
    }
    
    
    return (<form className="form_registre">
                {console.log(credentials)}
                <FormControl variant="filled">
                <InputLabel htmlFor="filled-age-native-simple">Тип регистрации</InputLabel>
                <Select
                    native
                    value={credentials.type}
                    name="type"
                    onChange={handlerOnChangeField}
                    >
                    <option value={'salon'}>Салон</option>
                    <option value={'master'}>Частный мастер</option>
                </Select>
                </FormControl>
                {credentials.type == 'salon'? 
                    <TextField id="filled-basic" onChange={handlerOnChangeField}   label="Название салона" name="phone" variant="filled" />:
                     null
                }
                <TextField id="filled-basic" onChange={handlerOnChangeField}   label="Фамилия" name="last-name" variant="filled" />
                <TextField id="filled-basic" onChange={handlerOnChangeField}   label="Имя" name="first-name" variant="filled" />
                <TextField id="filled-basic" onChange={handlerOnChangeField}   label="Телефон" name="phone" variant="filled" />
                <TextField id="filled-basic" onChange={handlerOnChangeField}   label="E-mail" name="email" variant="filled" />
                <TextField id="filled-basic" onChange={handlerOnChangeField}  label="Пароль" name="password" variant="filled" />
                <Button variant="contained" onClick={click} color="primary">Зарегистрировать</Button>
            </form>)
}
import React, { useState } from 'react'
import { Button, Checkbox, FormControl, FormControlLabel, InputLabel, Select, TextField } from '@material-ui/core';


import firebase from 'firebase/app';
import "firebase/analytics";

// Add the Firebase products that you want to use
import "firebase/auth";
import "firebase/firestore";
import { useDispatch } from 'react-redux';
import { authLogin } from '../../store/auth/actions';



// var firebaseConfig = {
//     apiKey: "AIzaSyBwf9H3J5uI3W_WGpKcM8le2XDbwBOl9tc",
//     authDomain: "test-5b0ea.firebaseapp.com",
//     projectId: "test-5b0ea",
//     storageBucket: "test-5b0ea.appspot.com",
//     messagingSenderId: "964341762176",
//     appId: "1:964341762176:web:15d74d02c7b86236623e65",
//     measurementId: "G-25CTYC0L3B",
//   };
//   // Initialize Firebase
//   firebase.initializeApp(firebaseConfig);
//   firebase.analytics();


export default function Register (){

    const dispatch = useDispatch();
    

    const [credentials, setCredentials] = useState({
        name: '',
        phone: '',
        password: '',
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
            case 'name': 
                setCredentials({
                    ...credentials,
                    name: e.target.value
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
                <TextField id="filled-basic" onChange={handlerOnChangeField}   label="Имя" name="name" variant="filled" />
                <TextField id="filled-basic" onChange={handlerOnChangeField}   label="Телефон" name="phone" variant="filled" />
                <TextField id="filled-basic" onChange={handlerOnChangeField}  label="Пароль" name="password" variant="filled" />
                <TextField id="filled-basic" onChange={handlerOnChangeField}  label="Повторите пароль" name="password" variant="filled" />
                <Button variant="contained" onClick={click} color="primary">Зарегистрировать</Button>
            </form>)
}
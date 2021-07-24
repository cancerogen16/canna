import React, { useEffect, useState } from 'react'
import { useDispatch, useSelector } from 'react-redux';
import { authLogin } from '../actions';

export const useHukLogin = () => {
    const [submitted, setSubmitted] = useState(false);
    const [credentials, setCredentials] = useState({
        email: '',
        password: '',
        remember: false,
        
    });
    const dispatch = useDispatch();
    const auth = useSelector(state => state.auth);

    useEffect(() => {
        setTimeout(() => setSubmitted(false), 1000)
    })
    const handleSubmit = () => {
        setSubmitted(true);
    }

    const handlerOnChangeField = (e) => {
        switch (e.target.name){
            case 'email':
                setCredentials({
                    ...credentials,
                    email: e.target.value
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

    return { 
            handlerOnChangeField,
            handleSubmit,
            credentials,
            setCredentials,
            submitted,
            setSubmitted
        }
}
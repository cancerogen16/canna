import { useEffect, useState } from 'react'
import { useDispatch } from 'react-redux';
import { ValidatorForm, TextValidator } from 'react-material-ui-form-validator';

export const useHukReg = () => {
    const dispatch = useDispatch();
    
    const [submitted, setSubmitted] = useState(false);
    const [credentials, setCredentials] = useState({
        name: '',
        email: '',
        password: '',
        repeatPassword: ''
    });

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
            case 'name': 
                setCredentials({
                    ...credentials,
                    name: e.target.value
                })
            break;
            case 'repeatPassword': 
                setCredentials({
                    ...credentials,
                    repeatPassword: e.target.value
                })
            break;
        }
    }
    
    
    
    
    useEffect(() => {
        setTimeout(() => setSubmitted(false), 1000)
        if (!ValidatorForm.hasValidationRule('isPasswordMatch')) {
            ValidatorForm.addValidationRule('isPasswordMatch', (value) => {
                const {password} = credentials
                return value == password;
            });
        }

        return () => {
            if (ValidatorForm.hasValidationRule('isPasswordMatch')) {
                ValidatorForm.removeValidationRule('isPasswordMatch');
            }
          }
    })
    
    return {
        handlerOnChangeField,
        handleSubmit,
        submitted,
        credentials,
        ValidatorForm
    }
}
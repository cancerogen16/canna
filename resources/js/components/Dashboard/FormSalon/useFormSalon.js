import { useEffect, useState } from 'react'
import { useDispatch, useSelector } from 'react-redux';
import { ValidatorForm } from 'react-material-ui-form-validator';
import { fetchRegistre } from '../../../store/auth/thunks';
import { fetchCreateSalon, fetchSalonByUserId } from '../../../store/salon/thunks';
import { Route, Redirect } from 'react-router-dom'
import { updateSalonUserFetch } from '../../../store/user/thunks';



export default function useFormSalon(props){
    const dispatch = useDispatch();
    const [submitted, setSubmitted] = useState(false);
    const [open, setOpen] = useState(true);
    const user = useSelector(state => state.user);
    const [credentials, setCredentials] = useState({
        user_id: user.id,
        title: '', 
        city: '', 
        address: '', 
        phone: '',
        description: '' 
    });

    const handleSubmit = (props) => {
        dispatch(fetchCreateSalon(credentials));
        setSubmitted(true);
        setOpen(false);
    }

    

    const handlerOnChangeField = (e) => {
        switch (e.target.name){
            case 'title':
                setCredentials({
                    ...credentials,
                    title: e.target.value
                })
                break;
            case 'city': 
                setCredentials({
                    ...credentials,
                    city: e.target.value
                })
            break;
            case 'address': 
                setCredentials({
                    ...credentials,
                    address: e.target.value
                })
            break;
            case 'phone': 
                setCredentials({
                    ...credentials,
                    phone: e.target.value
                })
                break;
            case 'description': 
            setCredentials({
                ...credentials,
                description: e.target.value
            })
            break;
        }
    }
    
    
    
    
   
    
    return {
        handlerOnChangeField,
        handleSubmit,
        submitted,
        credentials,
        open,
        //ValidatorForm
    }
}
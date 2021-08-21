import {useState} from 'react'
import {useDispatch, useSelector} from 'react-redux';
import {fetchCreateService, fetchUpdateService} from '../../../store/service/thunks';

export default function useFormService(props) {
    const dispatch = useDispatch();
    const [submitted, setSubmitted] = useState(false);
    const [open, setOpen] = useState(false);
    const salon = useSelector(state => state.salon);
    const [update, setUpdate] = useState(false);

    const [credentials, setCredentials] = useState({
        salon_id: salon.id,
        id:'',
        title: '',
        price: '',
        duration: '',
        description: '',
        //photo: []
    });

    const handleSubmit = (e, callback) => {

        const form = new FormData(e.target.form);
        form.append('salon_id', credentials.salon_id);
        form.append('title', credentials.title)
        form.append('price', credentials.price)
        form.append('duration', credentials.duration)
        form.append('description', credentials.description)
        form.append('photo', credentials.photo)

        if(update) {
            dispatch(fetchUpdateService(credentials.id,form));
        }else{
            dispatch(fetchCreateService(form));
        }

        setSubmitted(true);
        setOpen(false);
        callback()
    }

    const handlerOnChangeField = (e) => {
        setCredentials({
            ...credentials,
            salon_id: salon.id
        })
        switch (e.target.name) {
            case 'title':
                setCredentials({
                    ...credentials,
                    title: e.target.value
                })
                break;
            case 'price':
                setCredentials({
                    ...credentials,
                    price: e.target.value
                })
                break;
            case 'duration':
                setCredentials({
                    ...credentials,
                    duration: e.target.value
                })
                break;
            case 'description':
                setCredentials({
                    ...credentials,
                    description: e.target.value
                })
                break;
            case 'photo':
                setCredentials({
                    ...credentials,
                    photo: e.target.files[0]
                })
                break;
        }
    }

    const openModal = (service, callback) => {
        setOpen(!open);
        setCredentials({...credentials, ...service});
        callback();
    }

    const closeModal = () => {
        setOpen(!open);
        setUpdate(false);
        setCredentials({ salon_id: salon.id,
            title: '',
            price: '',
            duration: '',
            description: '',
            photo: []});
    }

    return {
        handlerOnChangeField,
        handleSubmit,
        setCredentials,
        openModal,
        closeModal,
        setUpdate,
        submitted,
        credentials,
        open
    }
}
import {useState} from 'react'
import {useDispatch, useSelector} from 'react-redux';
import {fetchCreateMaster, fetchUpdateMaster} from '../../../store/master/thunks';

export default function useFormMaster(props) {
    const dispatch = useDispatch();
    const [submitted, setSubmitted] = useState(false);
    const [open, setOpen] = useState(false);
    const salon = useSelector(state => state.salon);
    const [update, setUpdate] = useState(false);

    const [credentials, setCredentials] = useState({
        salon_id: salon.id,
        id: '',
        name: '',
        position: '',
        experience: '',
        description: '',
        photo: ''
    });

    /* Изменение изображения */
    const setImage = (newImage) => {
        setCredentials({
            ...credentials,
            photo: newImage
        });
    };

    const handleSubmit = (e, callback) => {

        const form = new FormData(e.target.form);
        form.append('salon_id', credentials.salon_id);
        form.append('name', credentials.name)
        form.append('position', credentials.position)
        form.append('experience', credentials.experience)
        form.append('description', credentials.description)
        form.append('photo', credentials.photo)

        if (update) {
            dispatch(fetchUpdateMaster(credentials.id, form));
        } else {
            dispatch(fetchCreateMaster(form));
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
            case 'name':
                setCredentials({
                    ...credentials,
                    name: e.target.value
                })
                break;
            case 'position':
                setCredentials({
                    ...credentials,
                    position: e.target.value
                })
                break;
            case 'experience':
                setCredentials({
                    ...credentials,
                    experience: e.target.value
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
                    photo: e.target.value
                })
                break;
        }
    }

    const openModal = (master, callback) => {
        setOpen(!open);
        setCredentials({...credentials, ...master});
        callback();
    }

    const closeModal = () => {
        setOpen(!open);
        setUpdate(false);
        setCredentials({
            salon_id: salon.id,
            name: '',
            position: '',
            experience: '',
            description: '',
            photo: ''
        });
    }

    return {
        setImage,
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
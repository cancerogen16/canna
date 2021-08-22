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
        id: '',
        category_id: '',
        title: '',
        price: '',
        duration: '',
        excerpt: '',
        description: '',
        image: ''
    });

    /* Изменение изображения */
    const setImage = (newImage) => {
        setCredentials({
            ...credentials,
            image: newImage
        });
    };

    const handleSubmit = (e, callback) => {

        const form = new FormData(e.target.form);
        form.append('salon_id', credentials.salon_id);
        form.append('category_id', credentials.category_id);
        form.append('title', credentials.title);
        form.append('price', credentials.price);
        form.append('duration', credentials.duration);
        form.append('excerpt', credentials.excerpt);
        form.append('description', credentials.description);
        form.append('image', credentials.image);

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
            case 'category_id':
                setCredentials({
                    ...credentials,
                    category_id: e.target.value
                })
                break;
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
            case 'excerpt':
                setCredentials({
                    ...credentials,
                    excerpt: e.target.value
                })
                break;
            case 'description':
                setCredentials({
                    ...credentials,
                    description: e.target.value
                })
                break;
            case 'image':
                setCredentials({
                    ...credentials,
                    image: e.target.files[0]
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
            id: '',
            category_id: '',
            title: '',
            price: '',
            duration: '',
            excerpt: '',
            description: '',
            image: []});
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
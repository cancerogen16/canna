import {useState} from 'react'
import {useDispatch, useSelector} from 'react-redux';
import {fetchCreateSalon} from '../../../store/salon/thunks';

export default function useFormSalon(props) {
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
        description: '',
        main_photo: []
    });

    const handleSubmit = (e) => {
        const form = new FormData(e.target.form);
        form.append('user_id',credentials.user_id);
        form.append('title', credentials.title)
        form.append('city', credentials.city)
        form.append('phone', credentials.phone)
        form.append('address', credentials.address)
        form.append('description', credentials.description)
        form.append('main_photo', credentials.main_photo)
        console.log(e.target.form)

        dispatch(fetchCreateSalon(form));
        setSubmitted(true);
        setOpen(false);
    }

    const handlerOnChangeField = (e) => {
        switch (e.target.name) {
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
            case 'main_photo':
                setCredentials({
                    ...credentials,
                    main_photo: e.target.files[0]
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
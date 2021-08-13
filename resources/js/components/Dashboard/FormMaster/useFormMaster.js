import {useState} from 'react'
import {useDispatch, useSelector} from 'react-redux';
import {fetchCreateMaster} from '../../../store/master/thunks';

export default function useFormMaster(props) {
    const dispatch = useDispatch();
    const [submitted, setSubmitted] = useState(false);
    const [open, setOpen] = useState(true);
    const salon = useSelector(state => state.salon);
    const [credentials, setCredentials] = useState({
        salon_id: salon.id,
        name: '',
        position: '',
        experience: '',
        description: '',
        photo: []
    });

    const handleSubmit = (e) => {
        const form = new FormData(e.target.form);
        form.append('salon_id',credentials.salon_id);
        form.append('name', credentials.name)
        form.append('position', credentials.position)
        form.append('experience', credentials.experiencee)
        form.append('description', credentials.description)
        form.append('photo', credentials.photo)
        console.log(e.target.form)

        dispatch(fetchCreateMaster(form));
        setSubmitted(true);
        setOpen(false);
    }

    const handlerOnChangeField = (e) => {
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
                    photo: e.target.files[0]
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
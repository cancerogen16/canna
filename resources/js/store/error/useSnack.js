
import { useSnackbar } from 'notistack';
import { useDispatch } from 'react-redux';
import { delError } from './action';



export function useSnack() {
    const dispatch = useDispatch();
    const { enqueueSnackbar, closeSnackbar } = useSnackbar();
    const snack = (message, variant = null, key ) => {
        enqueueSnackbar(message, {variant, key});
        dispatch(delError(key - 1));
    }

    return {
        snack
    }
}
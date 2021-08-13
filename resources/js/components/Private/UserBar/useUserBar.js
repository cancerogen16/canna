import {useDispatch, useSelector} from "react-redux"
import {fetchLogout} from "../../../store/auth/thunks";

export const useUserBar = () => {
    const dispatch = useDispatch();
    const user = useSelector(state => state.user);

    const handleLogout = () => {
        dispatch(fetchLogout())
    }

    return {
        user,
        handleLogout
    }
}
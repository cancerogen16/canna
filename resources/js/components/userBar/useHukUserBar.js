import { useDispatch, useSelector } from "react-redux"
import { authLogout } from "../../store/auth/actions";

export const useHukUserBar = () => {

    const dispatch = useDispatch();
    const profile = useSelector(state => state.profile);

    const handleLogout = () => {
        dispatch(authLogout())
    }

    return {
        profile,
        handleLogout
    }
}
import { LaptopWindows } from "@material-ui/icons";
import { useDispatch, useSelector } from "react-redux"
import { fetchLogout } from "../../store/auth/actions";
import HTTP from "../../store/HTTP";

export const useHukUserBar = () => {
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
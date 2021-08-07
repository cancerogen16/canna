import { CLEAR_USER, SET_USER, UPDATE_SALON_USER } from "./action-types";

export const setUser = ({id ,name, email, role_id}) => ({
    type: SET_USER,
    id,
    name,
    email,
    role_id
});

export const updateSalonUser = (salon) => ({
    type: UPDATE_SALON_USER,
    salon
});

export const clearUser = () => ({
    type: CLEAR_USER,
});




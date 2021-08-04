import { update } from 'lodash';
import HTTP from '../HTTP';
export const SET_USER = 'USER::SET_USER';
export const CLEAR_USER = 'USER::CLEAR_USER';
export const UPDATE_SALON_USER = 'USER::UPDATE_SALON_USER'

export const setUserWithThunk = (user) => (dispach, getState) => {
    console.log(user);
    dispach(setUser(user));
    

}
export const updateSalonUserFetch = (user_id) => (dispach, getState) => {
    HTTP.get(`api/users/${user_id}/salons`)
    .then(res => dispach(updateSalonUser(res.data.salons[0].id)))

}

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


// export const fetchProfileWithThunk = () => (dispatch, getState) => {
//             fetch("https://reqres.in/api/users?id=2").then(res => res.json()).then(res => {
//                 dispatch(editProfile( res.data.first_name, res.data.last_name, res.data.email ))
//             })
//         }


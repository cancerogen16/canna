import HTTP from '../../utils/HTTP';
import {setUser, updateSalonUser} from './action';

export const setUserWithThunk = (user) => (dispach, getState) => {
    dispach(setUser(user));
}

export const updateSalonUserFetch = (user_id) => (dispach, getState) => {
    HTTP.get(`api/users/${user_id}/salons`)
        .then(res => {
            dispach(updateSalonUser(res.data.salons[0].id))
        })
}
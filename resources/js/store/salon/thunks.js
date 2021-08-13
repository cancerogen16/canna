import HTTP from '../../utils/HTTP';
import {updateSalonUser} from '../user/action';
import {addSalon, clearSalon} from './action';
import {addMasters} from "../master/action";

export const fetchCreateSalon = (form) => (dispatch, getState) => {
    HTTP.post('api/salons', form, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
        .then(res => {
            const salon = res.data.salon;
            dispatch(addSalon(salon));
            dispatch(updateSalonUser(salon.id));
        })
}

export const fetchSalonByUserId = (user_id) => (dispatch, getState) => {
    HTTP.get(`api/users/${user_id}/salons`)
        .then(res => dispatch(addSalon(res.data.salons[0])))
}

export const fetchSalonsOneId = (id) => (dispatch, getState) => {
    HTTP.get(`/api/salons/${id}`)
        .then(res => {
            if (res.data.code) {
                dispatch(clearSalon())
            } else {
                console.log('sad', res)
                dispatch(addSalon(res.data.salon))
            }
        });
}

export const fetchSalonInfo = (id) => (dispatch, getState) => {
    HTTP.get(`/api/salons/${id}/info`)
        .then(res => {
            if (res.data.code) {
                dispatch(clearSalon())
            } else {
                console.log('sad', res)
                dispatch(addSalon(res.data.salon));
                dispatch(addMasters(res.data.salon.masters));
            }
        });
}

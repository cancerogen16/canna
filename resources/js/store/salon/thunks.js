import HTTP from '../../utils/HTTP';
import { addSalon } from './action';

export const fetchCreateSalon = (salons) => (dispatch, getState) => {

    HTTP.post('api/salons', salons)
    .then(res => console.log(res))

}


export const fetchSalonsOneId = (id) => (dispatch, getState) => {

    HTTP.get(`/api/salons/${id}`)
    .then(res => {
        dispatch(addSalon(res.data.salon))
    });

}

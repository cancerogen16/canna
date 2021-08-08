import HTTP from '../../utils/HTTP';
import { updateSalonUser } from '../user/action';
import { addSalon, clearSalon } from './action';

export const fetchCreateSalon = (salons) => (dispatch, getState) => {

    HTTP.post('api/salons', salons)
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
        if(res.data.code){
            dispatch(clearSalon())
        }else{
            console.log('sad',res)
            dispatch(addSalon(res.data.salon))
        }
        
    });

}

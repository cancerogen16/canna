import HTTP from '../../utils/HTTP';
import { addMasters } from './action';
import {updateMasterSalon} from "../salon/action";

export const fetchMasters = (salon_id) => (dispach, getState) => {

    HTTP.get('/api/masters')
    .then(res => dispach(addMasters(res.data.masters)) )

}

export const fetchMastersOfSalon = (salon_id) => (dispach, getState) => {

    HTTP.get(`/api/salons/${salon_id}/masters`)
    .then(res => dispach(addMasters(res.data.masters)) )
    
}

export const fetchCreateMaster = (form) => (dispatch, getState) => {
    HTTP.post('api/masters', form, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
        .then(res => {
            const master = res.data.master;
            dispatch(addMasters(master));
            dispatch(updateMasterSalon(master.id));
        })
}
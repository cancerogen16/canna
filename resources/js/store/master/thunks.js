import HTTP from '../../utils/HTTP';
import {addMasters} from './action';

export const fetchMasters = (salon_id) => (dispach, getState) => {

    HTTP.get('/api/masters')
        .then(res => dispach(addMasters(res.data.masters)))

}

export const fetchMastersOfSalon = (salon_id) => (dispach, getState) => {

    HTTP.get(`/api/salons/${salon_id}/masters`)
        .then(res => dispach(addMasters(res.data.masters)))

}
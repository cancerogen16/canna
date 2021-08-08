import HTTP from '../../utils/HTTP';
import { addMasters, addServices } from './action';

export const fetchServices = () => (dispach, getState) => {

    HTTP.get('/api/services')
    .then(res => dispach(addServices(res.data.services)) )

}

export const fetchServicesByMasterId = (master_id) => (dispach, getState) => {

    HTTP.get(`/api/services/${master_id}/masters`)
    .then(res => console.log(res) )

}

export const fetchServicesBySalonId = (salon_id) => (dispach, getState) => {

    HTTP.get(`/api/salons/${salon_id}/services`)
    .then(res => dispach(addServices(res.data.services)))

}

export const fetchServicesOfSalon = (salon_id) => (dispach, getState) => {

    HTTP.get(`/api/salons/${salon_id}/masters`)
    .then(res => dispach(addServices(res.data.services)) )
    
}
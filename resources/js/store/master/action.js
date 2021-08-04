import { Http } from "@material-ui/icons";

export const ADD_MASTERS = 'MASTER::ADD_MASTERS';
export const CLEAR_MASTER = 'MASTER::CLEAR_MASTER';
export const DELETE_MASTER = 'MASTER::CLEAR_MASTER';
import HTTP from '../HTTP';


export const fetchMasters = (salon_id) => (dispach, getState) => {
    HTTP.get('/api/masters')
    .then(res => dispach(addMasters(res.data.masters)) )

}

export const fetchMastersOfSalon = (salon_id) => (dispach, getState) => {
    HTTP.get(`/api/salons/${salon_id}/masters`)
    .then(res => dispach(addMasters(res.data.masters)) )
    

}


export const addMasters = (masters) => ({
    type: ADD_MASTERS,
    masters
    
});

export const delMaster = (id) => ({
    type: DELETE_MASTER,
    id
});

export const clearMaster = () => ({
    type: CLEAR_MASTER,
});


// export const fetchProfileWithThunk = () => (dispatch, getState) => {
//             fetch("https://reqres.in/api/users?id=2").then(res => res.json()).then(res => {
//                 dispatch(editProfile( res.data.first_name, res.data.last_name, res.data.email ))
//             })
//         }


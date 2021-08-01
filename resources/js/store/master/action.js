import { Http } from "@material-ui/icons";

export const ADD_MASTER = 'MASTER::ADD_MASTER';
export const CLEAR_MASTER = 'MASTER::CLEAR_MASTER';
export const DELETE_MASTER = 'MASTER::CLEAR_MASTER';
import HTTP from '../HTTP';


export const fetchMasters = (salon_id) => (dispach, getState) => {
    HTTP.get('/')
    localStorage.setItem('user', JSON.stringify(user));

}

export const fetchMastersOfSalon = (salon_id) => (dispach, getState) => {
    HTTP.get('/')
    localStorage.setItem('user', JSON.stringify(user));

}


export const addMaster = ({id, salon_id, name, slug, position, photo, experience, description, rating}) => ({
    type: ADD_MASTER,
    id,
    salon_id,
    name,
    slug,
    position,
    photo,
    experience,
    description,
    rating
    
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


import { Http } from "@material-ui/icons";

export const ADD_ACTION = 'ACTION::ADD_ACTION';
export const CLEAR_ACTION = 'ACTION::CLEAR_ACTION';
export const DELETE_ACTION = 'ACTION::CLEAR_ACTION';
import HTTP from '../HTTP';


export const fetchActions = (salon_id) => (dispach, getState) => {
    HTTP.get('/')
    localStorage.setItem('user', JSON.stringify(user));

}

export const fetchActionsOfSalon = (salon_id) => (dispach, getState) => {
    HTTP.get('/')
    localStorage.setItem('user', JSON.stringify(user));

}


export const addAction = ({id, salon_id, name, photo, description, price, start_at, end_at}) => ({
    type: ADD_ACTION,
    id,
    salon_id,
    name,
    photo,
    description,
    price,
    start_at,
    end_at

});

export const delAction = (id) => ({
    type: DELETE_ACTION,
    id
});

export const clearAction = () => ({
    type: CLEAR_ACTION,
});


// export const fetchProfileWithThunk = () => (dispatch, getState) => {
//             fetch("https://reqres.in/api/users?id=2").then(res => res.json()).then(res => {
//                 dispatch(editProfile( res.data.first_name, res.data.last_name, res.data.email ))
//             })
//         }


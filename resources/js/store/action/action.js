import {ADD_ACTION, CLEAR_ACTION, DELETE_ACTION} from "./action-types";

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





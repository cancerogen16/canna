import {ADD_MASTER, CLEAR_MASTER, DELETE_MASTER} from "./action-types";

export const addMaster = ({ salon_id, name, slug, position, photo, experience, description, rating}) => ({
    type: ADD_MASTER,
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




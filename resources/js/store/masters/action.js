import {ADD_ALL_MASTERS, ADD_ONE_MASTER, CLEAR_MASTERS, UPDATE_MASTER, DELETE_MASTER} from "./action-types";

export const addMastersAll = (masters) => ({
    type: ADD_ALL_MASTERS,
    masters
});

export const addMasterOne = ({salon_id, id, name, slug, position, photo, thumb, experience, description, rating}) => ({
    type: ADD_ONE_MASTER,
    id,
    salon_id,
    name,
    slug,
    position,
    photo,
    thumb,
    experience,
    description,
    rating
});

export const clearMaster = () => ({
    type: CLEAR_MASTERS,
});

export const updateMaster = (master) => ({
    type: UPDATE_MASTER,
    master
});

export const delMaster = (id) => ({
    type: DELETE_MASTER,
    id
});




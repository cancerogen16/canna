import { ADD_ALL_MASTERS, ADD_ONE_MASTER, CLEAR_MASTERS, DELETE_MASTER } from "./action-types";

export const addMastersAll = (masters) => ({

    type: ADD_ALL_MASTERS,
    masters
    
});

export const addMasterOne = ({ salon_id, id, name, slug, position, photo, experience, description, rating}) => ({
    type: ADD_ONE_MASTER,
    id,
    salon_id,
    name, 
    slug, 
    position, 
    photo, 
    experience, 
    description, 
    rating
})

export const delMaster = (id) => ({
    type: DELETE_MASTER,
    id
});

export const clearMaster = () => ({

    type: CLEAR_MASTERS,

});




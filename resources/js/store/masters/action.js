import { ADD_ALL_MASTERS, ADD_ONE_MASTER, CLEAR_MASTERS } from "./action-types";

export const addMastersAll = (masters) => ({

    type: ADD_ALL_MASTERS,
    masters
    
});

export const addMasterOne = ({ salon_id, name, slug, position, photo, experience, description, rating}) => ({
    type: ADD_ONE_MASTER,
    salon_id,
    name, 
    slug, 
    position, 
    photo, 
    experience, 
    description, 
    rating
})

export const clearMaster = () => ({

    type: CLEAR_MASTERS,

});




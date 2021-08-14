import { ADD_MASTERS, CLEAR_MASTERS, DELETE_MASTER } from "./action-types";


export const addMasters = ({salon_id, name, slug, position, photo, experience, description, rating}) => ({

    type: ADD_MASTERS,
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

    type: CLEAR_MASTERS,

});




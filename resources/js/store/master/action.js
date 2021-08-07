import { ADD_MASTERS, CLEAR_MASTERS, DELETE_MASTER } from "./action-types";


export const addMasters = (masters) => ({

    type: ADD_MASTERS,
    masters
    
});

export const delMaster = (id) => ({

    type: DELETE_MASTER,
    id

});

export const clearMaster = () => ({

    type: CLEAR_MASTERS,

});




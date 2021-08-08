import { ADD_SERVICES, CLEAR_SERVICES, DELETE_SERVICES } from "./action-types";



export const addServices = (services) => ({

    type: ADD_SERVICES,
    services
    
});

export const delServices = (id) => ({

    type: DELETE_SERVICES,
    id

});

export const clearServices = () => ({

    type: CLEAR_SERVICES,

});




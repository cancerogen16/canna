import {ADD_SALONS, CLEAR_SALONS} from "./action-types";


export const addSalons = (salons) => ({

    type: ADD_SALONS,
    salons

});

export const clearSalons = () => ({

    type: CLEAR_SALONS,

}) 





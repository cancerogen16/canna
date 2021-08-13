import {ADD_SERVICES, CLEAR_SERVICES, DELETE_SERVICES} from "./action-types";

export const addServices = ({id, category_id, salon_id, title, price, duration, image, excerpt, description}) => ({

    type: ADD_SERVICES,
    id,
    category_id,
    salon_id,
    title,
    price,
    duration,
    image,
    excerpt,
    description

});

export const delServices = (id) => ({

    type: DELETE_SERVICES,
    id

});

export const clearServices = () => ({

    type: CLEAR_SERVICES,

});




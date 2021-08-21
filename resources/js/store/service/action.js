import {ADD_SERVICE, CLEAR_SERVICE, DELETE_SERVICE} from "./action-types";

export const addService = ({ salon_id, title, slug, price, duration, image, excerpt, description }) => ({
    type: ADD_SERVICE,
    salon_id,
    title,
    slug,
    price,
    duration,
    image,
    excerpt,
    description
});

export const delService = (id) => ({
    type: DELETE_SERVICE,
    id
});

export const clearService = () => ({
    type: CLEAR_SERVICE,
});

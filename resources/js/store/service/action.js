import {ADD_SERVICE, CLEAR_SERVICE, DELETE_SERVICE} from "./action-types";

export const addService = ({ salon_id, id, category_id, title, slug, price, duration, image, thumb, excerpt, description }) => ({
    type: ADD_SERVICE,
    salon_id,
    id,
    title,
    slug,
    price,
    duration,
    image,
    thumb,
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

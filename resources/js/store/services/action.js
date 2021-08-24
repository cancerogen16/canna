import {ADD_ALL_SERVICES, ADD_ONE_SERVICE, CLEAR_SERVICES, UPDATE_SERVICE, DELETE_SERVICE} from "./action-types";

export const addServicesAll = (services) => ({
    type: ADD_ALL_SERVICES,
    services
});

export const addServiceOne = ({salon_id, id, category_id, title, slug, price, duration, image, thumb, excerpt, description}) => ({
    type: ADD_ONE_SERVICE,
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

export const clearService = () => ({
    type: CLEAR_SERVICES,
});

export const updateService = (service) => ({
    type: UPDATE_SERVICE,
    service
});

export const delService = (id) => ({
    type: DELETE_SERVICE,
    id
});

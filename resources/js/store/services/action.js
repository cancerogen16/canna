import { ADD_ALL_SERVICES, ADD_ONE_SERVICE, CLEAR_SERVICES, DELETE_SERVICE } from "./action-types";

export const addServicesAll = (services) => ({

    type: ADD_ALL_SERVICES,
    services

});

export const addServiceOne = ({ salon_id, title, slug, price, image, duration, excerpt, description}) => ({
    type: ADD_ONE_SERVICE,
    salon_id,
    title,
    slug,
    price,
    duration,
    image,
    excerpt,
    description
})

export const delService = (id) => ({
    type: DELETE_SERVICE,
    id
});

export const clearService = () => ({

    type: CLEAR_SERVICES,

});




import { ADD_SALON, CLEAR_SALON, CREATE_SALON } from "./action-types";



export const addSalon = ({id,user_id,title, slug,main_photo, city, address, phone, description, rating,worktime}) => ({

    type: ADD_SALON,
    id,
    user_id,
    title, 
    slug,
    main_photo, 
    city, 
    address, 
    phone, 
    description, 
    rating,
    worktime

});


export const clearSalon = () => ({

    type: CLEAR_SALON,

}) 

export const createSalon = ({user_id ,title, slug,main_photo, city, address, phone, description, rating,worktime}) => ({

    type: CREATE_SALON,
    user_id,
    title, 
    slug,
    main_photo, 
    city, 
    address, 
    phone, 
    description, 
    rating,
    worktime

}) 



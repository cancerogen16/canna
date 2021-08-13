import {ADD_CATEGORY, CLEAR_CATEGORY} from './action-types';


export const addCategory = ({id, title, slug}) => ({
    type: ADD_CATEGORY,
    id,
    title,
    slug
});

export const clearCategory = () => ({
    type: CLEAR_CATEGORY,
});




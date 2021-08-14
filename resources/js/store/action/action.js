import {ADD_ACTION, CLEAR_ACTION, DELETE_ACTION} from "./action-types";

export const addAction = (actions) => ({
    type: ADD_ACTION,
    actions
});

export const delAction = (id) => ({
    type: DELETE_ACTION,
    id
});

export const clearAction = () => ({
    type: CLEAR_ACTION,
});





import { ADD_ERROR, DEL_ERROR } from './action-types';


export const addError = ({code, message}) => ({
    type: ADD_ERROR,
    code,
    message
});

export const delError = (index) => ({
    type: DEL_ERROR,
    index
});



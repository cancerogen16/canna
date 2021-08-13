import {ADD_RECORD, CLEAR_RECORD, DELETE_RECORD} from './action-types';

export const addRecord = ({id, master_id, record_id, start_datetime}) => ({
    type: ADD_RECORD,
    id,
    master_id,
    record_id,
    start_datetime
});

export const delRecord = (id) => ({
    type: DELETE_RECORD,
    id
});

export const clearRecord = () => ({
    type: CLEAR_RECORD,
});





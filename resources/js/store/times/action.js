import { ADD_TIMES } from './action-types';


export const addTimeOne = ({id, master_id, record_id, start_datetime}) => ({
    //type: ,
    id,
    master_id,
    record_id,
    start_datetime,
});

export const addTimeAll = (times) => ({
    type: ADD_TIMES,
    times
});





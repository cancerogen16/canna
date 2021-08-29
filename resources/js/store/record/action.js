import { ADD_RECORD } from './action-types';


export const addRecordOne = ({user_id,service_id,master_id,start_datetime,name,phone,comment}) => ({
    type: ADD_RECORD,
    user_id,
    service_id,
    master_id,
    start_datetime,
    name,
    phone,
    comment,
});

export const addRecorsdAll = (times) => ({
    //type: ADD_,
    times
});





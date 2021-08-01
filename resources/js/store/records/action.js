import { Http } from "@material-ui/icons";

export const ADD_RECORD = 'RECORD::ADD_RECORD';
export const CLEAR_RECORD = 'RECORD::CLEAR_RECORD';
export const DELETE_RECORD = 'RECORD::CLEAR_RECORD';
import HTTP from '../HTTP';


export const fetchRecords = (master_id) => (dispach, getState) => {
    HTTP.get('/api/calendars')
    .then((res) => {
        dispach(clearRecord())
        res.data.data.forEach(record => {
            dispach(addRecord(record));
        });
    })

}



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


// export const fetchProfileWithThunk = () => (dispatch, getState) => {
//             fetch("https://reqres.in/api/users?id=2").then(res => res.json()).then(res => {
//                 dispatch(editProfile( res.data.first_name, res.data.last_name, res.data.email ))
//             })
//         }


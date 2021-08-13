import HTTP from '../../utils/HTTP';
import {addRecord, clearRecord} from "./action";

export const fetchRecords = (master_id) => (dispach, getState) => {

    HTTP.get('/api/calendars')
        .then((res) => {
            dispach(clearRecord())
            res.data.data.forEach(record => {
                dispach(addRecord(record));
            });
        })

}
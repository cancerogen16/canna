import HTTP from '../../utils/HTTP';
import {addMaster} from './action';
import {updateMasterSalon} from "../salon/action";
import { addMasterOne } from '../masters/action';

export const fetchMasterOne = (master_id) => (dispach, getState) => {
    HTTP.get(`/api/masters${master_id}`)
        .then(res => dispach(addMaster(res.data.master)))
}

export const fetchCreateMaster = (form) => (dispatch, getState) => {
    HTTP.post('api/masters', form, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
        .then(res => {
            const master = res.data.master;
            dispatch(addMasterOne(master));
            dispatch(updateMasterSalon(master.id));
        })
}
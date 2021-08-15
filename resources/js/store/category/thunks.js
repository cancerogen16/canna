import HTTP from '../../utils/HTTP';
import { addError } from '../error/action';
import {addCategory, clearCategory} from "./action";

export const fetchCategoryAll = () => (dispatch, getState) => {
    HTTP.get("/api/categories")
    .then(res => {
        dispatch(clearCategory())
        res.data.categories.forEach(element => {
            dispatch(addCategory(element))
        });
    })
    .catch(err => { 
        if (err.response) { 
            dispatch(addError({code: status, message: err.response.data.message})) 
        } else if (err.request) { 
            dispatch(addError({code: status, message: 'Не удается соединится с сервером'}))
        } else { 
            dispatch(addError({code: status, message: 'Что-то пошло не так'})) 
        }})
}

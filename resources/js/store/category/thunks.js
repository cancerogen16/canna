import HTTP from '../../utils/HTTP';
import {addCategory, clearCategory} from "./action";

export const fetchCategoryAll = () => (dispatch, getState) => {
    HTTP.get("/api/categories").then(res => {
        dispatch(clearCategory())
        res.data.categories.forEach(element => {
            dispatch(addCategory(element))
        });
    })
}

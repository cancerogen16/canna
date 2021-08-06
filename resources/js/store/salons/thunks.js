import HTTP from '../../utils/HTTP';
import { addSalons } from './action';


export const fetchSalonsAll = () => (dispatch, getState) => {

    HTTP.get('api/salons')
    .then(res => {
        dispatch(addSalons(res.data.salons))
    });

}
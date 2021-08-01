import HTTP from '../HTTP';

export const ADD_SALON = 'SALON::ADD_SALON';
export const CLEAR_SALON = 'SALON::CLEAR_SALON';

export const addSalon = ({id,user_id,title, slug,main_photo, city, address, phone, description, rating,worktime}) => ({
    type: ADD_SALON,
    id,
    user_id,
    title, 
    slug,
    main_photo, 
    city, 
    address, 
    phone, 
    description, 
    rating,
    worktime
});

export const clearSalon = () => ({
    type: CLEAR_SALON,
}) 

export const fetchSalonsAll = () => (dispatch, getState) => {
                HTTP.get('api/salons')
                .then(res => {
                    dispatch(clearSalon())
                    res.data.data.forEach(element => {
                        dispatch(addSalon(element))
                    });
                });
            }


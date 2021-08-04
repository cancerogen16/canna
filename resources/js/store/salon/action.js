import HTTP from '../HTTP';

export const ADD_SALON = 'SALON::ADD_SALON';
export const CLEAR_SALON = 'SALON::CLEAR_SALON';
export const ADD_SALONS = 'SALON::CLEAR_SALONS';
export const CREATE_SALON = 'SALON::CREATE_SALON';

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

export const addSalons = (salons) => ({
    type: ADD_SALONS,
    salons
});

export const clearSalon = () => ({
    type: CLEAR_SALON,
}) 

export const createSalon = ({user_id ,title, slug,main_photo, city, address, phone, description, rating,worktime}) => ({
    type: CREATE_SALON,
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
}) 

export const fetchCreateSalon = (salons) => (dispatch, getState) => {
    HTTP.post('api/salons', salons)
    .then(res => console.log(res))
}

export const fetchSalonsAll = () => (dispatch, getState) => {
                HTTP.get('api/salons')
                .then(res => {
                    //dispatch(clearSalon())
                    dispatch(addSalons(res.data.salons))
                   
                });
            }
export const fetchSalonsOneId = (id) => (dispatch, getState) => {
    HTTP.get(`/api/salons/${id}`)
    .then(res => {
        //dispatch(clearSalon())
        dispatch(addSalon(res.data.salon))
       
    });
}


export const ADD_SALON = 'SALON::ADD_SALON';

export const addSalon = ({id, title, main_photo, city, address, phone, description, rating}) => ({
    type: ADD_SALON,
    id,
    title, 
    main_photo, 
    city, 
    address, 
    phone, 
    description, 
    rating
});


// export const fetchProfileWithThunk = () => (dispatch, getState) => {
//             fetch("https://reqres.in/api/users?id=2").then(res => res.json()).then(res => {
//                 dispatch(editProfile( res.data.first_name, res.data.last_name, res.data.email ))
//             })
//         }


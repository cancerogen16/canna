export const EDIT_CATEGORY = 'CATEGORY::EDIT_CATEGORY';

export const editCategory = (email, token) => ({
    type: EDIT_CATEGORY,
    email,
    token
});


// export const fetchProfileWithThunk = () => (dispatch, getState) => {
//             fetch("https://reqres.in/api/users?id=2").then(res => res.json()).then(res => {
//                 dispatch(editProfile( res.data.first_name, res.data.last_name, res.data.email ))
//             })
//         }

